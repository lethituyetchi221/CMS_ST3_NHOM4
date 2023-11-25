<?php

/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php _e('404 Not Found', 'textdomain'); ?></h1>
            </header>

            <div class="page-content">
                <p><?php _e('It looks like nothing was found at this location. Maybe try a search?', 'textdomain'); ?></p>

                <div class="inputSearch">
                    <?php get_search_form(); ?>
                </div>

                <?php
                // Redirect to custom 404 page
                $custom_404_url = get_permalink();
                wp_redirect($custom_404_url);
                exit;
                ?>
            </div>
        </section>
    </main>
</div>

<?php get_footer(); ?>