<?php get_header(); ?>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8">
        <?php single_cat_title('Category: '); ?>
    </h1>

    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Categories</h2>
        <div class="flex flex-wrap gap-2">
            <?php
            $categories = get_categories();
            foreach($categories as $category) {
                $category_link = get_category_link($category->term_id);
                echo '<a href="' . $category_link . '" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-full text-sm ' . (is_category($category->term_id) ? 'bg-blue-500 text-white' : '') . '">';
                echo $category->name;
                echo ' (' . $category->count . ')';
                echo '</a>';
            }
            ?>
        </div>
    </div>

    <?php if (have_posts()) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php while (have_posts()) : the_post(); ?>
                <article class="bg-white p-6 rounded-lg shadow">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-4">
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover rounded']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h2 class="text-xl font-semibold mb-2">
                        <a href="<?php the_permalink(); ?>" class="hover:text-blue-600">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    
                    <div class="text-gray-600 mb-4">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </div>
                    
                    <div class="text-sm text-gray-500">
                        <?php echo get_the_date(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        
        <div class="mt-8 flex justify-center">
            <?php the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => 'prev',
                'next_text' => 'next',
                'class' => 'flex gap-2'
            )); ?>
        </div>
    <?php else : ?>
        <p class="text-gray-600">not found</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
