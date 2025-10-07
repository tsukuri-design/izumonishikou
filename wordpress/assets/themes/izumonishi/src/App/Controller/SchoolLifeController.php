<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Controller\PlainPhpController;
use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\UserEntity;

class SchoolLifeController extends PlainPhpController
{
    use Castable;

    private string $name;

    public function init(array $args = []): void
    {
        $this->name = '学校生活｜' . get_bloginfo('name');
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
            'styles' => ['components/global', 'school-life'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
            ],
        ];

        $this
            ->ok()
            ->page('singular/other', $data)
            ->done();
    }
    public function school_events(array $args = []): void
    {
        $data = [
            'title' => $this->name,
            'styles' => ['components/global', 'components/block_editor_content', 'singular', 'school-life/school-events'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
            ],
        ];

        $this
            ->ok()
            ->page('school-life/events', $data)
            ->done();
    }

    public function uniform(array $args = []): void
    {
        $data = [
            'title' => $this->name,
            'styles' => ['components/global', 'components/block_editor_content', 'singular', 'school-life/uniform'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
            ],
        ];

        $this
            ->ok()
            ->page('school-life/uniform', $data)
            ->done();
    }
    public function facilities(array $args = []): void
    {
        $data = [
            'title' => $this->name,
            'styles' => ['components/global', 'components/block_editor_content', 'singular', 'school-life/facilities'],
            'scripts' => [
                'typekit',
                'noie',
                'jquery',
                'lazysizes',
                'smooth-scroll.polyfills',
                'inview',
                'slick/slick',
                'facility',
            ],
        ];

        $this
            ->ok()
            ->page('school-life/facilities', $data)
            ->done();
    }

    public function redirect(array $args = []): void
    {
        $this
            ->seeOther('/home/other/321')
            ->done();
    }
}