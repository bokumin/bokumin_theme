<footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="mb-8 md:mb-0">
                <h3 class="text-xl font-semibold mb-4">Search</h3>
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <div class="relative">
                        <input type="search" 
                               class="w-full px-4 py-2 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-gray-500 text-white"
                               placeholder="Search..."
                               value="<?php echo get_search_query(); ?>"
                               name="s">
                        <button type="submit" 
                                class="absolute right-0 top-0 mt-2 mr-4 text-gray-400 hover:text-white">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
            <p data-i18n="copyright">&copy; 2024 bokumin. All rights reserved.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
