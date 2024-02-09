<?php
//prefix functions with the name of the theme/plugin/etc
function lifestylepress_enqueue_styles(){
    $theme = wp_get_theme();
    //dequeue the parent stylesheet

    wp_dequeue_style('radiate style');

    // enqueue real parent stylesheet
    wp_enqueue_style( 'lifestylepress-parent-style', get_template_directory_uri()  . '/style.css'
        , [],
        $theme->parent()->get('Version')
    );

    //enqueue child theme overrides
    wp_enqueue_style( 'lifestylepress-child-style', get_stylesheet_uri(),
        ['lifestylepress-parent-style'],
        $theme->get('Version')
    );
}


// call our function when WP is ready to enqueue styles
//set the priority to 100 to make sure ours runs after the parent
add_action('wp_enqueue_scripts', 'lifestylepress_enqueue_styles', 100);


add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', 11 );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri() );
}
wp_enqueue_style('Arvo-font', 'https://fonts.googleapis.com/css2?family=Playfair+Display&family=Raleway:wght@300&display=swap" rel="stylesheet', array(), null);
wp_enqueue_style('Mulish-font', 'https://fonts.gstatic.com" crossorigin> <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Raleway:wght@300&display=swap" rel="stylesheet"', array(), null);


add_action("adverts_template_load2", "radiate_override_templates");




