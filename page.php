<?php
/**
 * Page Template File
 *
 */

get_header(); ?>
<?php
/**
 * Load Variables
 *
 */
global $mayflower_brand;
$mayflower_options = mayflower_get_options();
$current_layout = $mayflower_options['default_layout'];
?>

<?php if ( has_active_sidebar() ) : ?>
	<div class="col-md-9 <?php  if ( $current_layout == 'sidebar-content' ) { ?>col-md-push-3<?php } ?>">
<?php else : // Full Width Container ?>
	<div class="col-md-12">
<?php endif; ?>
		<?php if ( have_posts() ) : ?>
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
				<main id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="main">
					<?php get_template_part( 'parts/page' ); ?>
				</main>
			<?php endwhile;
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'parts/content', 'none' );

		endif; ?>
	</div>
<?php if ( has_active_sidebar() ) : ?>
	<?php get_sidebar();
endif; ?>


<?php get_footer(); ?>
