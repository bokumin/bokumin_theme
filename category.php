<?php get_header(); ?>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8">
        <?php single_tag_title('Tag: '); ?>
    </h1>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Tags</h2>
        <div class="flex flex-wrap gap-2">
            <?php
            $tags = get_tags(array(
                'hide_empty' => true
            ));
            if ($tags) {
                foreach($tags as $tag) {
                    $tag_link = get_tag_link($tag->term_id);
                    echo '<a href="' . $tag_link . '" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full text-sm ' . (is_tag($tag->term_id) ? 'bg-blue-500 text-white' : '') . '">';
                    echo $tag->name;
                    echo ' (' . $tag->count . ')';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
    
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article class="relative bg-white rounded-lg shadow-lg p-8 mb-12 overflow-hidden">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="absolute inset-0 z-0 opacity-10 flex justify-end items-center">
                        <?php the_post_thumbnail('large', [
                            'class' => 'w-auto h-auto max-w-[70%] max-h-[80%] object-contain mr-4'
                        ]); ?>
                    </div>
                <?php endif; ?>
                
                <div class="relative z-10">
                    <h2 class="text-2xl font-bold mb-6 underline">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <div class="text-sm text-gray-500 mb-2">
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                    </div>
                    
                    <div class="text-gray-600 mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </div>
                </div>
            </article>
        <?php endwhile; ?>
        
        <div class="mt-8 flex justify-center">
            <?php the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => 'Prev',
                'next_text' => 'Next',
                'class' => 'flex gap-2'
            )); ?>
        </div>
    <?php else : ?>
        <p class="text-gray-600">not found</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
