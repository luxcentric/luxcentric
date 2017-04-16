<?php 

// Creating the social media profile widget 
class My_Social_Media_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'class_name' => 'Social Media Profiles',
			'description' => 'Links to Author social media profile',
		);			
		parent::__construct( 'social_media_widget', 'Social Networks Profiles', $widget_ops );
	}

	// Creating widget front-end
	// This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters('widget_title', $instance['title']);
        $facebook = $instance['facebook'];
        $twitter = $instance['twitter'];
        $google = $instance['google'];
        $linkedin = $instance['linkedin'];
        $pinterest = $instance['pinterest'];
        $youtube = $instance['youtube'];
        $vimeo = $instance['vimeo'];
        $instagram = $instance['instagram'];
        $emailto = $instance['emailto'];
        $rss = $instance['rss'];
 
		// social profile link
        $facebook_profile = '<li><a class="facebook" href="' . $facebook . '" title="Facebook" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-facebook fa-stack-1x fa-inverse"></i></span></a></li>';
        $twitter_profile = '<li><a class="twitter" href="' . $twitter . '" title="Twitter" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i></span></a></li>';
        $google_profile = '<li><a class="google" href="' . $google . '" title="Google+" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-google-plus fa-stack-1x fa-inverse"></i></span></a></li>';
        $linkedin_profile = '<li><a class="linkedin" href="' . $linkedin . '" title="Linkedin" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-linkedin fa-stack-1x fa-inverse"></i></span></a></li>';
        $pinterest_profile = '<li><a class="pinterest" href="' . $pinterest . '" title="Pinterest" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i></span></a></li>';
        $youtube_profile = '<li><a class="youtube" href="' . $youtube . '" title="YouTube" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-youtube fa-stack-1x fa-inverse"></i></span></a></li>';
        $vimeo_profile = '<li><a class="vimeo" href="' . $vimeo . '" title="Vimeo" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-vimeo fa-stack-1x fa-inverse"></i></span></a></li>';
        $instagram_profile = '<li><a class="instagram" href="' . $instagram . '" title="Instagram" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-instagram fa-stack-1x fa-inverse"></i></span></a></li>';
        $emailto_profile = '<li><a class="emailto" href="mailto:' . $emailto . '" title="Email Me" target="_blank"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></a></li>';
        $rss_profile = '<li><a class="rss" href="' . $rss . '" title="rss"><span class="fa-stack"><i class="fa fa-circle fa-stack-2x"></i><i class="fa fa-rss fa-stack-1x fa-inverse"></i></span></a></li>';
 
		echo $args['before_widget'];
		if (!empty($title)) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
 
        echo '<div class="social-icons"><ul>';
        echo (!empty($facebook) ) ? $facebook_profile : null;
        echo (!empty($twitter) ) ? $twitter_profile : null;
        echo (!empty($google) ) ? $google_profile : null;
        echo (!empty($linkedin) ) ? $linkedin_profile : null;
        echo (!empty($pinterest) ) ? $pinterest_profile : null;
        echo (!empty($youtube) ) ? $youtube_profile : null;
        echo (!empty($vimeo) ) ? $vimeo_profile : null;
        echo (!empty($instagram) ) ? $instagram_profile : null;
        echo (!empty($emailto) ) ? $emailto_profile : null;
        echo (!empty($rss) ) ? $rss_profile : null;
        echo '</ul></div>';
        echo $args['after_widget'];
	}
			
	// Widget Backend 
	public function form($instance) {
        isset($instance['title']) ? $title = $instance['title'] : null;
        //empty($instance['title']) ? $title = 'Follow Me' : null;
 
        isset($instance['facebook']) ? $facebook = $instance['facebook'] : null;
        isset($instance['twitter']) ? $twitter = $instance['twitter'] : null;
        isset($instance['google']) ? $google = $instance['google'] : null;
        isset($instance['linkedin']) ? $linkedin = $instance['linkedin'] : null;
        isset($instance['pinterest']) ? $pinterest = $instance['pinterest'] : null;
        isset($instance['youtube']) ? $youtube = $instance['youtube'] : null;
        isset($instance['vimeo']) ? $vimeo = $instance['vimeo'] : null;
        isset($instance['instagram']) ? $instagram = $instance['instagram'] : null;
        isset($instance['emailto']) ? $emailto = $instance['emailto'] : null;
        isset($instance['rss']) ? $rss = $instance['rss'] : null;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('facebook'); ?>"><?php _e('Facebook:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('facebook'); ?>" name="<?php echo $this->get_field_name('facebook'); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('twitter'); ?>"><?php _e('Twitter:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('twitter'); ?>" name="<?php echo $this->get_field_name('twitter'); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('google'); ?>"><?php _e('Google+:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('google'); ?>" name="<?php echo $this->get_field_name('google'); ?>" type="text" value="<?php echo esc_attr($google); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e('Linkedin:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" name="<?php echo $this->get_field_name('linkedin'); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e('Pinterest:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" name="<?php echo $this->get_field_name('pinterest'); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e('YouTube:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" name="<?php echo $this->get_field_name('youtube'); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e('Vimeo:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" name="<?php echo $this->get_field_name('vimeo'); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e('Instagram:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" name="<?php echo $this->get_field_name('instagram'); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('emailto'); ?>"><?php _e('Email To:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('emailto'); ?>" name="<?php echo $this->get_field_name('emailto'); ?>" type="text" value="<?php echo esc_attr($emailto); ?>">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e('rss:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>" type="text" value="<?php echo esc_attr($rss); ?>">
        </p>

        <?php
    }	
		
	// Updating widget replacing old instances with new
	public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? strip_tags($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? strip_tags($new_instance['twitter']) : '';
        $instance['google'] = (!empty($new_instance['google']) ) ? strip_tags($new_instance['google']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin']) ) ? strip_tags($new_instance['linkedin']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest']) ) ? strip_tags($new_instance['pinterest']) : '';
        $instance['youtube'] = (!empty($new_instance['youtube']) ) ? strip_tags($new_instance['youtube']) : '';
        $instance['vimeo'] = (!empty($new_instance['vimeo']) ) ? strip_tags($new_instance['vimeo']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram']) ) ? strip_tags($new_instance['instagram']) : '';
        $instance['emailto'] = (!empty($new_instance['emailto']) ) ? strip_tags($new_instance['emailto']) : '';
        $instance['rss'] = (!empty($new_instance['rss']) ) ? strip_tags($new_instance['rss']) : '';
 
        return $instance;
    }
} // Class wpb_widget ends here

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'My_Social_Media_Widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
