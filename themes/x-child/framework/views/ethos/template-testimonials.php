<?php

// =============================================================================
// VIEWS/ETHOS/TEMPLATE-TESTIMONIALS.PHP (Container | Header, Footer)
// -----------------------------------------------------------------------------
// The custom template for the testimonials page
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
				<div class="entry-wrap entry-content testimonials">
					<?php
					$posts = get_posts(array(
						'numberposts'	=> -1,
						'post_type'		=> 'testimonials',
					));
					
					if( $posts ):
					foreach($posts as $post):
					$testimonial = get_field('quote');
					$author = get_field('quotee');
					?>

					<article id="post-<?php the_ID(); ?>" class="testimonial">
						<blockquote>
							<div class="testimonial-quote">
								<?php echo $testimonial; ?>
							</div>
							<footer class="testimonial-author">- <?php echo $author; ?></footer>
						</blockquote>
					</article>
					<?php endforeach; ?>
					<?php endif; ?>
					<?php wp_reset_postdata(); ?>
				</div>
			</article>
		</div>
	</div>
</div>

<?php get_footer(); ?>