<?php get_header(); ?>

<div class="container mx-auto px-4 py-8 max-w-4xl">
    <h1 class="text-3xl font-bold mb-8">
        <?php single_tag_title('Tag: '); ?>
    </h1>

    <div class="mb-8">
        <button id="toggleTags" class="flex items-center gap-2 text-xl font-semibold mb-4 hover:text-blue-600 transition-colors">
            <span>Tags List</span>
            <svg id="toggleIcon" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>
        <div id="tagsContainer" class="flex flex-wrap gap-2">
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
                    <div class="absolute inset-0 z-0 opacity-40" style="display: flex; justify-content: flex-end; align-items: center;">
                        <?php the_post_thumbnail('thumbnail', [
                            'class' => 'w-auto h-auto max-w-[70%] max-h-[80%] object-contain mr-4',
                            'loading' => 'eager'
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleTags');
    const container = document.getElementById('tagsContainer');
    const icon = document.getElementById('toggleIcon');
    
    container.style.display = 'none';
    icon.style.transform = 'rotate(-90deg)';
    
    toggleBtn.addEventListener('click', function() {
        if (container.style.display === 'none') {
            container.style.display = 'flex';
            icon.style.transform = 'rotate(0deg)';
        } else {
            container.style.display = 'none';
            icon.style.transform = 'rotate(-90deg)';
        }
    });
});
</script>

<?php get_footer(); ?>
