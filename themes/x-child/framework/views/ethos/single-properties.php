<?php

// =============================================================================
// VIEWS/ETHOS/WP-SINGLE-X-PROPERTIES.PHP
// -----------------------------------------------------------------------------
// Single post output for Properties CPT.
// =============================================================================

$fullwidth = get_post_meta( get_the_ID(), '_x_post_layout', true );

?>

<?php get_header(); ?>

<div class="<?php x_main_content_class(); ?>" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<?php
	$thumbnail = '';

	if (function_exists('has_post_thumbnail')) {
		if ( has_post_thumbnail() ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
		}
	}
	?>
	<div class="property-main-image" style="background-image: url(<?php echo $thumbnail[0]; ?>);">
		<h1 class="property-name"><?php the_title(); ?></h1>
	</div>
	<div class="property-details">
			<?php
			$listing_type = (get_field('listing_type')) ? get_field('listing_type')->name : "Active";
			?>
			<h4 class="property-listing-type listing-<?php echo strtolower($listing_type); ?>"><?php echo $listing_type." Property"; ?></h4>
			<?php
			if(get_field('price') && $listing_type != 'Sold') {
				echo "<p class='property-details-value property-price'>".get_field('price')."</p>";
			}

			if(get_field('acreage')) {
				echo "<p class='property-details-value property-acreage'>".number_format(get_field('acreage'))." acres</p>";
			}

			if(get_field('region')) {
				echo "<p class='property-details-value property-region'>".get_field('region')."</p>";
			}

			if(get_field('taxes')) {
				echo "<p class='property-details-value property-taxes'>$".number_format(get_field('taxes'))." in property tax</p>";
			}
			?>
		</div>
	
	<div class="x-container max width main">
		<div class="offset cf">
			<div class="x-column x-md x-2-3 property-main">
				<?php
				if(get_field('property_description')) {
					echo "<h3 class='property-label'>Property Description:</h3>";
					echo get_field('property_description');
				}
				
				if(get_field('production')) {
					echo "<h3 class='property-label'>Production:</h3>";
					echo get_field('production');
				}

				if(get_field('video')) {
					echo get_field('video');
				}

				if(get_field('wildlife')) {
					echo "<h3 class='property-label'>Wildlife:</h3>";
					echo get_field('wildlife');
				}

				if(get_field('terrain')) {
					echo "<h3 class='property-label'>Terrain:</h3>";
					echo get_field('terrain');
				}

				if(get_field('improvements')) {
					echo "<h3 class='property-label'>Improvements:</h3>";
					echo get_field('improvements');
				}

				if(get_field('water')) {
					echo "<h3 class='property-label'>Water:</h3>";
					echo get_field('water');
				}
				
				if(get_field('water_rights')) {
					echo "<h3 class='property-label'>Water Rights:</h3>";
					echo get_field('water_rights');
				}
				
				if(get_field('lakes')) {
					echo "<h3 class='property-label'>Lakes:</h3>";
					echo get_field('lakes');
				}
				
				if(get_field('wells')) {
					echo "<h3 class='property-label'>Wells:</h3>";
					echo get_field('wells');
				}

				if(get_field('minerals')) {
					echo "<h3 class='property-label'>Minerals:</h3>";
					echo get_field('minerals');
				}

				if(get_field('exemptions')) {
					echo "<h3 class='property-label'>Exemptions:</h3>";
					echo get_field('exemptions');
				}
				
				if(get_field('development_potential')) {
					echo "<h3 class='property-label'>Development Potential:</h3>";
					echo get_field('development_potential');
				}
				
				if(get_field('equipment')) {
					echo "<h3 class='property-label'>equipment:</h3>";
					echo get_field('equipment');
				}
				
				if(get_field('additional_information')) {
					echo "<h3 class='property-label'>Additional Info:</h3>";
					echo get_field('additional_information');
				}
				?>
			</div>
			<div class="x-column x-md x-1-3">
				<?php 
				if(get_field('brochure') || get_field('map_pdf')):
				?>
				<div class="property-sidebar">
					<h3 class='property-label'>Downloads</h3>
					<?php
					if(get_field('brochure')) {
						echo "<p class='property-button'><a href='".get_field('brochure')."' class='x-btn x-btn-small'>Download Brochure (pdf)</a></p>";
					}

					if(get_field('map_pdf')) {
						echo "<p class='property-button'><a href='".get_field('map_pdf')."' class='x-btn x-btn-small'>Download Map (pdf)</a></p>";
					}
					?>
				</div>
				<?php
				endif;
				?>
				<div class="property-sidebar">
					<h3 class='property-label'>Share this: </h3>
					<ul class="social-share">
						<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"></a></li>
						<li class="twitter"><a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"></a></li>
						<li class="gplus"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"></a></li>
						<li class="email"><a href="mailto:?subject=<?php the_title(); ?>&body=View this amazing ranch from West and Swope Ranch Sales: <?php the_permalink(); ?>"></a></li>
					</ul>
				</div>
				<div class="property-sidebar">
					<h3 class='property-label'>Contact Us:</h3>
					<p>Are you interested in this property? Let us know by filling out the form below and we will connect with you promptly.</p>
					<?php echo do_shortcode('[contact-form-7 id="147" title="Property Contact"]'); ?>
				</div>
				<?php
				$tags = get_field('property_tags');

				if( $tags ): ?>
				<div class="property-sidebar">
					<h3 class='property-label'>Property Tags</h3>
					
					<ul class="tags-list">
						<?php foreach( $tags as $tag ): ?>
							<li class="tag-pill"><?php echo $tag->name; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php if(get_field('images')): ?>
	<div class="x-container max width">
		<div class="offset cf">
			<div class="x-column x-md x-1-1">
				<h3 class="property-label">Property Photos:</h3>
				<p class="instruction">Click or tap a photo to enlarge.</p>
				<?php
				$images = get_field('images');
				if( $images ): ?>
				<ul class="property-gallery">
					<?php foreach( $images as $image ): ?>
					<li class="property-gallery-image">
						<a href="<?php echo $image['url']; ?>" data-lightbox="gallery-1" data-title="<?php echo $image['caption']; ?>">
							<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['alt']; ?>">
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if(get_field('map')) : ?>
	<div class="mapright">
		<?php the_field('map'); ?>
	</div>
	<?php endif; ?>

	<?php endwhile; ?>
</div>

<?php get_footer(); ?>