<?php declare(strict_types=1);
// Multibyte-safe 20-char truncate with "..."
if (!function_exists('_bc_trunc20')) {
    function _bc_trunc20(string $s, int $limit = 20, string $suffix = '...'): string
    {
        $s = wp_strip_all_tags($s, false);
        if (function_exists('mb_strlen') && function_exists('mb_substr')) {
            return (mb_strlen($s, 'UTF-8') > $limit)
                ? mb_substr($s, 0, $limit, 'UTF-8') . $suffix
                : $s;
        }
        return (strlen($s) > $limit) ? substr($s, 0, $limit) . $suffix : $s;
    }
}

function get_custom_breadcrumbs(string $top_label = '出雲西高等学校', string $top_url = '/'): string
{
    global $post;

    $parts = [
        '<a href="' . esc_url($top_url) . '">' . esc_html($top_label) . '</a>',
    ];

    // Front page: only HOME
    if (is_front_page()) {
        return '<nav class="breadcrumbs">' . implode('<div class="line"></div>', $parts) . '</nav>';
    }

    // Blog index (when showing posts on a separate page)
    if (is_home()) {
        $page_for_posts = (int) get_option('page_for_posts');
        if ($page_for_posts) {
            $parts[] = esc_html(get_the_title($page_for_posts));
        }
        return '<nav class="breadcrumbs">' . implode('<div class="line"></div>', $parts) . '</nav>';
    }

    // Singular posts (includes CPT, pages, posts)
    if (is_singular()) {
        $pt = get_post_type();
        if ($pt === 'page') {
            // Page ancestors
            if (!empty($post) && $post->post_parent) {
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                foreach ($ancestors as $aid) {
                    $parts[] = '<a href="' . esc_url(get_permalink($aid)) . '">' . esc_html(get_the_title($aid)) . '</a>';
                }
            }
            $parts[] = esc_html(_bc_trunc20(get_the_title()));

        } elseif ($pt === 'post') {
            // Blog archive (if it exists)
            $page_for_posts = (int) get_option('page_for_posts');
            if ($page_for_posts) {
                $parts[] = '<a href="' . esc_url(get_permalink($page_for_posts)) . '">' . esc_html(get_the_title($page_for_posts)) . '</a>';
            }
            // Primary category (fallback to first)
            $cats = get_the_category();
            if (!empty($cats)) {
                $cat = $cats[0];
                // Include parent categories
                $parents = get_ancestors($cat->term_id, 'category');
                $parents = array_reverse($parents);
                foreach ($parents as $pid) {
                    $parts[] = '<a href="' . esc_url(get_category_link($pid)) . '">' . esc_html(get_cat_name($pid)) . '</a>';
                }
                $parts[] = '<a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a>';
            }
            $parts[] = esc_html(_bc_trunc20(get_the_title()));

        } else {
            // SINGLE CUSTOM POST TYPE
            $pto = get_post_type_object($pt);
            if ($pto && !empty($pto->has_archive)) {
                $parts[] = '<a href="' . esc_url(get_post_type_archive_link($pt)) . '">' . esc_html($pto->labels->name) . '</a>';
            }

            // Try to add a relevant taxonomy trail (prefer hierarchical public taxonomies)
            $tax = _pick_breadcrumb_taxonomy($pt);
            if ($tax) {
                $terms = get_the_terms(get_the_ID(), $tax);
                if ($terms && !is_wp_error($terms)) {
                    // Pick one term deterministically: smallest hierarchy depth first
                    $term = _pick_primary_term($terms, $tax);
                    // Ancestors
                    $anc = get_ancestors($term->term_id, $tax);
                    $anc = array_reverse($anc);
                    foreach ($anc as $tid) {
                        $t = get_term($tid, $tax);
                        if ($t && !is_wp_error($t)) {
                            $parts[] = '<a href="' . esc_url(get_term_link($t)) . '">' . esc_html($t->name) . '</a>';
                        }
                    }
                    // Current term
                    $parts[] = '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
                }
            }

            // Title
            $parts[] = esc_html(_bc_trunc20(get_the_title()));

        }
    }
    // CPT archive
    elseif (is_post_type_archive()) {
        $pt_q = get_query_var('post_type');
        $pt = is_array($pt_q) ? reset($pt_q) : ($pt_q ?: get_post_type());
        $pto = $pt ? get_post_type_object($pt) : null;
        if ($pto) {
            $parts[] = esc_html($pto->labels->name);
        }
    }
    // Taxonomy archives (category, tag, custom tax)
    elseif (is_tax() || is_category() || is_tag()) {
        $term = get_queried_object();
        if ($term && !is_wp_error($term)) {
            $tax = $term->taxonomy;
            $tax_obj = get_taxonomy($tax);

            // Link to the first CPT archive that uses this taxonomy (if any)
            $pts = $tax_obj->object_type ?? [];
            if (!empty($pts)) {
                $pt = reset($pts);
                $pto = get_post_type_object($pt);
                if ($pto && !empty($pto->has_archive)) {
                    $parts[] = '<a href="' . esc_url(get_post_type_archive_link($pt)) . '">' . esc_html($pto->labels->name) . '</a>';
                }
            }

            // Term ancestors (for hierarchical taxonomies)
            if (is_taxonomy_hierarchical($tax)) {
                $anc = get_ancestors($term->term_id, $tax);
                $anc = array_reverse($anc);
                foreach ($anc as $tid) {
                    $t = get_term($tid, $tax);
                    if ($t && !is_wp_error($t)) {
                        $parts[] = '<a href="' . esc_url(get_term_link($t)) . '">' . esc_html($t->name) . '</a>';
                    }
                }
            }

            $parts[] = esc_html($term->name);
        }
    }
    // Date, author, search, 404, etc.
    elseif (is_search()) {
        $parts[] = 'Search: ' . esc_html(get_search_query());
    } elseif (is_404()) {
        $parts[] = '404 Not Found';
    } elseif (is_archive()) {
        // Fallback archive title
        $parts[] = esc_html(get_the_archive_title());
    }

    $parts = array_filter($parts);
    return '<nav class="breadcrumbs">' . implode('<div class="line"></div>', $parts) . '</nav>';
}

/**
 * Pick the best taxonomy to use in breadcrumbs for a CPT:
 * - Prefer hierarchical & public taxonomies
 * - Else any public taxonomy
 */
function _pick_breadcrumb_taxonomy(string $post_type): ?string
{
    $taxes = get_object_taxonomies($post_type, 'objects');
    if (!$taxes)
        return null;

    // Prefer hierarchical + public
    foreach ($taxes as $tax => $obj) {
        if (!empty($obj->public) && !empty($obj->hierarchical))
            return $tax;
    }
    // Else any public
    foreach ($taxes as $tax => $obj) {
        if (!empty($obj->public))
            return $tax;
    }
    return null;
}

/**
 * Pick a "primary" term deterministically:
 * - Prefer the shallowest (closest to root) for stable breadcrumbs
 * - Tie-break by term_id
 */
function _pick_primary_term(array $terms, string $tax): WP_Term
{
    usort($terms, function ($a, $b) use ($tax) {
        $da = count(get_ancestors($a->term_id, $tax));
        $db = count(get_ancestors($b->term_id, $tax));
        if ($da === $db)
            return $a->term_id <=> $b->term_id;
        return $da <=> $db;
    });
    return $terms[0];
}
