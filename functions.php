<?php 

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles',99);
function child_enqueue_styles() {
    $parent_style = 'parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
     //wp_enqueue_style( 'child-style',get_stylesheet_directory_uri() . '/custom.css', array( $parent_style ));

    wp_enqueue_script('slick', get_stylesheet_directory_uri() . '/js/slick.min.js', array('jquery'), true );
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), true );

    // wp_enqueue_script( 'alizee-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), true );
}
