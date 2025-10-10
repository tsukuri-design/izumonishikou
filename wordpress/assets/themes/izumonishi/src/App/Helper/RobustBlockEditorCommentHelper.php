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
    // $content = preg_replace('/\bwp-(?!content\b)(\S+)/', '$1', $content);
    // Remove 'wp-' prefixes selectively, avoiding 'wp-content' + adds inaction
    $content = preg_replace_callback(
        '/class="([^"]*)"/',
        function ($matches) {
            $classes = explode(' ', $matches[1]);
            foreach ($classes as &$class) {
                if (preg_match('/^wp-(?!content\b)(.+)/', $class, $m)) {
                    $class = $m[1] . ' inaction inaction_opacity';
                }
            }
            return 'class="' . implode(' ', $classes) . '"';
        },
        $content
    );
    // Add 'inaction inaction_opacity' to top-level <p> tags 
    $content = preg_replace_callback(
        '/<p([^>]*)>/i',
        function ($matches) {
            if (preg_match('/class="/', $matches[1])) {
                return '<p' . preg_replace('/class="([^"]*)"/', 'class="$1 inaction inaction_opacity"', $matches[1]) . '>';
            } else {
                return '<p' . $matches[1] . ' class="inaction inaction_opacity">';
            }
        },
        $content
    );

    return $content;
}
add_filter('the_content', 'removeBlockEditorComment', 1);
add_filter('get_the_content', 'removeBlockEditorComment', 1);



/**
 * Function to add sequential numeric IDs (e.g., header-1, header-2, ...) to headers (h1, h2, h3, etc.) in content.
 */
function addHeaderIds($content)
{
    static $header_counter = 1;  // Static counter to generate unique IDs

    // Reset the counter to 1 for each new page load
    $header_counter = 1;

    // Use regex to find all headers and add a unique ID
    $content = preg_replace_callback('/<h([2])(.*?)>(.*?)<\/h\1>/', function ($matches) use (&$header_counter) {
        // Generate a unique ID like header-1, header-2, ...
        $id = 'header-' . $header_counter++;

        // Return the header with the new ID
        return '<h' . $matches[1] . ' id="' . $id . '"' . $matches[2] . '>' . $matches[3] . '</h' . $matches[1] . '>';
    }, $content);

    return $content;
}
add_filter('the_content', 'addHeaderIds', 2);
add_filter('get_the_content', 'addHeaderIds', 2);


/**
 * Function to generate links to headers with sequential numeric IDs (e.g., header-1, header-2, ...) in the content.
 */
function getHeaderLinks($content)
{
    static $header_counter = 1;  // Static counter to ensure it matches the addHeaderIds function

    // Reset the counter to 1 for each new page load
    $header_counter = 1;

    preg_match_all('/<h([2])(.*?)>(.*?)<\/h\1>/', $content, $matches);

    if (count($matches[0]) <= 1) {
        return '';
    }

    $links = [];
    foreach ($matches[3] as $index => $header) {
        // Generate link with numeric header IDs, matching the header ID generation
        $id = 'header-' . $header_counter++;  // Ensure this matches with the ID generation in addHeaderIds
        $links[] = '<a href="#' . $id . '" class="header_link inaction_opacity">' . wp_trim_words($header, 10, '…') . '<span class="arrow"><svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.157 2.26367L6.35718 8.0625L5.91577 7.62012L0.115967 1.82129L0.999756 0.937499L1.44214 1.37891L6.35815 6.29395L11.2722 1.37891L11.7146 0.9375L12.5984 1.82129L12.157 2.26367Z" fill="#16569C"/></svg></span></a>';
    }

    return implode('', $links);
}
