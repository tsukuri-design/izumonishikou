<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\UserEntity;

class SingularController extends PlainPhpController
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
        // error_log("CONTROLLER DEBUG: SingularController::index() called with args: " . json_encode($args));

        $slug = $args['slug'] ?? null;
        $post_id = $args['id'] ?? null;
        $post_type = $args['post_type'] ?? 'post'; //  Default to 'post' if not set

        if (!$slug && !$post_id) {
            // error_log("CONTROLLER ERROR: No slug or post ID provided!");
            $this->notFound()->done();
            return;
        }

        $query_args = [
            'post_type' => $post_type,
            'posts_per_page' => 1,
        ];

        //  If post ID is provided (for previews), use it instead of slug
        if ($post_id) {
            // error_log("CONTROLLER DEBUG: Loading post by ID {$post_id} (Post Type: {$post_type})");
            $query_args['p'] = (int) $post_id;
        } else {
            // error_log("CONTROLLER DEBUG: Loading post by slug {$slug} (Post Type: {$post_type})");
            $query_args['name'] = $slug;
        }

        $query = new \WP_Query($query_args);

        if (!$query->have_posts()) {
            // error_log("CONTROLLER ERROR: No post found!");
            $this->notFound()->done();
            return;
        }

        $query->the_post();
        // error_log("CONTROLLER DEBUG: Successfully loaded post: " . get_the_title());

        // 親ページ情報を取得
        $parent_info = $this->getParentPageInfo();

        $data = [
            'title' => get_the_title() . '',
            'parent_info' => $parent_info,
            'styles' => ['components/global', 'components/block_editor_content', 'singular'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'check_analytics',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
                'global',
            ],
        ];

        wp_reset_postdata();

        $this
            ->ok()
            ->page('singular/body', $data)
            ->done();
    }

    public function other(array $args): void
    {
        // 親ページ情報を取得
        $parent_info = $this->getParentPageInfo();

        $data = [
            'title' => wp_strip_all_tags(html_entity_decode(get_the_title())) . '｜' . get_bloginfo('name'),
            'content' => get_the_content(),
            'parent_info' => $parent_info,
            'styles' => ['components/global', 'components/block_editor_content', 'singular'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'check_analytics',
                'lazysizes',
                'smooth-scroll.polyfills',
                'global',
            ],
        ];

        $this
            ->ok()
            ->page('singular/other', $data)
            ->done();
    }

    private function getParentPageInfo(): ?array
    {
        $current_id = get_the_ID();

        // URLからページIDを直接取得を試行
        $url_parts = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        $potential_page_id = null;
        foreach ($url_parts as $part) {
            if (is_numeric($part)) {
                $potential_page_id = (int) $part;
                break;
            }
        }

        // 実際のページIDを使用（URLから取得したIDまたは現在のID）
        $actual_page_id = $potential_page_id ?: $current_id;
        $ancestors = get_post_ancestors($actual_page_id);

        if (!empty($ancestors)) {
            $top_parent_id = end($ancestors);
            $parent_en = function_exists('get_field') ? get_field('en', $top_parent_id) : '';
            $parent_url = get_permalink($top_parent_id);
            $parent_text = $parent_en ? $parent_en : get_the_title($top_parent_id);

            return [
                'id' => $top_parent_id,
                'url' => $parent_url,
                'text' => $parent_text,
                'en' => $parent_en
            ];
        }

        return null;
    }

    public function redirect(array $args = []): void
    {
        $this
            ->done();
    }
}
