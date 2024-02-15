<?php

class BookWidget extends WP_Widget
{

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        $widget_ops = array(
            'classname' => 'my_widget',
            'description' => 'Displays all my little books!',
        );
        parent::__construct( 'jl_my_widget', 'Book Widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if(@$instance['title']){
            echo $args['before_title']. $instance['title']. $args['after_title'];
        }
        echo "<p>" . nl2br(@$instance['body']) . "</p>";

        //demo 2
        $queryObj = new WP_Query(

                array(
                        'post_type'=> 'any',
                        'posts_per_page'=>5,
                        'order_by'=> 'genre',
                        'meta_key'=> 'date',
                        'meta_value_num'=> 5,
                        'meta_compare'=>'<=',
                        'order'=>'DESC',
                        'post_status'=> 'publish',


                )
        );
        //the loop
        if($queryObj->have_posts()){
            echo"<ul>";
            while($queryObj->have_posts()){
                $queryObj->the_post();//retrieves post from the database into the "current post"
                echo "<li> <a href='". get_the_permalink(). "'>". get_the_title(). '<br> Published: '. get_post_meta(get_the_ID(), 'date', true). ' <br>'. get_post_meta(get_the_ID(), 'genre', true);"</a> </li>";
            }
            echo "</ul>";
        }

        //ALWAYS RESET
        wp_reset_postdata();

        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        $title = $instance['title'] ?? 'Default Title';
        $body = $instance['body'] ?? '';
        $cat = $instance['cat'] ?? '';

?>
<p>
    <label for="<?=$this->get_field_id('title')?>"><strong> Title</strong></label>
    <input type="text" id="<?=$this->get_field_id('title')?>"
    name="<?=$this->get_field_name('title')?>"
    class="widefat"
    value="<?=$title?>">

</p>

        <p>
            <label for="<?=$this->get_field_id('body')?>"> Body</label>
            <textarea
            <input type="text" id="<?=$this->get_field_id('body')?>"
                   name="<?=$this->get_field_name('body')?>"
                   class="widefat"> <?=$body ?></textarea>
        </p>
        <p>
            <?php wp_dropdown_categories([
                    'id'=> $this->get_field_id('cat'),
                    'name'=> $this->get_field_name('cat'),
                    'class'=> 'widefat',
                    'selected'=> $cat,
]) ?>


        </p>
<?php
 }
//meta_value_num
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        //create an instance to be saved
        $instance =[];


        //validate/sanitize
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['body'] =   htmlentities($new_instance['body']);
        $instance['cat'] = intval($new_instance['cat']);

       // return what we wnat saved in the database
        return $instance;
    }

}