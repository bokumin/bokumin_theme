<?php
function your_theme_styles() {
    wp_enqueue_style('your-theme-style', get_stylesheet_uri());
    
    wp_enqueue_style('tailwindcss', 'https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css');
    
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'your_theme_styles');

function your_theme_setup() {
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
add_action('after_setup_theme', 'your_theme_setup');


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
