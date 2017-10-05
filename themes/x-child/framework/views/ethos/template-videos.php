<?php

// =============================================================================
// VIEWS/ETHOS/TEMPLATE-VIDEOS.PHP (Container | Header, Footer)
// -----------------------------------------------------------------------------
// The custom template for the videos page
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
					$args = array( 'post_type' => 'properties', 'posts_per_page' => -1 );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();

					$listing_type = (get_field('listing_type')) ? get_field('listing_type')->name : "Active";

					if($listing_type !== 'Sold'):
					$acreage = (get_field('acreage')) ? number_format(get_field('acreage'))." acres" : null;
					$price = (get_field('price')) ? get_field('price') : "coming soon";
					$region = (get_field('region')) ? get_field('region') : null;
					$badge = strtolower($listing_type);
					$video = get_field('video');

					if($video): ?>
					<div id="post-<?php the_ID(); ?>" class="properties">
						<div class="embed-container">
							<?php echo $video; ?>
						</div>
						<div class="property-meta">
							<h3 class="major post-title"><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></h3>
							<span class="property-badge listing-type-<?php echo $badge; ?>"><?php echo $badge ?></span>
							<p class="property-acreage"><?php echo $acreage; ?></p>
							<p class="property-price"><?php echo $price; ?></p>
							<p class="property-region"><?php echo $region; ?></p>
						</div>
					</div>
					<?php endif; ?>
					<?php endif; ?> 
					<?php endwhile; ?>
				</div>
			</article>
		</div>
	</div>
</div>

<?php get_footer(); ?>