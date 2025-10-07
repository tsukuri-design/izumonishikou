<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\UserEntity;

class HomeController extends PlainPhpController
{
    use Castable;

    private string $name;

    public function init(array $args = []): void
    {
        $this->name = get_bloginfo('name');
    }

    private function page(string $view, array $data): self
    {
        $this->view('components/header', $data);
        $this->view($view, $data)->view('components/footer', $data);
        return $this;
    }

    public function index(array $args = []): void
    {
        $data = [
            'title' => $this->name,
            'styles' => ['components/global', 'home'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
                'slick/slick',
                'slick_home',
                'global',
            ],
            'banner' => $this->getBannerData(),
            'topics' => $this->getTopicsData(),
        ];

        $this
            ->ok()
            ->page('home/body', $data)
            ->done();
    }

    public function getBannerData(): array
    {
        $args = [
            'post_type' => 'banner',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'order' => 'DESC',
        ];

        $query = new \WP_Query($args);
        $banner_data = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $image = get_field('img');
                $link = get_field('link');

                $banner_data[] = [
                    'image_url' => $image['url'] ?? '',
                    'link' => $link,
                ];
            }
            wp_reset_postdata();
        }

        return $banner_data;
    }
    public function getTopicsData(): array
    {
        $args = [
            'post_type' => 'topics',
            'posts_per_page' => 8,
            'post_status' => 'publish',
            'order' => 'DESC',
        ];

        $q = new \WP_Query($args);
        $topics_data = [];

        if ($q->have_posts()) {
            while ($q->have_posts()) {
                $q->the_post();
                $post_id = get_the_ID();

                // ----------------- IMAGE LOGIC (robust) -----------------
                // Gate: image_setting (default true if unset)
                $image_setting = get_field('image_setting', $post_id);
                $show_image = ($image_setting === null || $image_setting === '') ? true : (bool) $image_setting;

                // ----------------- IMAGE LOGIC (PC/SP override -> Featured -> Default) -----------------
                $image_html = '';
                $img_pc = '';
                $img_sp = '';

                // Default image (child theme first, then parent)
                $child_path = get_stylesheet_directory() . '/img/default-eyecatch.png';
                $parent_path = get_template_directory() . '/img/default-eyecatch.png';
                $child_uri = get_stylesheet_directory_uri() . '/img/default-eyecatch.png';
                $parent_uri = get_template_directory_uri() . '/img/default-eyecatch.png';
                $default_img = file_exists($child_path) ? $child_uri : (file_exists($parent_path) ? $parent_uri : '');

                // Helper: extract URL from ACF image array / ID
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
                    if (is_numeric($img))
                        return wp_get_attachment_image_url((int) $img, $size) ?: '';
                    return '';
                };

                $pc_img = get_field('pc_only_image', $post_id);
                $sp_img = get_field('sp_only_image', $post_id);

                $pc_d = $acfUrl($pc_img, 'large');
                $pc_m = $acfUrl($pc_img, 'medium');
                $sp_m = $acfUrl($sp_img, 'medium');
                $sp_d = $acfUrl($sp_img, 'large');

                // Featured (eyecatch) fallback
                $feat_d = $feat_m = '';
                if (has_post_thumbnail($post_id)) {
                    $thumb_id = get_post_thumbnail_id($post_id);
                    $feat_d = wp_get_attachment_image_url($thumb_id, 'large') ?: '';
                    $feat_m = wp_get_attachment_image_url($thumb_id, 'medium') ?: ($feat_d ?: '');
                }

                $has_override = ($pc_d || $pc_m || $sp_m || $sp_d);

                if ($has_override) {
                    // Overrides; missing side -> eyecatch -> default
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
                // ----------------- /IMAGE LOGIC -----------------

                // $link = get_the_permalink();
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
                    'image_html' => $image_html,          // ready <picture> (empty if none)
                    'image_pc' => $img_pc,              // large
                    'image_sp' => $img_sp,              // medium
                    'date' => $date,
                    'title' => $title,
                    'target' => $target,
                    'alt' => $title,
                    'categories' => is_array($categories) ? $categories : [],
                    'has_image' => (bool) ($img_pc || $img_sp),
                ];
            }
            wp_reset_postdata();
        }

        return $topics_data;
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