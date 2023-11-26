<?php get_header(); ?>
<div class="container">
  <div class="inputSearch">
    <?php get_search_form(); ?>
  </div>
</div>
<div class="container">
  <img src="<?php echo get_theme_file_uri('images/banner.png') ?>" alt="" class="w-100">
</div>
<div class="container my-2">
  <h3 class="mt-2 text-center">Các loại sản phẩm</h3>
  <div class="row">
    <?php
    $my_queries = new WP_Query(array(
      'post_type' => 'product',
    ));

    while ($my_queries->have_posts()) {
      $my_queries->the_post();
      global $product;
    ?>
      <div class="col-md-3 py-2">
        <h5><?php the_title(); ?></h5>
        <?php
        // Hiển thị hình ảnh sản phẩm
        echo get_the_post_thumbnail($post->ID, 'thumbnail');

        // Hiển thị giá sản phẩm
        echo '<p class="p-0 m-0">' . $product->get_price_html() . '</p>';

        // Hiển thị liên kết chi tiết sản phẩm
        echo '<p class="p-0 m-0"><a href="' . esc_url(get_permalink()) . '">Xem chi tiết</a></p>';

        // Hiển thị nút "Thêm vào giỏ hàng"
        echo apply_filters(
          'woocommerce_loop_add_to_cart_link',
          sprintf(
            '<a class="btn btn-secondary px-2 p-0" href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
            esc_url($product->add_to_cart_url()),
            esc_attr($product->get_id()),
            esc_attr($product->get_sku()),
            $product->is_purchasable() ? 'add_to_cart_button' : '',
            esc_attr($product->product_type),
            esc_html($product->add_to_cart_text())
          ),
          $product
        );
        ?>
      </div>
    <?php
    }
    wp_reset_postdata(); // Đặt lại truy vấn sau khi sử dụng vòng lặp
    ?>
  </div>
</div>

<div class="container my-2">
  <h3 class="mt-2 text-center">Bài Viết</h3>
  <div class="row">
    <?php
    $my_queries = new WP_Query(array(
      'post_type' => 'post', // Đặt 'post_type' thành 'post' để lấy bài viết
    ));

    while ($my_queries->have_posts()) {
      $my_queries->the_post();
    ?>
      <div class="col-md-3">
        <h5><?php the_title(); ?></h5>
        <?php
        // Hiển thị hình ảnh đặc trưng của bài viết
        if (has_post_thumbnail()) {
          the_post_thumbnail('thumbnail');
        }

        // Hiển thị phần mô tả hoặc nội dung ngắn gọn của bài viết
        echo '<p class="p-0 m-0">' . get_the_excerpt() . '</p>';

        // Hiển thị liên kết chi tiết bài viết
        echo '<p class="p-0 m-0"><a href="' . esc_url(get_permalink()) . '">Xem chi tiết</a></p>';
        ?>
      </div>
    <?php
    }
    wp_reset_postdata(); // Đặt lại truy vấn sau khi sử dụng vòng lặp
    ?>
  </div>
</div>
<?php get_footer(); ?>