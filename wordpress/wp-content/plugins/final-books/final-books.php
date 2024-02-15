<?php
/**
 * Plugin Name: Books
 * Description: final project post type on books
 * Author: Julia Lenz
 * Text Domain: final-books
 *
 */


//this is the only thing that needs to be unique in our plugin
//to access anything in this plugin outside this plugin we use
//BookPlugin\function_name() or BookPlugin\ClassName
namespace BookPlugin;
//define plugin-level constants
define('TEXT_DOMAIN', 'final-books');
//include class files
include __DIR__ . '/classes/Singleton.php';
include __DIR__ . '/classes/BookPostType.php';
include __DIR__ . '/classes/BookCategoryTaxonomy.php';
include __DIR__ . '/classes/BookMeta.php';
include __DIR__ . '/classes/ReviewMeta.php';
include __DIR__ . '/classes/ReviewPostType.php';
require_once plugin_dir_path(__FILE__). "classes/BookWidget.php";
add_action('widgets_init', function(){
    register_widget('bookWidget');
});


BookPostType::getInstance();
BookCategoryTaxonomy::getInstance();
BookMeta::getInstance();
ReviewMeta::getInstance();
ReviewPostType::getInstance();

   //this will flush the permalink cache when plugin is activated
function activate_plugin(){
    $bookPostType = BookPostType::getInstance();
    $bookPostType->registerBookPostType();
// you can also use chaining
    BookCategoryTaxonomy::getInstance()->registerBookCategoryTaxonomy();
    ReviewPostType::getInstance()->registerReviewPostType();

    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'BookPlugin\activate_plugin');