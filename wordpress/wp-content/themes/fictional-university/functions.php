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




