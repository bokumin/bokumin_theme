<?php
function bokumin_theme_styles() {
    wp_enqueue_style('tailwindcss', '/css/tailwind.min.css', array(), '1.0');
    wp_enqueue_style('bokumin-theme-style', get_stylesheet_uri(), array('tailwindcss'), '1.1');
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

function custom_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        $query->set('posts_per_page', 10);
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

function custom_details_style() {
    ?>
    <style>
        .wp-block-details summary,
        details summary {
            font-weight: bold;
            cursor: pointer;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #9ca3af;
            margin-bottom: 1rem;
        }
        .wp-block-details summary:hover,
        details summary:hover {
            color: #9ca3af ;
        }
    </style>
    <?php
}
add_action('wp_head', 'custom_details_style');

add_filter('embed_oembed_html', 'custom_tailwind_embed_wrapper', 10, 3);
function custom_tailwind_embed_wrapper($html, $url, $attr) {
    if (strpos($html, '<iframe') === false) {
        return $html;
    }

    $is_video = (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false || strpos($url, 'vimeo.com') !== false);
    
    if ($is_video) {
        return '<div class="my-8 rounded-xl overflow-hidden shadow-lg aspect-w-16 aspect-h-9 relative" style="padding-bottom: 56.25%; height: 0;">' . $html . '</div>';
    } else {
        return '<div class="wp-embed-custom-wrapper my-6 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300">' . $html . '</div>';
    }
}

function custom_embed_parent_styles() {
    ?>
    <style>
        .aspect-w-16 iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100% !important;
            height: 100% !important;
        }
        
        .wp-embed-custom-wrapper iframe {
            width: 100% !important;
            margin: 0 !important;
            border: none !important;
            min-height: 180px; 
        }
    </style>
    <?php
}
add_action('wp_head', 'custom_embed_parent_styles');

function custom_embed_iframe_inner_styles() {
    echo '<style>
        body {
            background-color: #fff !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .wp-embed { 
            border: none !important; 
            border-radius: 0 !important; 
            padding: 20px !important; 
            box-shadow: none !important; 
            font-family: "Helvetica Neue", Arial, sans-serif !important;
        }
        .wp-embed-heading { 
            font-size: 1.1rem !important; 
            font-weight: 700 !important; 
            margin-bottom: 0.5rem !important;
            color: #1f2937 !important;
        }
        .wp-embed-heading a {
            text-decoration: none !important;
            color: inherit !important;
        }
        .wp-embed-excerpt {
            color: #4b5563 !important;
            font-size: 0.9rem !important;
            line-height: 1.6 !important;
        }
        .wp-embed-site-title,
        .wp-embed-meta { 
            display: none !important; 
        } 
        .wp-embed-featured-image { 
            margin-bottom: 1rem !important; 
        }
        .wp-embed-featured-image img {
            border-radius: 6px !important;
        }
    </style>';
}
add_action('embed_head', 'custom_embed_iframe_inner_styles');
