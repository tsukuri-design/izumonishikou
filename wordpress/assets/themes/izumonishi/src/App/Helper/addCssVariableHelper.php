<?php declare(strict_types=1);
function add_scss_variables()
{
    echo "<style>:root { --font-path: '" . get_template_directory_uri() . "/fonts/'; }</style>";
}
add_action('wp_head', 'add_scss_variables');
