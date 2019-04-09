<?php
// Load Mayflower options into array
$mayflower_options = mayflower_get_options();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<main id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="main">
		<div class="content-padding post-heading">
			<h1><?php the_title();?></h1>
			<?php // Check if post date or author should be displayed
			if ( $mayflower_options['display_post_author'] || $mayflower_options['display_post_date'] ) : ?>
				<p class="entry-date">
					<?php //Check if post date should be displayed
					if ( $mayflower_options['display_post_date'] ) : ?>
						<?php _e( 'Date posted: ', 'mayflower');
						the_date(); ?>
					<?php endif;
					// Check if post author should be displayed
					if ( $mayflower_options['display_post_author'] ) : ?>
						&nbsp;<span class="pull-right"><?php _e( 'Author: ', 'mayflower' ) ?><?php the_author_posts_link(); ?></span>
					<?php endif; ?>
				</p>
			<?php endif; ?>

		</div>
		<?php if ( function_exists( 'post_and_page_asides_return_title' ) ) :
			get_template_part( 'parts/aside' );
		endif; ?>
		<article class="content-padding" data-swiftype-name="body" data-swiftype-type="text">

			<?php if ( has_post_thumbnail() && get_post_format() != 'video' ) : ?>

				<?php if ( get_post_format() === 'image' ) : // Output for Image posts

					$tn_id = get_post_thumbnail_id( $post->ID );
					$img = wp_get_attachment_image_src( $tn_id, 'large' );
					$width = $img[1]; ?>
					<div class="wp-block-image">
						<figure class="aligncenter">
							<?php the_post_thumbnail( 'large', ['class' => 'img-responsive']); ?>
							<?php if ( get_post( get_post_thumbnail_id() )->post_excerpt ) : ?>
								<figcaption class="featured-caption wp-caption-text"><?php echo get_post( get_post_thumbnail_id() )->post_excerpt ?></figcaption>
							<?php endif; ?>
						</figure><!-- wp-caption -->
					</div>

				<?php else:  // Output for Standard Posts ?>

					<?php if ( get_post( get_post_thumbnail_id() )->post_excerpt ) :

						$tn_id = get_post_thumbnail_id( $post->ID );
						$img = wp_get_attachment_image_src( $tn_id, 'medium' );
						$width = $img[1]; ?>

						<figure class="img-thumbnail alignleft wp-caption">
							<?php the_post_thumbnail( 'medium' ); ?>
							<figcaption class="featured-caption wp-caption-text" style="width:<?php echo $width.'px';?>"><?php echo get_post( get_post_thumbnail_id() )->post_excerpt ?></figcaption>
						</figure><!-- wp-caption -->
					<?php else : ?>
						<?php the_post_thumbnail( 'medium', array( 'class' => 'img-thumbnail alignleft' ) ); ?>
					<?php endif; ?>

				<?php endif; ?>

				
			<?php endif; ?>

			<?php the_content(); ?>
			<div class="clearfix"></div>
			<p id="modified-date" class="text-right"><small><?php _e('Last Updated ', 'mayflower'); the_modified_date(); ?></small></p>
		</article><!-- content-padding -->
	</main>
	<?php endwhile; ?>

<?php wp_reset_query();
endif; ?>
