<?php declare(strict_types=1);

function get_custom_related_posts(): string
{
    global $post;

    $related_posts = get_field('related', $post ? $post->ID : 0);
    if (empty($related_posts) || !is_array($related_posts)) {
        return '';
    }

    $html = '<div class="related_posts_wrap inaction inaction_opacity">';

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


        $html .= '<div class="related_post">';


        if ($no_link) {
            $html .= '<span class="related_post__inner">';
        } else {
            $html .= '<a href="' . esc_url($href) . '" target="' . esc_attr($target) . '"' . $rel_attr . ' class="related_post__inner">';
        }

        if ($thumb_html) {
            $html .= '<div class="thumb">' . $thumb_html . '</div>';
        }
        if (!empty($sub)) {
            $html .= '<div class="sub">' . esc_html($sub) . '</div>';
        }

        $html .= '<div class="text_wrap"><h3 class="heading3">' . esc_html($title) . '</h3>';
        if (!empty($exp)) {

            $html .= '<p class="text">' . esc_html($exp) . '</p>';
        }
        $html .= '</div>';


        $html .= $no_link ? '</span>' : '</a>';

        $html .= '</div>';
    }

    $html .= '</div>';
    return $html;
}
