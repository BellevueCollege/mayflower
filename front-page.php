<?php
/**
 * Front Page Template File
 *
 * Loads Blog and Static Homepages in Mayflower
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

	<?php
	/**
	 * Load Featured Slideshow Full Width
	 *
	 * Load if selected, or if there is no sidebar.
	 */
	if ( !( has_active_sidebar() ) ||
		 ( $mayflower_options['slider_layout'] == 'featured-full' &&
		 $mayflower_options['slider_toggle'] == 'true' ) ) {
		get_template_part('parts/featured-full');
	} ?>
		<?php if ( has_active_sidebar() ) : ?>
			<div class="col-md-9 <?php  if ( $current_layout == 'sidebar-content' ) { ?>col-md-push-3<?php } ?>">
		<?php else : // Full Width Container ?>
			<div class="col-md-12">
		<?php endif; ?>
				<main role="main">
					<?php
					/**
					 * Load Featured Slideshow in Content
					 *
					 */
					if ( has_active_sidebar() &&
						$mayflower_options['slider_toggle'] == 'true' &&
						$mayflower_options['slider_layout'] == 'featured-in-content' ) {
						get_template_part( 'parts/featured-in-content' );?>
						<div class="content-padding top-spacing30"> </div>
					<?php }
					/**
					 * Check if static homepage is set
					 */
					if ( 'page' == get_option( 'show_on_front' ) ) {
						/*
						* Check if using page template
						*
						* Page templates are over-ridden by using front-page.php
						* Continue as normal if using full-width template.
						*/
						if ( is_page_template() && ! is_page_template( 'page-full-width.php' ) ) {
							/*
							* Load page template
							*
							* Look for file matching template name within parts/ directory
							**/
							$template_name = str_replace( '.php', '', get_page_template_slug() );
							get_template_part( "parts/$template_name" );
						} else {
							get_template_part( 'parts/content', 'static-home' );
						}
					} else {
						get_template_part( 'parts/content', 'blog-home' );
					}?>
				</main>
		<?php if ( has_active_sidebar() ) : ?>
			<?php get_sidebar();
		endif; ?>
	</div>
<?php get_footer(); ?>
