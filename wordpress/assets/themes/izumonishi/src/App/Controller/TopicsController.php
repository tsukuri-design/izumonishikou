<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;

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

        // Force 「在校生・保護者」 on /current-students/information/
        $forced_current_students = false;
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
        $path = rtrim($path, '/');
        if ($path === '/current-students/information') {
            $forced_current_students = true;
            $resolved = $this->resolveCurrentStudentsSlug();
            if ($resolved) {
                $category_slug = $resolved;
            }
        }

        $paged = get_query_var('paged') ? (int) get_query_var('paged') : 1;

        $data = [
            'title' => 'お知らせ' . get_bloginfo('title'),
            'styles' => ['topics'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
                'menu',
            ],
            'topics' => $this->getTopicsData($paged, $category_slug),
            'topics_category' => $this->getAllTopicsCategories(),
            'hide_category_menu' => $forced_current_students,
            // tiny debug aid: see the forced slug in page source
            'forced_slug' => $forced_current_students ? (string) ($category_slug ?? '') : '',
        ];

        $this->ok()->page('topics/index', $data)->done();
    }

    private function resolveCurrentStudentsSlug(): ?string
    {
        $taxonomy = 'topics_category';

        // 1) exact name match
        $t = get_term_by('name', '在校生・保護者', $taxonomy);
        if ($t instanceof \WP_Term)
            return $t->slug;

        // 2) common slug guesses
        foreach (['current-students', 'current_students', 'students-parents', 'zaikosei', 'guardians'] as $guess) {
            $t = get_term_by('slug', $guess, $taxonomy);
            if ($t instanceof \WP_Term)
                return $t->slug;
        }

        // 3) fuzzy search by name fragments
        $cands = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false, 'search' => '在校生']);
        if (!is_wp_error($cands) && !empty($cands))
            return $cands[0]->slug;

        $cands = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => false, 'search' => '保護者']);
        if (!is_wp_error($cands) && !empty($cands))
            return $cands[0]->slug;

        return null;
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

        if (!empty($category_slug)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'topics_category',
                    'field' => 'slug',
                    'terms' => (array) $category_slug,
                    'include_children' => false,
                ]
            ];
        }

        $query = new \WP_Query($args);
        $topics_data = [];

        $child_path = get_stylesheet_directory() . '/img/default-eyecatch.png';
        $parent_path = get_template_directory() . '/img/default-eyecatch.png';
        $child_uri = get_stylesheet_directory_uri() . '/img/default-eyecatch.png';
        $parent_uri = get_template_directory_uri() . '/img/default-eyecatch.png';
        $default_img = file_exists($child_path) ? $child_uri : (file_exists($parent_path) ? $parent_uri : '');

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

                $image_setting = get_field('image_setting', $post_id);
                $show_image = ($image_setting === null || $image_setting === '') ? true : (bool) $image_setting;

                $image_html = '';
                $pc_img = get_field('pc_only_image', $post_id);
                $sp_img = get_field('sp_only_image', $post_id);

                $pc_d = $acfUrl($pc_img, 'large');
                $pc_m = $acfUrl($pc_img, 'medium');
                $sp_m = $acfUrl($sp_img, 'medium');
                $sp_d = $acfUrl($sp_img, 'large');

                $feat_d = $feat_m = '';
                if (has_post_thumbnail($post_id)) {
                    $thumb_id = get_post_thumbnail_id($post_id);
                    $feat_d = wp_get_attachment_image_url($thumb_id, 'large') ?: '';
                    $feat_m = wp_get_attachment_image_url($thumb_id, 'medium') ?: ($feat_d ?: '');
                }

                $img_pc = '';
                $img_sp = '';
                $has_override = ($pc_d || $pc_m || $sp_m || $sp_d);

                if ($has_override) {
                    $img_pc = $pc_d ?: ($sp_d ?: ($feat_d ?: ($feat_m ?: $default_img)));
                    $img_sp = $sp_m ?: ($pc_m ?: ($feat_m ?: ($feat_d ?: $default_img)));
                } else {
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

                if (get_field('link', $post_id)) {
                    $link = get_field('link', $post_id);
                    $link = $link['url'];
                    $target = 'target="_blank"';
                } else {
                    $link = get_the_permalink();
                    $target = '';
                }
                $raw_date = get_the_time('Y.n.j');
                $weekday = strtolower(date('D', strtotime(get_the_time('Y-m-d'))));
                $date = $raw_date . ' (' . $weekday . ')';
                $title = get_the_title();
                $categories = get_the_terms($post_id, 'topics_category');

                $topics_data[] = [
                    'link' => $link,
                    'target' => $target,
                    'image' => $image_html,
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
}
