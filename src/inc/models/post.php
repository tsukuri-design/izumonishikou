<?php

abstract class PostModel extends Model
{
    // ---- fields

    // -- definitions

    private static function getPostFields(): array
    {
        return array(
            'ID'          => new EntityField('int', true),
            'post_author' => new EntityField('int', true),
            'post_date'   => new EntityField('string', true),
            'post_name'   => new EntityField('string', true),
            'post_status' => new EntityField('string', true, true, 'publish'),
            'post_title'  => new EntityField('string', true),
            'post_type'   => new EntityField('string', true),
        );
    }

    // -- entity fields

    public int $ID;
    public int $post_author;
    public string $post_date;
    public string $post_name;
    public string $post_status;
    public string $post_title;
    public string $post_type;

    // ---- constructor

    public function __construct0(): void
    {
    }

    public function __construct1(int $id): void
    {
        $post = get_post($id);
        // var_dump($post);
        self::bind($this, self::getPostFields(), $post, false);
    }

    // ---- abstract method

    abstract public function getPostType(): string;

    // ---- implements for domain
    public function getURL(): string
    {
        return home_url('/') . $this->post_name;
    }

    public function hasTerm($term, $taxonomy): bool
    {
        return has_term($term, $taxonomy, $this->ID);
    }

    // ---- implements for repository

    public function create(mixed $data): void
    {
        $this->post_title = wp_date('Y-m-d H:i:s');
        $this->ID         = wp_insert_post(array(
            'post_title'   => $this->post_title,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => $this->getPostType(),
            'post_author'  => wp_get_current_user()->ID,
            'post_date'    => wp_date('Y-m-d H:i:s'),
        ));
        $this->post_name = strval($this->ID);
        wp_update_post(array(
            'ID'        => $this->ID,
            'post_name' => $this->ID,
        ));

        $post = get_post($this->ID);
        self::bind($this, self::getPostFields(), $post, false);
    }

    public function update(mixed $data): void
    {
        wp_update_post($this);
    }

    public function delete(): void
    {
        wp_trash_post($this->ID);
    }

    protected static function count(array $args): int
    {
        $result = 0;

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            $result = $query->post_count;
        }
        wp_reset_postdata();

        return $result;
    }

    protected static function find(string $cls, array $args): array
    {
        $result = array();

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                array_push($result, new $cls(get_the_ID()));
            }
        }
        wp_reset_postdata();

        return $result;
    }

    protected static function find_one(string $cls, array $args): ?PostModel
    {
        $result = null;

        $query = new WP_Query($args);
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $result = new $cls(get_the_ID());

                break;
            }
        }
        wp_reset_postdata();

        return $result;
    }

    protected static function commit(PostModel $model, array $fields): void
    {
        foreach ($fields as $key => $field) {
            $field = EntityField::cast($field);
            if (property_exists($model, $key) && isset($model->$key)) {
                switch ($field->type) {
                    case 'DateTime':
                        $save_value = $model->$key->format('Y-m-d H:i:s');

                        break;
                    default:
                        $save_value = $model->$key;

                        break;
                }
                update_post_meta($model->ID, $key, $save_value);
            }
        }
    }
}
