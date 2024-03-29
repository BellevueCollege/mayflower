<!DOCTYPE html>
<?php
global $post,
	   $mayflower_options,
	   $globals_version,
	   $globals_url,
	   $globals_path,
	   $mayflower_brand,
	   $mayflower_brand_css,
	   $mayflower_theme_version;

if ( ! ( is_array( $mayflower_options ) ) ) {
	$mayflower_options = mayflower_get_options();
}

$mayflower_theme_version = wp_get_theme();
$post_meta_data          = get_post_custom( $post->ID ?? null );
?>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<?php if ( isset( $post_meta_data['_seo_custom_page_title'][0] ) ) { ?>
		<meta property="og:title" content="<?php echo esc_html( $post_meta_data['_seo_custom_page_title'][0] ); ?>" />
	<?php } else { ?>
		<meta property="og:title" content="<?php echo get_the_title() . ' :: ' . get_bloginfo( 'name', 'display' ) . ' @ Bellevue College'; ?>" />
	<?php } ?>

	<?php if ( isset( $post_meta_data['_seo_meta_description'][0] ) ) { ?>
		<meta name="description" content="<?php echo esc_html( $post_meta_data['_seo_meta_description'][0] ); ?>" />
		<meta property="og:description" content="<?php echo esc_html( $post_meta_data['_seo_meta_description'][0] ); ?>" />
	<?php } ?>
	<?php if ( isset( $post_meta_data['_seo_meta_keywords'][0] ) ) { ?>
		<meta name="keywords" content="<?php echo esc_html( $post_meta_data['_seo_meta_keywords'][0] ); ?>" />
	<?php } ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/img/bellevue.ico" />

	<!-- Swiftype meta tags -->
	<meta class='swiftype' name='popularity' data-type='integer' content='<?php echo is_front_page( $post->ID ) ? 5 : 1; ?>' />
	<meta class="swiftype" name="published_at" data-type="date" content="<?php the_modified_date( 'Y-m-d' ); ?>" />
	<meta class="swiftype" name="site_home_url" data-type="string" content="<?php echo esc_textarea( mayflower_trimmed_url() ); ?>" />

	<?php if ( is_archive( $post->ID ) ) { ?>
		<meta name="robots" content="noindex, follow">
	<?php } ?>
	<!-- / Swiftype meta tags -->

	<meta class="funnelback" name="fb_site_name" content="<?php echo get_bloginfo( 'name', 'display' ) ?>" />
	<?php if ( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ) : ?>
		<meta class="funnelback" name="fb_featured_image" content="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ); ?>" />
	<?php endif; ?>

	<link rel="profile" href="https://gmpg.org/xfn/11" />

	<!--- Open Graph Tags -->
	<?php if ( 'post' === get_post_type() ) : ?>
		<meta property="og:type" content="article" />
		<meta property="article:published_time" content="<?php echo get_the_date( 'c' ); ?>" />
		<meta property="article:modified_time" content="<?php echo get_the_modified_date( 'c' ); ?>" />
		<meta property="og:updated_time" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>" />
	<?php else : ?>
		<meta property="og:type" content="website" />
		<meta property="og:updated_time" content="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>" />
	<?php endif; ?>

	<?php if ( get_the_post_thumbnail_url( get_the_ID(), 'medium' ) ) : ?>
		<meta property="og:image" content="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'medium' ); ?>" />
	<?php else : ?>
		<meta property="og:image" content="https://s.bellevuecollege.edu/bc-og-default.jpg" />
	<?php endif; ?>

	<meta property="og:url" content="<?php echo get_permalink(); ?>" />
	<meta property="og:site_name" content="Bellevue College" />


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>><!--noindex-->
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}

	//
	// Branded or Lite versions of the header
	//

	if ( 'branded' === $mayflower_brand ) :
		//
		// --- Branded version --- ###
		//

		bc_tophead_big();

		// display site title on branded version
		if ( is_404() ) {
			?>
			<div id="main-wrap" class="<?php echo esc_attr( $mayflower_brand_css ); ?>">
				<div id="main" class="container no-padding">
		<?php } else { ?>
			<div id="main-wrap" class="<?php echo esc_attr( $mayflower_brand_css ); ?>">
				<div id="main" class="container no-padding">
					<div class="content-padding">
						<div id="site-header">
							<p class="site-title">
								<a title="Return to Home Page" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</p>
						</div><!-- container header -->
					</div><!-- content-padding -->
			<?php
		}
	else :
		//
		// --- Lite version --- ###
		//

		bc_tophead();
		?>
		<div id="main-wrap" class="<?php echo esc_attr( $mayflower_brand_css ); ?>">
			<div id="main" class="container no-padding">
				<div id="top" class="mobile-s17">
						<div id="site-branding">
							<?php
							$header_image = get_header_image();
							if ( ! empty( $header_image ) ) :
								?>
								<div class="header-image">
									<a title="Return to Home Page" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
										<img src="<?php header_image(); ?>" class="header-image"  alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?> : <?php bloginfo( 'description' ); ?>" />
									</a>
								</div><!-- header-image -->
							<?php else : // no header image ?>
								<p class="site-title">
									<a title="Return to Home Page" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
								</p>
								<p class="site-description
								<?php
								if ( get_bloginfo( 'description' ) ) {
									echo 'site-description-margin'; }
								?>
								"><?php bloginfo( 'description' ); ?></p>
							<?php endif; // end no header image ?>
						</div><!-- #site-branding -->
						<div id="header-actions-container" class="
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
								<ul>
									<?php if ( ! empty( $mayflower_options['facebook'] ) ) { ?>
										<li><a href="<?php echo esc_url( $mayflower_options['facebook'] ); ?>" title="Facebook"><img src="<?php echo esc_url( $globals_url ); ?>i/facebook.png" alt="facebook" /></a></li>
									<?php } ?>

									<?php if ( ! empty( $mayflower_options['twitter'] ) ) { ?>
										<li><a href="<?php echo esc_url( $mayflower_options['twitter'] ); ?>" title="Twitter"><img src="<?php echo esc_url( $globals_url ); ?>i/twitter.png" alt="twitter" /></a></li>
									<?php } ?>

									<?php if ( ! empty( $mayflower_options['youtube'] ) ) { ?>
										<li><a href="<?php echo esc_url( $mayflower_options['youtube'] ); ?>" title="YouTube"><img src="<?php echo esc_url( $globals_url ); ?>i/youtube.png" alt="youtube" /></a></li>
									<?php } ?>

									<?php if ( ! empty( $mayflower_options['instagram'] ) ) { ?>
										<li><a href="<?php echo esc_url( $mayflower_options['instagram'] ); ?>" title="Instagram"><img src="<?php echo esc_url( $globals_url ); ?>i/instagram.png" alt="instagram" /></a></li>
									<?php } ?>

									<?php if ( ! empty( $mayflower_options['linkedin'] ) ) { ?>
										<li><a href="<?php echo esc_url( $mayflower_options['linkedin'] ); ?>" title="LinkedIn"><img src="<?php echo esc_url( $globals_url ); ?>i/linkedin.png" alt="linkedin" /></a></li>
									<?php } ?>
								</ul>
							</div><!-- social-media -->

							<?php if ( ! ( $mayflower_options['hide_searchform'] ) ) { ?>
								<div id="header-actions-bar" class="row searchform-show">
									<div id="main-nav-link" class="col-xs-4 col-sm-12">
										<a href="#college-navbar" title="Navigation Menu" class="btn btn-default btn-block" aria-expanded="false" aria-controls="main-nav-wrap"><span class="glyphicon menu-icon" aria-hidden="true"></span> Menu</a>
									</div><!-- main-nav-link -->
									<div id="bc-search-container-lite" class="col-xs-8 col-sm-12">
										<a tabindex="-1" id="nav-close-icon" class="lite"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span><span class="sr-only">Close Search</span></a>
										<?php get_search_form(); ?>
									</div>
								</div><!-- row -->

							<?php } else { ?>
								<div id="header-actions-bar" class="row searchform-hide">
									<div id="main-nav-link" class="col-xs-12">
										<a href="#college-navbar" title="Navigation Menu" class="btn btn-default btn-block" aria-expanded="false" aria-controls="main-nav-wrap"> <span class="glyphicon menu-icon" aria-hidden="true"></span> Menu</a>
									</div><!-- main-nav-link -->
								</div><!-- row -->

							<?php } ?>

						</div><!-- col-md-4 -->
					</div> <!--#top-->

	<?php endif; // End if(). ?>

	<div class="row">
		<div class="col-md-12"><!--endnoindex-->

			<?php
			mayflower_sitewide_notice();
			// add flexwrap if we are in the lite version
			if ( 'lite' === $mayflower_brand ) {
				?>
				<div class="flexwrap">
				<?php
			}
