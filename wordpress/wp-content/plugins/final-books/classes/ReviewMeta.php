<?php

namespace BookPlugin;

class ReviewMeta extends Singleton
{
    const NAME ='name';
    const CITY ='city';
    const STATE ='state';
    const RATING ='rating';
    //const BOOKID ='bookid';

    //name, state, rating, book id

    protected static $instance;


    protected function __construct(){
        add_action('admin_init', array($this, 'registerMetaBoxes'));
        add_action('save_post_' . ReviewPostType:: POST_TYPE, array($this,'saveReviewMeta'));
    }

    public function registerMetaBoxes(){
        add_meta_box(
            'review_directions_meta',
            'Directions',
            array($this, 'directionsMetaBox'),
            ReviewPostType::POST_TYPE,
            'side');


        }

        public function directionsMetaBox(){
        //get current post and meta values
        $post = get_post();
        $rating = get_post_meta($post->ID, self::RATING, true);
        $name = get_post_meta($post->ID, self::NAME, true);
        $city = get_post_meta($post->ID, self::CITY, true);
        $state = get_post_meta($post->ID, self::STATE, true);
        //$bookid = get_post_meta($post->ID, self::BOOKID, true);
        ?>
            <p>
                <!--how the heck to I make the rating into radio buttons?? am i dumb??-->
               <label for="rating"> Rating: </label>
                <select name="rating" id="rating" value="<?= $rating?>">
                    <option value="&starf;"> &starf; </option>
                    <option value="&starf;&starf;"> &starf;&starf;</option>
                    <option value="&starf;&starf;&starf;"> &starf;&starf;&starf;</option>
                    <option value="&starf;&starf;&starf;&starf;"> &starf;&starf;&starf;&starf;</option>
                    <option value="&starf;&starf;&starf;&starf;&starf;"> &starf;&starf;&starf;&starf;&starf;</option>
                </select>
<br>
                <label for="name"> Name: </label>
                <input type="text" name="name" id="name" value="<?= $name ?>">
<br>
                <label for="name"> Location: </label>
                <input type="text" name="city" id="city" value="<?= $city ?>">
                <input type="text" name="state" id="state" value="<?= $state ?>">
<br>
               <p> Select a Book:
                <select name="book">
                    <?php $query = new \WP_Query([
                            'author' => get_the_author('ID') ,
                            'post_type' => 'book'
                    ]);
                    while($query->have_posts()) {
                        $query->the_post();


                    ?>
                    <option value="<?php the_title()?>"> <?php the_title(); ?> </option>
                    <?php }
    ?>

                </select>



            </p>

<?php
        }
        public function saveReviewMeta()
        {

//get the current post
            $post = get_post();
            //get and save each field individually
            if (isset($_POST['rating'])) {
                $rating = sanitize_text_field($_POST['rating']);

                //insert/update database
                update_post_meta($post->ID, self::RATING, $rating);
    }
            if (isset($_POST['name'])) {
                $name = sanitize_text_field($_POST['name']);

                //insert/update database
                update_post_meta($post->ID, self::NAME, $name);
            }

            if (isset($_POST['state'])) {
                $state = sanitize_text_field($_POST['state']);

                //insert/update database
                update_post_meta($post->ID, self::STATE, $state);
            }

//            if (isset($_POST['bookid'])) {
//                $bookid = sanitize_text_field($_POST['bookid']);
//
//                //insert/update database
//                update_post_meta($post->ID, self::BOOKID, $bookid);
//            }

        }
}