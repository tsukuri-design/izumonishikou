<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\UserEntity;

class FaqController extends PlainPhpController
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

        $data = [
            'title' => get_the_title() . get_bloginfo('name'),
            'content' => get_the_content(),
            'styles' => ['singular', 'faq'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'faq',
                'inview',
                'global',
                'menu',
            ],

        ];

        $this
            ->ok()
            ->page('faq/index', $data)
            ->done();
    }


    public function redirect(array $args = []): void
    {
        $this
            ->done();
    }
}
