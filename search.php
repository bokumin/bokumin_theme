<?php get_header(); ?>
<main class="container mx-auto px-4 py-8 max-w-4xl">
    <h2 class="text-3xl font-bold mb-8">
        <?php printf('「%s」の検索結果', get_search_query()); ?>
    </h2>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="relative bg-white rounded-lg shadow-lg p-4 mb-6 overflow-hidden">

            <?php if (has_post_thumbnail()) : ?>
                <div style="position: absolute; bottom: 8px; right: 8px; z-index: 0; opacity: 0.3;">
                    <?php the_post_thumbnail('thumbnail', [
                        'class' => 'w-20 h-20 object-cover rounded-lg',
                        'loading' => 'lazy'
                    ]); ?>
                </div>
            <?php endif; ?>

            <div class="relative z-10">
                <h2 class="text-2xl font-bold mb-3 underline">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>

                <div class="text-gray-600 mb-2">
                    <?php
                    $blocks = parse_blocks(get_the_content());
                    $output = '';
                    $output .= render_block($blocks[0]);
                    echo wp_trim_words($output, 80, '...');
                    ?>
                </div>

                <div class="text-sm text-gray-500 mb-1">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <?php echo get_the_date(); ?>
                    </time>
                </div>

                <div class="text-sm mb-1">
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

                <div class="text-sm mb-2">
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

    <div class="pagination flex justify-center items-center my-8">
        <?php
        $big = 999999999;
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
        <p class="text-center text-gray-600">検索結果が見つかりませんでした。</p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
