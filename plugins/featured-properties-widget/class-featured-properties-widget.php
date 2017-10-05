<?php

/*
Plugin Name: Featured Properties Widget
Description: Adds a widget allowing you to showcase featured properties
Version: 1.0.0
Author: Apparatus Digital Creative Agency
Author URI: http://apparatusagency.com
*/

class Featured_Properties_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 
			'classname' => 'featured_properties_widget',
			'description' => 'Displays your featured properties.',
		);
		parent::__construct( 'featured_properties_widget', 'Featured Properties Widget', $widget_ops );
	}

	public function widget( $args, $instance ) {
		wp_enqueue_style( 'ws-testimonial-styles', plugins_url('ws-testimonial-styles.css', __FILE__) );

		$display_num = (!empty($instance['display_num'])) ? $instance['display_num'] : 6;
		$options = array(
			'posts_per_page'	=> $display_num,
			'post_type'			=> 'properties',
			'category_name'		=> 'featured'
		);
		$post = new WP_Query($options);

		if($post->have_posts()):
		while($post->have_posts()): $post->the_post();
		if (function_exists('has_post_thumbnail')) {
			if ( has_post_thumbnail() ) {
				$thumbnail = wp_get_attachment_image_url( get_post_thumbnail_id($post->ID), 'medium', false, '' );
			} else {
				$thumbnail = get_stylesheet_directory_uri()."/framework/images/placeholder.jpg";
			}
		}
		$acreage = (get_field('acreage')) ? number_format(get_field('acreage'))." acres" : null;
		$price = (get_field('price')) ? get_field('price') : "coming soon";
		$region = (get_field('region')) ? get_field('region') : null;
?>

<article id="post-<?php the_ID(); ?>" class="properties-current-listings">
	<div class="entry-wrap entry-content properties">
		<div class="property-thumb">
			<a href="<?php the_permalink(); ?>">
				<div class="property-thumb-image" style="background-image: url(<?php echo $thumbnail; ?>);"></div>
			</a>
		</div>
		<div class="property-meta">
			<h3 class="major post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="property-acreage"><?php echo $acreage; ?></p>
			<p class="property-price"><?php echo $price; ?></p>
			<p class="property-region"><?php echo $region; ?></p>
		</div>
	</div>
</article>

<?php endwhile; ?>
<?php wp_reset_query(); ?>
<?php endif; ?>

<?php
	}

	public function form( $instance ) {
		$display_num = (!empty($instance['display_num'])) ? $instance['display_num'] : 6;
?>

<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'display_num' ) ); ?>" style="display: block;"><?php _e( esc_attr( 'Display Properties:' ) ); ?></label> 
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
		$instance['display_num'] = (!empty( $new_instance['display_num'])) ? strip_tags( $new_instance['display_num'] ) : 1;
		return $instance;
	}
} //end class


// register Featured Properties Widget
// =============================================================================
function register_featured_properties_widget() {
	register_widget('Featured_Properties_Widget');
}
add_action('widgets_init', 'register_featured_properties_widget');

?>