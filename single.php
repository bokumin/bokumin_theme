<?php get_header(); ?>
<main class="container mx-auto px-4 py-8 max-w-4xl">
<style>
.meta-links a {
    color: #111827;
    text-decoration: underline;
    text-underline-offset: 2px;
}
</style>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article class="bg-white rounded-lg shadow-lg p-8 mb-12">
<header class="mb-12">
<h1 class="text-3xl font-bold mb-8"><?php the_title(); ?></h1>
<div class="text-gray-600 mb-4">
                <div class="flex flex-wrap items-center gap-4 mb-2">
                    <time datetime="<?php echo get_the_date('c'); ?>" class="flex items-center text-gray-500" title="Published">
                        Published:&nbsp;<span class="text-gray-900"><?php echo get_the_date('Y/m/d H:i'); ?></span>
                    </time>
                    <?php if ( get_the_date('Ymd') !== get_the_modified_date('Ymd') ) : ?>
                    <time datetime="<?php echo get_the_modified_date('c'); ?>" class="flex items-center text-gray-500" title="Update">
                       Update:&nbsp;<span class="text-gray-900"><?php echo get_the_modified_date('Y/m/d H:i'); ?></span>
                    </time>
                    <?php endif; ?>
                </div>
                
                <div class="flex flex-wrap items-center gap-4 meta-links text-gray-500">
                    <?php if (has_category()) : ?>
                    <div class="flex items-center">
                        Category:&nbsp;<?php the_category(', '); ?>
                    </div>
                    <?php endif; ?>

                    <?php if (has_tag()) : ?>
                    <div class="flex flex-wrap gap-2">
                        Tag:<?php the_tags('', ' ', ''); ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <div class="prose max-w-none">
            <?php the_content(); ?>
        </div>

        <footer class="mt-12 pt-6 border-t border-gray-200">
            <nav class="flex flex-wrap justify-between gap-4">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post); ?>" class="flex items-center text-teal-500 hover:text-teal-700 underline">
                        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Prev
                    </a>
                <?php endif; ?>
                
                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post); ?>" class="flex items-center text-teal-500 hover:text-teal-700 underline">
                        Next
                        <svg class="w-6 h-6 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                <?php endif; ?>
            </nav>
        </footer>
    </article>
<?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
