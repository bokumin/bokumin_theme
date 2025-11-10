<?php get_header(); ?>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8">
        <?php single_cat_title('Category: '); ?>
    </h1>

    <div class="mb-12 pb-8 border-b border-gray-200">
        <div class="flex flex-wrap gap-3">
            <?php
            $current_category = get_queried_object();
            
            if ($current_category->parent == 0) {
                $child_categories = get_categories(array(
                    'parent' => $current_category->term_id,
                    'hide_empty' => true
                ));
                
                if ($child_categories) {
                    foreach($child_categories as $category) {
                        $category_link = get_category_link($category->term_id);
                        $is_current = is_category($category->term_id);
                        echo '<a href="' . $category_link . '" class="text-sm ' . ($is_current ? 'font-bold underline' : 'text-gray-600 hover:text-gray-900 hover:underline') . '">';
                        echo $category->name;
                        echo '</a>';
                    }
                } else {
                    $parent_categories = get_categories(array(
                        'parent' => 0,
                        'hide_empty' => true
                    ));
                    foreach($parent_categories as $category) {
                        $category_link = get_category_link($category->term_id);
                        $is_current = is_category($category->term_id);
                        echo '<a href="' . $category_link . '" class="text-sm ' . ($is_current ? 'font-bold underline' : 'text-gray-600 hover:text-gray-900 hover:underline') . '">';
                        echo $category->name;
                        echo '</a>';
                    }
                }
            } else {
                $sibling_categories = get_categories(array(
                    'parent' => $current_category->parent,
                    'hide_empty' => true
                ));
                
                foreach($sibling_categories as $category) {
                    $category_link = get_category_link($category->term_id);
                    $is_current = is_category($category->term_id);
                    echo '<a href="' . $category_link . '" class="text-sm ' . ($is_current ? 'font-bold underline' : 'text-gray-600 hover:text-gray-900 hover:underline') . '">';
                    echo $category->name;
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
    
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
        <p class="text-gray-600">not found</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
