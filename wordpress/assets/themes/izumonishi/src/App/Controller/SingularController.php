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

        $data = [
            'title' => get_the_title() . '',
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

        $data = [
            'title' => wp_strip_all_tags(html_entity_decode(get_the_title())) . '｜' . get_bloginfo('name'),
            'content' => get_the_content(),
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

    public function redirect(array $args = []): void
    {
        $this
            ->done();
    }
}
