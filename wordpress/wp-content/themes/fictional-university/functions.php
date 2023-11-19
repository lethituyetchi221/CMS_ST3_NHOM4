<?php
add_theme_support( 'title-tag' );
//them logo cho trang
add_theme_support( 'custom-logo', array(
    'height' => 100,
    'width'  => 100,
    'flex-width' => true
) );
//add_theme_support( 'custom-header' );
 add_filter('header_image_position', 'my_custom_logo_position');
 // câu lệnh thêm ảnh đại diện cho bài viết
 add_theme_support( 'post-thumbnails' );
function my_theme_support()
{
    add_theme_support('post-thumbnails');
    add_theme_support('add_custom_image_header');
    //thanh nav header
    register_nav_menu('headerMenuLocation','Header Menu Location');
    //thanh nav footer
    register_nav_menu('footerMenuLocation','Footer Menu Location');

}
add_action('after_setup_theme','my_theme_support');

function university_files()
{
    wp_enqueue_style('google-font', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i" rel="stylesheet');
    wp_enqueue_style('google-font', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"');
    wp_enqueue_style('main-style',get_theme_file_uri('/build/index.css'));
    wp_enqueue_style('second-style',get_theme_file_uri('/build/style-index.css'));
    //load JS
     //wp_enqueue_script('main-js'.get_theme_file_url('/build/index.js'). array('jquery').'1.0');
}
add_action('wp_enqueue_scripts','university_files');

function university_features() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme','university_features');



//add_action('admin_bar_menu', 'my_test', 11);
//function my_test(){
//echo "This text is hook to admin_bar_menu hook";
//}

//Action hook
add_action('wp_footer', 'my_test');
function my_test() {
    echo '<div>Chao mung hello   ban den voi footer</div>';
}

//filter hook
/*
 * Thay chữ Sale thành phần trăm (%) giảm giá
 * 
 */
add_filter('woocommerce_sale_flash', 'devvn_woocommerce_sale_flash', 10, 3);
function devvn_woocommerce_sale_flash($html, $post, $product){
    return '<span class="onsale"><span>' . devvn_presentage_bubble($product) . '</span></span>';
}
function devvn_presentage_bubble( $product ) {
    $post_id = $product->get_id();
    if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) ) {
        $regular_price  = $product->get_regular_price();
        $sale_price     = $product->get_sale_price();
        $bubble_content = round( ( ( floatval( $regular_price ) - floatval( $sale_price ) ) / floatval( $regular_price ) ) * 100 );
    } elseif ( $product->is_type( 'variable' ) ) {
        if ( $bubble_content = devvn_percentage_get_cache( $post_id ) ) {
            return devvn_percentage_format( $bubble_content );
        }
        $available_variations = $product->get_available_variations();
        $maximumper           = 0;
        for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
            $variation_id     = $available_variations[ $i ]['variation_id'];
            $variable_product = new WC_Product_Variation( $variation_id );
            if ( ! $variable_product->is_on_sale() ) {
                continue;
            }
            $regular_price = $variable_product->get_regular_price();
            $sale_price    = $variable_product->get_sale_price();
            $percentage    = round( ( ( floatval( $regular_price ) - floatval( $sale_price ) ) / floatval( $regular_price ) ) * 100 );
            if ( $percentage > $maximumper ) {
                $maximumper = $percentage;
            }
        }
        $bubble_content = sprintf( __( '%s', 'woocommerce' ), $maximumper );
        devvn_percentage_set_cache( $post_id, $bubble_content );
    } else {
        $bubble_content = __( 'Sale!', 'woocommerce' );
        return $bubble_content;
    }
    return devvn_percentage_format( $bubble_content );
}
function devvn_percentage_get_cache( $post_id ) {
    return get_post_meta( $post_id, '_devvn_product_percentage', true );
}
function devvn_percentage_set_cache( $post_id, $bubble_content ) {
    update_post_meta( $post_id, '_devvn_product_percentage', $bubble_content );
}
//Định dạng kết quả dạng -{value}%. Ví dụ -20%
function devvn_percentage_format( $value ) {
    return str_replace( '{value}', $value, '-{value}%' );
}
// Xóa cache khi sản phẩm hoặc biến thể thay đổi
function devvn_percentage_clear( $object ) {
    $post_id = 'variation' === $object->get_type()
        ? $object->get_parent_id()
        : $object->get_id();
    delete_post_meta( $post_id, '_devvn_product_percentage' );
}
add_action( 'woocommerce_before_product_object_save', 'devvn_percentage_clear' );



