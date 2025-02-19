<?php get_header(); ?>
<main class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-8">
        <?php printf('「%s」の検索結果', get_search_query()); ?>
    </h2>

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
                <h2 class="text-2xl font-bold mb-6">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h2>
                <div class="text-gray-600 mb-4">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
    
    <!-- ページネーション -->
    <div class="pagination flex justify-center items-center my-12">
        <?php
        $big = 999999999;
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'type' => 'list',
        ));
        ?>
    </div>
    
    <?php else : ?>
        <p class="text-center text-gray-600">検索結果が見つかりませんでした。</p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
