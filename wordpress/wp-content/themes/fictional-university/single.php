<?php get_header() ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('banner2.webp') ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Our History</h1>
        <div class="page-banner__intro">
            <p>Learn how the school of your dreams got started.</p>
        </div>
    </div>
</div>
    <div class="container">
        <?php 
        while(have_posts()){
            the_post();
            ?>
            <h3> <?php the_title() ?></h3>
                <p class = "except"><?php the_content();?></p>
     <?php
        }
        ?>
    </div>
<?php get_footer() ?>