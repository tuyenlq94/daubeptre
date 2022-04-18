<?php
// Creating the widget 
class contact_widget extends WP_Widget {
  
    function __construct() {
        parent::__construct(
        'wpb_widget_contact', __('Mona - Image', 'wpb_widget_domain'), 
            array( 
                'description' => __( 'Dev Monamedia Add Custom Widget', 'wpb_widget_domain' ), ) 
        );
    }
      
    public function widget( $args, $instance ) {
        $widget_id = $args['widget_id'];
        $widget__title = get_field('widget__title', 'widget_' .$widget_id);
        $widget__content = get_field('gallery_hinh_anh', 'widget_' .$widget_id);
        ?>
        <ul>
        <?php 
                if(is_array($widget__content)) {
                    foreach($widget__content as $item) {
                ?>
          <li>
            <a href="<?php echo $item['link_toi_anh_image'] ?>">
             <?php $image =$item['hinh_anh_footer_widget'];
             $size='full';
             echo wp_get_attachment_image($image,$size) ?>
            </a>
          </li>
          <?php }} ?>
          
        </ul>
        <?php
    }
              
    // Widget Backend 
    public function form( $instance ) {
        // No content
    }
          
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        // No content
    }
   
} 
    
    // Register and load the widget
function wpb_load_widget_contact() {
    register_widget( 'contact_widget' );
    
}
add_action( 'widgets_init', 'wpb_load_widget_contact' );