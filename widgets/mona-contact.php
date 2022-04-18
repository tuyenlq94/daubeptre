<?php
/* ----------------------------------------------------------------------------------- */
/* Setting Contact Form */
/* ----------------------------------------------------------------------------------- */

class Mona_contact extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'Mona_contact',
            'description' => esc_html__('Displaying your contact information', 'monamedia'));
        $control_ops = array(
            'width' => 250,
            'height' => 100);
        parent::__construct('Mona_contact', esc_html__('Mona Contact', 'monamedia'), $widget_ops, $control_ops);
    }

    // display the widget in the theme
    function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $img = strip_tags($instance['image']);
        $name = strip_tags($instance['name']);
        $mail = strip_tags($instance['mail']);
        $phone = strip_tags($instance['phone']);
        $address = strip_tags($instance['address']);

        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        ?>		
        <?php
        if($img !=''){
            echo '<div class="img">'.  wp_get_attachment_image($img,'full').'</div>';
        }
        ?>
          
          <div class="logo-ct">
            <h4><?php echo $name; ?></h4>
            <?php
            if($address !=''){
                echo '<p><i class="fa fa-map-marker"></i>'.$address.'</p>';
            }
            if($phone !=''){
                $phone_html = str_replace(array(' ','.','-'), array('','',''), $phone);
                echo '<p><i class="fa fa-phone-square"></i><a href="tel:'.$phone_html.'">'.$phone.'</a></p>';
            }
            if($mail !=''){
                echo '<p><i class="fa fa-envelope"></i><a href="mailto:'.$mail.'">'.$mail.'</a></p>';
            }
            ?>
          </div>
        
        <?php
        echo $args['after_widget'];

        //end
    }

    // update the widget when new options have been entered
    function update($new_instance, $old_instance) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['name'] = strip_tags($new_instance['name']);
        $instance['mail'] = strip_tags($new_instance['mail']);
        $instance['phone'] = strip_tags($new_instance['phone']);
        $instance['address'] = strip_tags($new_instance['address']);
        return $instance;
    }

    // print the widget option form on the widget management screen
    function form($instance) {
        // combine provided fields with defaults
        $instance = wp_parse_args((array) $instance, array(
            'title' => 'Contact Info',
            'image' => '',
            'name' => '',
            'mail' => '',
            'phone' => '',
            'address' => '',));
        $img = strip_tags($instance['image']);
        $name = strip_tags($instance['name']);
        $mail = strip_tags($instance['mail']);
        $phone = strip_tags($instance['phone']);
        $address = strip_tags($instance['address']);
        $title = strip_tags($instance['title']);
        // print the form fields
        wp_enqueue_media();
        ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'monamedia'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php
            echo
            esc_attr($title);
            ?>" /></p>
        <p><label for="<?php echo esc_attr($this->get_field_id('image')); ?>">
                <?php esc_html_e('Image:', 'monamedia'); ?></label>
        <div class="mona-image-view">
            <?php
            if ($img != '') {
                echo wp_get_attachment_image($img, 'thumbnail');
            }
            ?>
        </div>
        <input class="widefat mona-img-val" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('image')); ?>" type="hidden" value="<?php
        echo
        esc_attr($name);
        ?>" />
        <button type="button" class="button mona-media-select">Thêm Ảnh</button>
        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('name')); ?>">
                <?php esc_html_e('Name:', 'monamedia'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('name')); ?>" name="<?php echo esc_attr($this->get_field_name('name')); ?>" type="text" value="<?php
            echo
            esc_attr($name);
            ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('mail')); ?>">
                <?php esc_html_e('Mail:', 'monamedia'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('mail')); ?>" name="<?php echo esc_attr($this->get_field_name('mail')); ?>" type="text" value="<?php
            echo
            esc_attr($mail);
            ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('phone')); ?>">
                <?php esc_html_e('Phone:', 'monamedia'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php
            echo
            esc_attr($phone);
            ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id('address')); ?>">
                <?php esc_html_e('Address:', 'monamedia'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" type="text" value="<?php
                   echo
                   esc_attr($address);
                   ?>" /></p>
        <style>
            .mona-image-view img{
                max-width: 100%;
            }
        </style>
        <script>
            jQuery(document).ready(function ($) {
                // Uploading files
                var file_frame;
                jQuery('.mona-media-select').on('click', function (event) {
                    var $this = $(this);
                    event.preventDefault();
                    // Create the media frame.
                    file_frame = wp.media({
                        title: 'Select a image to upload',
                        button: {
                            text: 'Use this image',
                        },
                        multiple: false	// Set to true to allow multiple files to be selected
                    }).open().on('select', function () {
                        // We set multiple to false so only get one image from the uploader
                        var attachment = file_frame.state().get('selection').first().toJSON();
                        $this.closest('.widget-content').find('.mona-image-view').html('<img src="' + attachment.url + '">');
                        $this.closest('.widget-content').find('.mona-img-val').val(attachment.id);
                    });
                    // Finally, open the modal
                    
                });

            });
        </script>
        <?php
    }

}
