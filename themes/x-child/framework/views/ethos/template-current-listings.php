<?php

// =============================================================================
// VIEWS/ETHOS/TEMPLATE-CURRENT-LISTINGS.PHP (Container | Header, Footer)
// -----------------------------------------------------------------------------
// The custom template for the current listings page
// =============================================================================

?>

<?php get_header(); ?>

<div class="x-container max width main">
	<div class="offset cf">
		<div class="x-main full" role="main">
			<?php 
			while ( have_posts() ) : the_post();
			the_content();
			x_link_pages();
			endwhile; 
			?>

			<article id="post-<?php the_ID(); ?>">
				<div class="entry-wrap entry-content properties-current-listings">
					<?php
					$posts = get_posts(array(
						'numberposts'	=> -1,
						'post_type'		=> 'properties',
					));


					if( $posts ):
					foreach($posts as $post):
					$listing_type = (get_field('listing_type')) ? get_field('listing_type')->name : "Active";
					if($listing_type !== 'Sold'):
					setup_postdata($post);
					$thumbnail = '';

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
					$badge = strtolower($listing_type);
					?>
					<div id="post-<?php the_ID(); ?>" class="properties">
						<div class="property-thumb">
							<span class="property-badge listing-type-<?php echo $badge; ?>"><?php echo $badge ?></span>
							<a href="<?php the_permalink(); ?>">
								<div class="property-thumb-image" style="background-image: url(<?php echo $thumbnail; ?>);"></div>
							</a>
						</div>
						<div class="property-meta">
							<h3 class="major post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p class="property-acreage"><?php echo $acreage; ?></p>
							<p class="property-region"><?php echo $region; ?></p>
							<p class="property-price"><?php echo $price; ?></p>
						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</div>
			</article>
		</div>
	</div>
</div>

<?php get_footer(); ?>