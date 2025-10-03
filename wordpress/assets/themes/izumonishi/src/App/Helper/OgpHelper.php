<?php declare(strict_types=1);

function generate_custom_ogp_image_size_on_save_post($post_id)
{
    // Avoid recursion and autosave interference
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // OPTIONAL - Get ACF field (as array), extract ID, then fallback to post thumbnail
    // $thumbimg = get_field('thumbimg', $post_id); // ACF returns array
    // $thumbimg_id = $thumbimg['ID'] ?? null; // Get ID from array
    // $thumbnail_id = get_post_thumbnail_id($post_id); // Post thumbnail ID
    // $image_id = $thumbimg_id ?: $thumbnail_id; // Prioritize ACF field
    //
    $thumbnail_id = get_post_thumbnail_id($post_id); // Post thumbnail ID
    $image_id = $thumbnail_id;

    if (!$image_id) {
        return; // No image found, exit early
    }

    // Get the file path of the image
    $file = get_attached_file($image_id);

    if (!$file || !file_exists($file)) {
        return; // File not found
    }

    $editor = wp_get_image_editor($file);
    if (is_wp_error($editor)) {
        return; // Failed to load editor
    }

    // Resize image to 1200x630 and save it
    $editor->resize(1200, 630, true);
    $resized = $editor->save();

    if (is_wp_error($resized) || !isset($resized['path'])) {
        return; // Resizing failed
    }

    // Update metadata for OGP image
    $metadata = wp_get_attachment_metadata($image_id);
    if (!$metadata) {
        return; // No metadata available
    }

    $metadata['sizes']['ogp_image'] = [
        'file' => wp_basename($resized['path']),
        'width' => 1200,
        'height' => 630,
        'mime-type' => $resized['mime-type'],
    ];
    wp_update_attachment_metadata($image_id, $metadata);
}
add_action('save_post', 'generate_custom_ogp_image_size_on_save_post');


// Function to retrieve the correct OGP image URL
function get_og_image_url()
{
    if (is_singular()) {
        $post_id = get_the_ID();

        // OPTIONAL - Get ACF field (as array), extract ID, then fallback to post thumbnail
        // $thumbimg = get_field('thumbimg', $post_id);
        // $thumbimg_id = $thumbimg['ID'] ?? null; // Extract ID from array
        // $thumbnail_id = get_post_thumbnail_id($post_id);
        // $image_id = $thumbimg_id ?: $thumbnail_id;
        //
        $thumbnail_id = get_post_thumbnail_id($post_id);
        $image_id = $thumbnail_id;

        if ($image_id) {
            // Get attachment metadata
            $metadata = wp_get_attachment_metadata($image_id);

            // Ensure 'ogp_image' size exists in metadata
            if ($metadata && isset($metadata['sizes']['ogp_image'])) {
                // Get the OGP image URL
                $ogp_image_url = wp_get_attachment_image_src($image_id, 'ogp_image');
                if ($ogp_image_url && !empty($ogp_image_url[0])) {
                    return esc_url($ogp_image_url[0]);
                }
            }
        }
    }

    // Fallback to default OGP image
    return esc_url(home_url('/ogp.jpg'));
}
