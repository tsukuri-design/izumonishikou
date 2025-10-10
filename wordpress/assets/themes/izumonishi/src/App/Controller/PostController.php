<?php declare(strict_types=1);
namespace App\Controller;

use Mvc4Wp\Core\Library\Castable;
use Mvc4Wp\Core\Model\CategoryEntity;
use Mvc4Wp\Core\Model\PostEntity;
use Mvc4Wp\Core\Model\Repository\OrderInQuery;
use Mvc4Wp\Core\Model\TagEntity;

class PostController extends AdminController
{
    use Castable;

    private string $name;

    public function init(array $args = []): void
    {
        parent::init($args);
        $this->name = 'Post';
    }

    public function index(array $args = []): void
    {
        $this->list();
    }

    public function list(array $args = []): void
    {
        $posts = [];
        $sort = 'ID';
        $order = OrderInQuery::ASC;
        if (array_key_exists('sort', $args)) {
            $sort = $args['sort'];
        }
        if (array_key_exists('order', $args)) {
            $order = OrderInQuery::from(strtoupper($args['order']));
        }
        $posts = PostEntity::find()
            ->withAny()
            ->withAutoDraft()
            ->withTrash()
            ->orderBy($sort, $order)
            ->all()
            ->build()
            ->list();
        $categories = CategoryEntity::find()
            ->showEmpty()
            ->orderByID()
            ->build()
            ->list();
        $tags = TagEntity::find()
            ->showEmpty()
            ->orderByID()
            ->build()
            ->list();

        $data = [
            'title' => $this->name,
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
            'columns' => ['ID', 'post_author', 'post_date', 'post_name', 'post_status', 'post_title', 'post_type', 'post_content',],
            'sort' => $sort,
            'order' => strtolower($order->value),
        ];

        $this
            ->ok()
            ->view('components/header', $data)
            ->view('components/link', $data)
            ->view('post/list', $data)
            ->view('components/footer')
            ->done();
    }

    public function single(array $args): void
    {
        $post = null;

        if (array_key_exists('id', $args)) {
            $id = intval($args['id']);
            $post = PostEntity::findByID($id, false);
        } elseif (array_key_exists('slug', $args)) {
            $slug = strval($args['slug']);
            $post = PostEntity::find()
                ->withAny()
                ->withAutoDraft()
                ->withTrash()
                ->bySlug($slug)
                ->build()
                ->single();
        }
        if (is_null($post)) {
            $this
                ->notFound()
                ->done();
        }
        $id = $post->ID;

        $categories = CategoryEntity::find()
            ->showEmpty()
            ->orderByID()
            ->build()
            ->list();
        $tags = TagEntity::find()
            ->showEmpty()
            ->orderByID()
            ->build()
            ->list();

        if (is_null($post)) {
            $this
                ->notFound()
                ->done();
        }

        $data = [
            'title' => $this->name,
            'id' => $id,
            'posts' => [$post],
            'categories' => $categories,
            'categoried' => $post->getCategories(),
            'tags' => $tags,
            'tagged' => $post->getTags(),
            'columns' => ['ID', 'post_author', 'post_date', 'post_name', 'post_status', 'post_title', 'post_type', 'post_content',],
            'single' => 'true',
        ];

        $this
            ->ok()
            ->view('components/header', $data)
            ->view('components/link', $data)
            ->view('post/single', $data)
            ->view('components/footer')
            ->done();
    }

    public function register(array $args = []): void
    {
        $post = new PostEntity();
        $post->bind($_POST);
        $id = $post->register();
        if (array_key_exists('categories', $_POST)) {
            $categories = array_map(fn($slug) => CategoryEntity::findBySlug($slug), array_keys($_POST['categories']));
            $post->addCategories($categories);
        }
        if (array_key_exists('tags', $_POST)) {
            $tags = array_map(fn($slug) => TagEntity::findBySlug($slug), array_keys($_POST['tags']));
            $post->addTags($tags);
        }
        $this
            ->seeOther("/post/{$id}")
            ->done();
    }

    public function update(array $args): void
    {
        $id = intval($args['id']);
        $post = PostEntity::findByID($id, false);
        if (is_null($post)) {
            $this
                ->notFound()
                ->done();
        }

        $post->bind($_POST);
        $post->update();
        if (array_key_exists('categories', $_POST)) {
            $categories = array_map(fn($slug) => CategoryEntity::findBySlug($slug), array_keys($_POST['categories']));
            $post->setCategories($categories);
        } else {
            $post->removeCategories();
        }
        if (array_key_exists('tags', $_POST)) {
            $tags = array_map(fn($slug) => TagEntity::findBySlug($slug), array_keys($_POST['tags']));
            $post->setTags($tags);
        } else {
            $post->removeTags();
        }
        $this
            ->seeOther("/post/{$id}")
            ->done();
    }

    public function delete(array $args): void
    {
        $id = intval($args['id']);
        $post = PostEntity::findByID($id, false);
        if (is_null($post)) {
            $this
                ->notFound()
                ->done();
        }

        if ($_POST['to_trush'] === 'untrash') {
            $post->post_status = 'publish';
            $post->update();
            $this
                ->seeOther("/post/{$id}")
                ->done();
        } elseif ($_POST['to_trush'] === 'trash') {
            $post->delete();
            $this
                ->seeOther("/post/{$id}")
                ->done();
        } else {
            $post->delete(true);
            $this
                ->seeOther("/post/list")
                ->done();
        }
    }
}