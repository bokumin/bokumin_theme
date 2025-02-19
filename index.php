<?php get_header(); ?>
<main class="container mx-auto px-4 py-8 max-w-4xl">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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

<div class="text-sm mb-2">
    <?php
    $categories = get_the_category();
    if ($categories) {
        echo '<span class="text-gray-600">Category: </span>';
        $cat_links = array();
        foreach ($categories as $category) {
            $cat_links[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="underline">' . esc_html($category->name) . '</a>';
        }
        echo implode(', ', $cat_links);
    }
    ?>
</div>

<div class="text-sm mb-6">
    <?php
    $tags = get_the_tags();
    if ($tags) {
        echo '<span class="text-gray-600">Tag: </span>';
        $tag_links = array();
        foreach ($tags as $tag) {
            $tag_links[] = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="underline">' . esc_html($tag->name) . '</a>';
        }
        echo implode(', ', $tag_links);
    }
    ?>
</div>
                <div class="text-gray-600 mb-4">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
    
    <div class="pagination flex justify-center items-center my-12">
        <?php
        $big = 999999999; // need an unlikely integer
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type' => 'list',
        ) );
        ?>
    </div>
    
    <?php else : ?>
        <p>not found</p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
