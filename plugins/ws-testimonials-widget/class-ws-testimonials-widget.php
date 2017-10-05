<?php

/*
Plugin Name: WS Testimonials Widget
Description: Adds a widget allowing you to showcase testimonials
Version: 1.0.0
Author: Apparatus Digital Creative Agency
Author URI: http://apparatusagency.com
*/

class Testimonials_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'ws_testimonials_widget',
			'description' => 'Displays your testimonials.',
		);
		parent::__construct( 'ws_testimonials_widget', 'WS Testimonials Widget', $widget_ops );
	}

	public function widget( $args, $instance ) {
		$display_num = (!empty($instance['display_num'])) ? $instance['display_num'] : 1;
		$light_text = $instance[ 'light_text' ] ? 'true' : 'false';
		$options = array(
			'posts_per_page'	=> $display_num,
			'post_type'			=> 'testimonials'
		);
		$post = new WP_Query($options);

		if($post->have_posts()):
		while($post->have_posts()): $post->the_post();
		$text_color = ( 'on' == $instance[ 'light_text' ] ) ? "light_text" : NULL;
		$testimonial = (get_field('quote')) ? get_field('quote') : NULL;
		$author = (get_field('quotee')) ? get_field('quotee') : NULL;
?>

<article id="post-<?php the_ID(); ?>" class="testimonial-widget <?php echo $text_color; ?>">
	<blockquote>
		<div class="testimonial-quote">
			<?php echo $testimonial; ?>
		</div>
		<footer class="testimonial-author">- <?php echo $author; ?></footer>
	</blockquote>
</article>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<?php endif; ?>

<?php
	}

	public function form( $instance ) {
		$display_num = (!empty($instance['display_num'])) ? $instance['display_num'] : 1;
		$your_checkbox_var = $instance[ 'your_checkbox_var' ] ? 'true' : 'false';
		$light_text = $instance['light_text'] ? true : false;
?>

<p>
	<label>
	<input class="checkbox" type="checkbox" <?php checked( $instance[ 'light_text' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'light_text' ); ?>" name="<?php echo $this->get_field_name( 'light_text' ); ?>"> Light Text?
	</label>
	<br><br>
	<label for="<?php echo esc_attr( $this->get_field_id( 'display_num' ) ); ?>" style="display: block;"><?php _e( esc_attr( 'Display Testimonials:' ) ); ?></label> 
	<input id="display_num" name="<?php echo esc_attr( $this->get_field_name( 'display_num' ) ); ?>" type="range" min="1" max="12" step="1" value="<?php echo esc_attr( $display_num ); ?>" style="display: block; width: 100%;" oninput="volume.value = display_num.value">
	<output for="<?php echo esc_attr( $this->get_field_id( 'display_num' ) ); ?>" id="volume"><?php echo esc_attr( $display_num ); ?></output>
	<script>
		function outputUpdate(vol) {
			document.querySelector('#volume').value = vol;
		}
	</script>
</p>
<hr>
<?php
	}

	public function update( $new_instance, $old_instance ) {		
		$instance = array();
		$instance['light_text'] = $old_instance['light_text'];
		$instance['display_num'] = (!empty( $new_instance['display_num'])) ? strip_tags( $new_instance['display_num'] ) : 1;
		$instance['light_text'] = $new_instance['light_text'];
		return $instance;
	}
} //end class


// register Testimonials Widget
// =============================================================================
function register_testimonials_widget() {
	register_widget('Testimonials_Widget');
}
add_action('widgets_init', 'register_testimonials_widget');

?>