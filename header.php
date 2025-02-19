<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-gray-50'); ?>>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <header class="container mx-auto px-4 py-12 text-center">
        <img src="https://bokumin45.server-on.net/images/favicon.ico" alt="<?php bloginfo('name'); ?>" class="rounded-full mx-auto mb-6">
        <h1 class="text-4xl font-bold mb-4">bokumin's net</h1>
        <div class="flex justify-center space-x-4 items-center">
    <a href="https://bokumin45.server-on.net/" class="text-gray-600
						      hover:text-gray-900
						      text-2xl font-bold mb-6 underline">
        Home
    </a>
    <span class="text-gray-400 text-2xl mb-6">/</span>
    <a href="https://bokumin45.server-on.net/blog" class="text-gray-900
							  hover:text-gray-900
							  text-2xl font-bold
							  mb-6 underline">
        Blog
    </a>
</div>

    </header>
