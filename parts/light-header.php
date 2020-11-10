<?php
/**
 * Lite Header Part
 *
 * @package Mayflower
 */

$globals = new Globals();
$globals->tophead();

global $post, $mayflower_options, $mayflower_brand, $mayflower_brand_css, $mayflower_theme_version;

?>
<header id="secondary-header" class="lite container shadow">
	<div class="row align-items-center">
		<div class="col-md-8">
			<div id="site-branding">
				<?php
				if ( has_custom_logo() ) :
					?>
						<div class="header-image">
							<a title="Return to Home Page" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php
								if ( function_exists( 'the_custom_logo' ) ) {
									$custom_logo_id = get_theme_mod( 'custom_logo' );
									$logo           = wp_get_attachment_image_src( $custom_logo_id, 'full' );
									echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" class="header-image">';

								}
								?>
							</a>
						</div><!-- header-image -->
					<?php
					else : // no header image.
						?>
						<p class="site-title">
							<a title="Return to Home Page" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</p>
						<p class="site-description
						<?php
						if ( get_bloginfo( 'description' ) ) {
							echo 'site-description-margin'; }
						?>
						">
							<?php bloginfo( 'description' ); ?>
						</p>
						<?php
					endif; // end no header image.
					?>
			</div><!-- #site-branding -->
		</div>
		<div id="header-actions-container" class="col-md-4
		<?php
		if ( get_bloginfo( 'description' ) ) {
			echo 'header-search-w-description ';
		}
		if ( '' === get_bloginfo( 'description' ) ) {
			echo 'header-social-links-no-margin ';
		}
		?>
												">
			<div class="social-media
			<?php
			if ( empty( $mayflower_options['facebook'] ) && empty( $mayflower_options['twitter'] ) && empty( $mayflower_options['youtube'] ) && empty( $mayflower_options['instagram'] ) && empty( $mayflower_options['linkedin'] ) ) {
				echo 'social-media-no-margin';
			}
			?>
										">
				<?php if ( ! empty( $mayflower_options['facebook'] ) ) { ?>
					<a class="px-2 py-1" href="<?php echo esc_url( $mayflower_options['facebook'] ); ?>" title="Facebook">
						<i class="fab fa-facebook-square" aria-hidden="true"></i>
						<span class="sr-only">Facebook</span></a>
					</a>
				<?php } ?>

				<?php if ( ! empty( $mayflower_options['twitter'] ) ) { ?>
					<a class="px-2 py-1" href="<?php echo esc_url( $mayflower_options['twitter'] ); ?>" title="Twitter">
						<i class="fab fa-twitter-square" aria-hidden="true"></i>
						<span class="sr-only">Twitter</span>
					</a>
				<?php } ?>

				<?php if ( ! empty( $mayflower_options['youtube'] ) ) { ?>
					<a class="px-2 py-1" href="<?php echo esc_url( $mayflower_options['youtube'] ); ?>" title="YouTube">
						<i class="fab fa-youtube-square" aria-hidden="true"></i>
						<span class="sr-only">YouTube</span></a>
					</a>
				<?php } ?>

				<?php if ( ! empty( $mayflower_options['instagram'] ) ) { ?>
					<a class="px-2 py-1" href="<?php echo esc_url( $mayflower_options['instagram'] ); ?>" title="Instagram">
						<i class="fab fa-instagram" aria-hidden="true"></i>
						<span class="sr-only">Instagram</span></a>
					</a>
				<?php } ?>

				<?php if ( ! empty( $mayflower_options['linkedin'] ) ) { ?>
					<a class="px-2 py-1" href="<?php echo esc_url( $mayflower_options['linkedin'] ); ?>" title="LinkedIn">
						<i class="fab fa-linkedin" aria-hidden="true"></i>
						<span class="sr-only">LinkedIn</span></a>
					</a>
				<?php } ?>
			</div><!-- social-media -->

			<?php
			if ( ! ( $mayflower_options['hide_searchform'] ) ) :
				?>
					<div id="header-actions-bar" class="row searchform-show">
						<div id="main-nav-link" class="col-4 col-md-12">
							<a href="#college-navbar" title="Navigation Menu" class="btn btn-light btn-block" aria-expanded="false" aria-controls="main-nav-wrap"><i class="fas fa-bars" aria-hidden="true"></i> Menu</a>
						</div><!-- main-nav-link -->
						<div id="bc-search-container-lite" class="col-8 col-md-12">
							<a tabindex="-1" id="tools-close-icon" class="lite">
								<i class="fas fa-chevron-left" aria-hidden="true"></i><span class="sr-only">Close Search</span>
							</a>
							<?php get_search_form(); ?>
						</div>
					</div><!-- row -->
				<?php
				else :
					?>
					<div id="header-actions-bar" class="row searchform-hide">
						<div id="main-nav-link" class="col-12">
							<a href="#college-navbar" title="Navigation Menu" class="btn btn-light btn-block" aria-expanded="false" aria-controls="main-nav-wrap"> <i class="fas fa-bars" aria-hidden="true"></i> Menu</a>
						</div><!-- main-nav-link -->
					</div><!-- row -->

					<?php
				endif;
				?>

		</div><!-- header actions container -->

	</div>


	<?php
		get_template_part( 'parts/light-nav' );
	?>
</header>
