<?php declare(strict_types=1);
/**
 * Delete Block Editor's Comment from the_content
 * Gutenbergで出すコメントを the_contentから消す
 */
function removeBlockEditorComment($content)
{
    // Remove block editor comments
    $content = preg_replace('/<!-- (.*?) -->/', '', $content);
    // Replace multiple newlines with a single newline
    $content = preg_replace("/\n+/", "\n", $content);
    // Remove 'wp-' prefixes selectively, avoiding 'wp-content'
    $content = preg_replace('/\bwp-(?!content\b)(\S+)/', '$1', $content);
    $content = preg_replace('/<img(.*?)src=["\'](.*?)["\'](.*?)>/i', '<img$1data-src="$2" class="lazyload"$3 data-expand="750"$4>', $content);

    return $content;
}
add_filter('the_content', 'removeBlockEditorComment', 1);
add_filter('get_the_content', 'removeBlockEditorComment', 1);


add_theme_support('post-thumbnails');
add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails', array('topics'));
});
