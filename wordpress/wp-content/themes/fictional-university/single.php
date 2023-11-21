<?php get_header() ?>
<div class="page-banner" style="background-image: url(<?php echo get_theme_file_uri('images/ocean.jpg') ?>)">
    <div class="page-banner__bg-image"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Our History</h1>
        <div class="page-banner__intro">
            <p>Learn how the school of your dreams got started.</p>
        </div>
    </div>
</div>
<div class="container">
    <?php
    while (have_posts()) {
        the_post();
    ?>
        <h3> <?php the_title() ?></h3>
        <p class="except"><?php the_content(); ?></p>
    <?php
    }
    ?>
    <div class="share-buttons">
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" rel="noopener noreferrer">
            Share on Facebook
        </a>
    </div>
    <?php
    // Kiểm tra xem có bình luận không
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
</div>
<?php get_footer() ?>