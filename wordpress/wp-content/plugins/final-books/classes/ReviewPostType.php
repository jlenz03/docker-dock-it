<?php

namespace BookPlugin;

class ReviewPostType extends Singleton
{
    const POST_TYPE = 'review';
    protected static $instance;

    protected function __construct()
    {
        add_action('init', array($this, 'registerReviewPostType'));
        add_filter('the_content', array($this, 'reviewContentTemplate'), 1);
    }

    public function registerReviewPostType()
    {

        $labels = array(
            'name' => _x('Reviews', 'Post Type General Name', TEXT_DOMAIN),
            'singular_name' => _x('Review', 'Post Type Singular Name', TEXT_DOMAIN),
            'menu_name' => __('Reviews', TEXT_DOMAIN),
            'name_admin_bar' => __('Reviews', TEXT_DOMAIN),
            'archives' => __('Review Archives', TEXT_DOMAIN),
            'attributes' => __('Review Attributes', TEXT_DOMAIN),
            'parent_item_colon' => __('Parent Review:', TEXT_DOMAIN),
            'all_items' => __('All Reviews', TEXT_DOMAIN),
            'add_new_item' => __('Add New Review', TEXT_DOMAIN),
            'add_new' => __('Add New', TEXT_DOMAIN),
            'new_item' => __('New Review', TEXT_DOMAIN),
            'edit_item' => __('Edit Review', TEXT_DOMAIN),
            'update_item' => __('Update Review', TEXT_DOMAIN),
            'view_item' => __('View Review', TEXT_DOMAIN),
            'view_items' => __('View Review', TEXT_DOMAIN),
            'search_items' => __('Search Review', TEXT_DOMAIN),
            'not_found' => __('Not found', TEXT_DOMAIN),
            'not_found_in_trash' => __('Not found in Trash', TEXT_DOMAIN),
            'featured_image' => __('Featured Image', TEXT_DOMAIN),
            'set_featured_image' => __('Set featured image', TEXT_DOMAIN),
            'remove_featured_image' => __('Remove featured image', TEXT_DOMAIN),
            'use_featured_image' => __('Use as featured image', TEXT_DOMAIN),
            'insert_into_item' => __('Insert into Review', TEXT_DOMAIN),
            'uploaded_to_this_item' => __('Uploaded to this Review', TEXT_DOMAIN),
            'items_list' => __('Reviews list', TEXT_DOMAIN),
            'items_list_navigation' => __('Reviews list navigation', TEXT_DOMAIN),
            'filter_items_list' => __('Filter Reviews list', TEXT_DOMAIN),
        );
        $args = array(
            'label' => __('Review', TEXT_DOMAIN),
            'description' => __('Reviews for books', TEXT_DOMAIN),
            'labels' => $labels,
            'supports' => array('title', 'editor'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'capability_type' => 'page',
            'show_in_rest' => true,
        );
        register_post_type(self::POST_TYPE, $args);


    }

    /**
     * @param $content
     * @return mixed|string
     */

    public function reviewContentTemplate($content){
        $post = get_post();
//only do this for recipes
       if($post->post_type == self::POST_TYPE) {
            $rating = get_post_meta($post->ID, ReviewMeta::RATING, true);
            $name = get_post_meta($post->ID, ReviewMeta::NAME, true);
           $city = get_post_meta($post->ID, ReviewMeta::CITY, true);
           $state = get_post_meta($post->ID, ReviewMeta::STATE, true);
           //$bookid = get_post_meta($post->ID, ReviewMeta::BOOKID, true);


            $content = '<h3 class="border-bottom py-2"> Description</h3>
                <div>' . $content . '</div>
                <br>
                <h3 class="border-bottom py-2">About</h3>
                <div>
                    <p>User:' . $name . '</p>
                    <br>
                     <p>Rating:' . $rating . '</p>
                      <br>
                      <p>Location:' . $city . ' ' . $state . '</p>
                     
                    </div>';
        }
        //regardless of post type, return the content
        return $content;
    }
}