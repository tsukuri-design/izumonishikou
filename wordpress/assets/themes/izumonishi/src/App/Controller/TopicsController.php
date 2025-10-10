<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\UserEntity;

class TopicsController extends PlainPhpController
{
    use Castable;

    private string $name;

    public function init(array $args = []): void
    {
        $this->name = '';
    }

    private function page(string $view, array $data): self
    {
        $this->view('components/header', $data);
        $this->view($view, $data)->view('components/footer', $data);
        return $this;
    }

    public function index(array $args = []): void
    {
        $category_slug = $args['category'] ?? null;

        $paged = get_query_var('paged') ? (int) get_query_var('paged') : 1;
        $data = [
            'title' => 'お知らせ｜' . get_bloginfo('name'),
            'styles' => ['components/global', 'components/pagination', 'topics'],
            'scripts' => [
                // 'typekit',
                'noie',
                'jquery',
                // 'check_analytics',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
                'global',
            ],
            'topics' => $this->getTopicsData($paged, $category_slug),
            'topics_category' => $this->getAllTopicsCategories(),
        ];

        $this
            ->ok()
            ->page('topics/index', $data)
            ->done();
    }


    public function getTopicsData(int $paged = 1, $category_slug = null): array
    {
        $args = [
            'post_type' => 'topics',
            'posts_per_page' => 12,
            'post_status' => 'publish',
            'order' => 'DESC',
            'paged' => $paged,
        ];

        if ($category_slug) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'topics_category',
                    'field' => 'slug',
                    'terms' => $category_slug,
                ]
            ];
        }

        $query = new \WP_Query($args);
        $topics_data = [];
        // Default image (child theme first, then parent)
        $child_path = get_stylesheet_directory() . '/img/default-eyecatch.png';
        $parent_path = get_template_directory() . '/img/default-eyecatch.png';
        $child_uri = get_stylesheet_directory_uri() . '/img/default-eyecatch.png';
        $parent_uri = get_template_directory_uri() . '/img/default-eyecatch.png';
        $default_img = file_exists($child_path) ? $child_uri : (file_exists($parent_path) ? $parent_uri : '');


        // Helper: extract URL from ACF image (array or ID)
        $acfUrl = static function ($img, string $size): string {
            if (empty($img))
                return '';
            if (is_array($img)) {
                if (!empty($img['sizes'][$size]))
                    return (string) $img['sizes'][$size];
                if (!empty($img['url']))
                    return (string) $img['url'];
                if (!empty($img['ID']))
                    return wp_get_attachment_image_url((int) $img['ID'], $size) ?: '';
                if (!empty($img['id']))
                    return wp_get_attachment_image_url((int) $img['id'], $size) ?: '';
                return '';
            }
            if (is_numeric($img)) {
                return wp_get_attachment_image_url((int) $img, $size) ?: '';
            }
            return '';
        };

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();

                // --- IMAGE LOGIC ---
                // Gate: image_setting (default true if unset)
                $image_setting = get_field('image_setting', $post_id);
                $show_image = ($image_setting === null || $image_setting === '') ? true : (bool) $image_setting;

                // --- IMAGE LOGIC (PC/SP override -> Eyecatch -> Default) ---
                $image_html = '';
                $img_pc = '';
                $img_sp = '';

                // Overrides first (existence wins)
                $pc_img = get_field('pc_only_image', $post_id);
                $sp_img = get_field('sp_only_image', $post_id);

                // Reuse your helper $acfUrl
                $pc_d = $acfUrl($pc_img, 'large');
                $pc_m = $acfUrl($pc_img, 'medium');
                $sp_m = $acfUrl($sp_img, 'medium');
                $sp_d = $acfUrl($sp_img, 'large');

                // Eyecatch as fallback
                $feat_d = $feat_m = '';
                if (has_post_thumbnail($post_id)) {
                    $thumb_id = get_post_thumbnail_id($post_id);
                    $feat_d = wp_get_attachment_image_url($thumb_id, 'large') ?: '';
                    $feat_m = wp_get_attachment_image_url($thumb_id, 'medium') ?: ($feat_d ?: '');
                }

                $has_override = ($pc_d || $pc_m || $sp_m || $sp_d);

                if ($has_override) {
                    // Missing side -> eyecatch -> default
                    $img_pc = $pc_d ?: ($sp_d ?: ($feat_d ?: ($feat_m ?: $default_img)));
                    $img_sp = $sp_m ?: ($pc_m ?: ($feat_m ?: ($feat_d ?: $default_img)));
                } else {
                    // No overrides -> eyecatch -> default
                    $img_pc = ($feat_d ?: $feat_m) ?: $default_img;
                    $img_sp = ($feat_m ?: $feat_d) ?: $default_img;
                }

                if ($img_pc || $img_sp) {
                    $alt = get_the_title($post_id) ?: '';
                    $image_html = '<picture>';
                    if (!empty($img_sp)) {
                        $image_html .= '<source media="(max-width: 767px)" srcset="' . esc_attr($img_sp) . '">';
                    }
                    $image_html .= '<img src="' . esc_url($img_pc ?: $img_sp) . '" alt="' . esc_attr($alt) . '">';
                    $image_html .= '</picture>';
                }
                // --- /IMAGE LOGIC ---

                $link = get_the_permalink();
                $raw_date = get_the_time('Y.n.j');
                $weekday = strtolower(date('D', strtotime(get_the_time('Y-m-d')))); // "mon", "tue", etc.
                $date = $raw_date . ' (' . $weekday . ')';
                $title = get_the_title();
                $categories = get_the_terms($post_id, 'topics_category');

                $topics_data[] = [
                    'link' => $link,
                    'image' => $image_html, // ✅ your view expects 'image'
                    'date' => $date,
                    'title' => $title,
                    'categories' => is_array($categories) ? $categories : [],
                ];
            }
            wp_reset_postdata();
        }

        return [
            'posts' => $topics_data,
            'max_num_pages' => $query->max_num_pages,
            'paged' => $paged,
        ];
    }

    public function getAllTopicsCategories(): array
    {
        $terms = get_terms([
            'taxonomy' => 'topics_category',
            'hide_empty' => false,
        ]);

        return is_array($terms) ? $terms : [];
    }



    public function other(array $args): void
    {
        $id = intval($args['id']);
        if ($id === 0) {
            $this
                ->notFound()
                ->done();
        }

        $data = [
            'title' => 'other page',
            'id' => strval($id),
        ];

        $this
            ->ok()
            ->page('home/body', $data)
            ->done();
    }

    public function redirect(array $args = []): void
    {
        $this
            ->seeOther('/home/other/321')
            ->done();
    }
}