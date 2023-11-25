<?php get_header() ?>
<div class="container">
  <div class="inputSearch">
    <?php get_search_form(); ?>
  </div>
</div>
<div class="container">
  <?php
  while (have_posts()) {
    the_post();
  ?>
    <h4> <a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
    <img width="200" src="<?php echo get_the_post_thumbnail_url(); ?>">
    <p class="excerpt"><?php the_excerpt(); ?></p>
    <hr>
  <?php
  }
  echo paginate_links();
  ?>
</div>
<?php get_footer(); ?>