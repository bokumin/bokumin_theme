<?php
function bokumin_theme_styles() {
    wp_enqueue_style('bokumin-theme-style', get_stylesheet_uri());
    wp_enqueue_style('tailwindcss', '/css/tailwind.min.css');
}
add_action('wp_enqueue_scripts', 'bokumin_theme_styles');

function bokumin_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'bokumin_theme_setup');

add_filter('navigation_markup_template', 'tailwind_pagination', 10, 2);
function tailwind_pagination($template, $class) {
    return '
    <nav class="navigation %1$s">
        <div class="nav-links flex flex-wrap gap-2 justify-center">%3$s</div>
    </nav>
    ';
}

add_filter('paginate_links', 'tailwind_paginate_links');
function tailwind_paginate_links($link) {
    if (strpos($link, 'current') !== false) {
        $link = str_replace('page-numbers', 'page-numbers bg-blue-500 text-white border-blue-500 px-4 py-2 rounded-md', $link);
    } else {
        $link = str_replace('page-numbers', 'page-numbers bg-white text-gray-700 hover:bg-gray-100 border border-gray-300 px-4 py-2 rounded-md', $link);
    }
    return $link;
}

function add_empty_block_after_each_block($content) {
    $pattern = '/<\/figure>|<\/blockquote>|<\/p>|<\/h[1-6]>|<\/ul>|<\/ol>|<\/pre>|<hr[^>]*>|<\/details>|<\/summary>/i';
    $replacement = '$0<p class="mb-2 leading-relaxed">&nbsp;</p>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
}
add_filter('the_content', 'add_empty_block_after_each_block', 20);

function custom_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        $query->set('posts_per_page', 8);
    }
}
add_action('pre_get_posts', 'custom_posts_per_page');

add_filter('jpeg_quality', function($quality, $context) {
    return 50;
}, 10, 2);

add_filter('wp_generate_attachment_metadata', function($metadata, $attachment_id, $context) {
    if ($context !== 'create') {
        return $metadata;
    }
    
    $file = get_attached_file($attachment_id);
    $mime_type = get_post_mime_type($attachment_id);
    
    if ($mime_type === 'image/png' && extension_loaded('gd')) {
        $image = imagecreatefrompng($file);
        if ($image) {
            imagepng($image, $file, 9);
            imagedestroy($image);
        }
    }
    
    return $metadata;
}, 10, 3);

add_filter('wp_get_attachment_image_attributes', function($attr, $attachment, $size) {
    if (!is_admin()) {
        $attr['loading'] = 'lazy';
        $attr['decoding'] = 'async';
    }
    return $attr;
}, 10, 3);

add_filter('upload_mimes', function($mime_types) {
    $mime_types['webp'] = 'image/webp';
    return $mime_types;
});
?>
