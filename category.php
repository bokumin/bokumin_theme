<?php get_header(); ?>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8">
        <?php single_cat_title('Category: '); ?>
    </h1>

    <div class="mb-12 pb-8 border-b border-gray-200">
        <div class="flex flex-wrap gap-3">
            <?php
            $categories = get_categories(array(
                'hide_empty' => true
            ));
            if ($categories) {
                foreach($categories as $category) {
                    $category_link = get_category_link($category->term_id);
                    $is_current = is_category($category->term_id);
                    echo '<a href="' . $category_link . '" class="text-sm ' . ($is_current ? 'font-bold underline' : 'text-gray-600 hover:text-gray-900 hover:underline') . '">';
                    echo $category->name . ' (' . $category->count . ')';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="relative bg-white rounded-lg shadow-lg p-8 mb-12 overflow-hidden">

            <?php if (has_post_thumbnail()) : ?>
                <div style="position: absolute; bottom: 16px; right: 16px; z-index: 0; opacity: 0.3;">
                    <?php the_post_thumbnail('thumbnail', [
                        'class' => 'w-20 h-20 object-cover rounded-lg',
                        'loading' => 'lazy'
                    ]); ?>
                </div>
            <?php endif; ?>

            <div class="relative z-10">
                <h2 class="text-2xl font-bold mb-6 underline">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="text-gray-600 mb-4">
                    <?php
                    $blocks = parse_blocks(get_the_content());
                    $output = '';
                    $output .= render_block($blocks[0]);
                    echo wp_trim_words($output, 80, '...');
                    ?>
                </div>

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
        <p class="text-gray-600">not found</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
