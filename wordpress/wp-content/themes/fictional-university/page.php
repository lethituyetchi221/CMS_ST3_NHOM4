<?php get_header() ?>
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/banner2.webp') ?>)"></div>
    <div class="page-banner__content container container--narrow">
        <div class="div1">
        <h1 class="page-banner__title">Our History</h1>
        <div class="page-banner__intro">
            <p>Learn how the school of your dreams got started.</p>
        </div>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <?php if (wp_get_post_parent_id(get_the_ID())) { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo site_url('/about-us') ?>">
                    <i class="fa fa-home" aria-hidden="true"></i> Back to About Us</a>
                <span class="metabox__main">Our History</span>
            </p>
        </div>
    <?php } ?>
</div>
<div class="container">
    <?php
    while (have_posts()) {
        the_post();
    ?>
        <h2><?php the_title(); ?></h2>
       <p class = "content"><?php the_content(); ?></p>
    <?php } ?>
</div>
<div class="col-4">
    <?php 
    $theParent = wp_get_post_parent_ID();
    if($theParent){
        $findChildOf = $theParent;
    }
    else{
        $findChildOf = get_the_ID();
    }
    wp_list_pages(array(
        'child_of'=>$findChildOf,
        'title_li'=> NULL
    ));
    echo paginate_links();
    ?>
</div>
<?php get_footer() ?>