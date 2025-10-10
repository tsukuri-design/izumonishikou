<?php declare(strict_types=1);

/**
 * ショートコード: 関連記事を表示
 * 
 * 使用方法:
 * [related_posts] - ACFフィールドから関連記事を取得
 * [related_posts posts="123,456,789"] - 指定したpost_idの記事を表示
 * [related_posts posts="about,contact,news"] - 指定したslugの記事を表示
 * [related_posts posts="123,about,456,contact"] - post_idとslugを混在
 */
function related_posts_shortcode($atts): string
{
    $atts = shortcode_atts([
        'posts' => '',
        'debug' => 'false',
    ], $atts);

    $custom_posts = [];

    if (!empty($atts['posts'])) {
        // カンマ区切りで分割
        $post_identifiers = array_map('trim', explode(',', $atts['posts']));

        foreach ($post_identifiers as $identifier) {
            if (!empty($identifier)) {
                $custom_posts[] = $identifier;
            }
        }
    }

    // デバッグモードの場合は、見つからない記事を表示
    if ($atts['debug'] === 'true') {
        return get_custom_related_posts_with_debug($custom_posts);
    }

    return get_custom_related_posts($custom_posts);
}

// ショートコードを登録
add_shortcode('related_posts', 'related_posts_shortcode');

/**
 * デバッグ用: 見つからない記事の情報を表示
 */
function get_custom_related_posts_with_debug(array $custom_posts = []): string
{
    global $post;

    if (empty($custom_posts)) {
        return get_custom_related_posts($custom_posts);
    }

    $related_posts = [];
    $debug_info = '<div style="background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;">';
    $debug_info .= '<h4>デバッグ情報:</h4>';

    foreach ($custom_posts as $post_identifier) {
        $post_obj = null;
        $found_method = '';

        // post_id（数値）の場合
        if (is_numeric($post_identifier)) {
            $post_obj = get_post((int) $post_identifier);
            $found_method = $post_obj ? 'get_post()' : 'not found';
        }
        // slug（文字列）の場合
        elseif (is_string($post_identifier)) {
            $post_obj = get_page_by_path($post_identifier, OBJECT, 'page');
            $found_method = $post_obj ? 'get_page_by_path(page)' : '';

            if (!$post_obj) {
                $post_obj = get_page_by_path($post_identifier, OBJECT, 'post');
                $found_method = $post_obj ? 'get_page_by_path(post)' : '';
            }

            if (!$post_obj) {
                $query = new WP_Query([
                    'name' => $post_identifier,
                    'post_type' => ['page', 'post'],
                    'post_status' => 'publish',
                    'posts_per_page' => 1,
                ]);

                if ($query->have_posts()) {
                    $post_obj = $query->posts[0];
                    $found_method = 'WP_Query';
                }
                wp_reset_postdata();
            }
        }

        if ($post_obj && $post_obj->post_status === 'publish') {
            $related_posts[] = $post_obj;
            $debug_info .= '<p>✓ ' . esc_html($post_identifier) . ' → ' . esc_html($post_obj->post_title) . ' (ID: ' . $post_obj->ID . ') [' . $found_method . ']</p>';
        } else {
            $debug_info .= '<p>✗ ' . esc_html($post_identifier) . ' → 見つかりませんでした</p>';
        }
    }

    $debug_info .= '</div>';

    if (empty($related_posts)) {
        return $debug_info . '<p>表示する記事がありません。</p>';
    }

    return $debug_info . get_custom_related_posts($custom_posts);
}

function get_custom_related_posts(array $custom_posts = []): string
{
    global $post;

    // 引数が指定された場合は、指定された記事を使用
    if (!empty($custom_posts)) {
        $related_posts = [];

        foreach ($custom_posts as $post_identifier) {
            $post_obj = null;

            // post_id（数値）の場合
            if (is_numeric($post_identifier)) {
                $post_obj = get_post((int) $post_identifier);
            }
            // slug（文字列）の場合
            elseif (is_string($post_identifier)) {
                // より確実なslug検索
                $post_obj = get_page_by_path($post_identifier, OBJECT, 'page');

                // 固定ページで見つからない場合は、他の投稿タイプも検索
                if (!$post_obj) {
                    $post_obj = get_page_by_path($post_identifier, OBJECT, 'post');
                }

                // それでも見つからない場合は、WP_Queryで検索
                if (!$post_obj) {
                    $query = new WP_Query([
                        'name' => $post_identifier,
                        'post_type' => ['page', 'post'],
                        'post_status' => 'publish',
                        'posts_per_page' => 1,
                    ]);

                    if ($query->have_posts()) {
                        $post_obj = $query->posts[0];
                    }
                    wp_reset_postdata();
                }
            }

            if ($post_obj && $post_obj->post_status === 'publish') {
                $related_posts[] = $post_obj;
            }
        }
    } else {
        // 引数がない場合は従来通りACFフィールドから取得
        $related_posts = get_field('related', $post ? $post->ID : 0);
        if (empty($related_posts) || !is_array($related_posts)) {
            return '';
        }
    }

    if (empty($related_posts)) {
        return '';
    }

    $html = '<section class="related-posts">' . "\n";

    // 引数を持っていない場合（ACFフィールドから取得した場合）にタイトルを追加
    if (empty($custom_posts)) {
        $html .= '<h3 class="heading3"><span class="en">RELATED PAGES</span><span class="ja">関連ページ</span></h3>' . "\n";
    }

    $html .= '<div class="related-posts-wrap inaction inaction_opacity">' . "\n";

    foreach ($related_posts as $related) {
        if (!$related instanceof WP_Post) {
            $related = get_post((int) $related);
            if (!$related) {
                continue;
            }
        }


        $title = get_the_title($related->ID);
        $exp = get_field('exp', $related->ID);
        $sub = get_field('sub', $related->ID);
        $no_link = (bool) get_field('no_link', $related->ID);
        $acf_link = get_field('link', $related->ID);
        $has_acf = is_array($acf_link) && !empty($acf_link['url']);
        $href = $has_acf ? (string) $acf_link['url'] : get_permalink($related->ID);
        $target = ($has_acf && !empty($acf_link['target'])) ? (string) $acf_link['target'] : '_self';
        $rel_attr = ($target === '_blank') ? ' rel="noopener noreferrer"' : '';


        $acf_image = get_field('image', $related->ID);
        $thumb_html = '';
        if (is_array($acf_image) && (!empty($acf_image['ID']) || !empty($acf_image['url']))) {
            if (!empty($acf_image['ID'])) {
                $alt = '';
                if (!empty($acf_image['alt'])) {
                    $alt = (string) $acf_image['alt'];
                } else {
                    $alt = (string) get_post_meta((int) $acf_image['ID'], '_wp_attachment_image_alt', true);
                    if ($alt === '') {
                        $alt = (string) $title;
                    }
                }
                $thumb_html = wp_get_attachment_image((int) $acf_image['ID'], 'medium', false, ['alt' => $alt]);
            } else {

                $alt = !empty($acf_image['alt']) ? (string) $acf_image['alt'] : (string) $title;
                $thumb_html = '<img src="' . esc_url((string) $acf_image['url']) . '" alt="' . esc_attr($alt) . '">';
            }
        } else {
            $thumb_html = get_the_post_thumbnail($related->ID, 'medium');
        }


        $html .= '<div class="related-post">';


        if ($no_link) {
            $html .= '<span class="related-post__inner">';
        } else {
            $html .= '<a href="' . esc_url($href) . '" target="' . esc_attr($target) . '"' . $rel_attr . ' class="related-post__inner">';
        }

        if ($thumb_html) {
            $html .= '<div class="thumb">' . $thumb_html . '</div>';
        }
        if (!empty($sub)) {
            $html .= '<div class="sub">' . esc_html($sub) . '</div>';
        }

        $html .= '<div class="text_wrap"><h4 class="heading4">' . esc_html($title) . '</h4>';
        if (!empty($exp)) {

            $html .= '<p class="text">' . esc_html($exp) . '</p>';
        }
        $html .= '</div>';


        $html .= $no_link ? '</span>' : '</a>';

        $html .= '</div>';
    }

    $html .= '</div>';
    $html .= '</section>';
    return $html;
}
