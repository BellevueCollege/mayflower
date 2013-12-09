<div class="sidebar span3 <?php
	$mayflower_options = mayflower_get_options();
	$current_layout = $mayflower_options['default_layout'];
	if ( $current_layout == 'sidebar-content' ) { 
		?>sidebarleft<?php
	} else {
		?>sidebarright<?php
	}; ?>">

		<?php if ( is_active_sidebar( 'top-global-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'top-global-widget-area' ); ?>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'page-widget-area' ) ) : ?>
			<?php if(is_home() || is_single() || is_blog() ) { } else 
			 dynamic_sidebar( 'page-widget-area' ); ?>
		<?php endif; ?>
	
		<?php if ( is_active_sidebar( 'blog-widget-area' ) ) : ?>
			<?php if( is_home() || is_single() || is_blog() ) :?>
				<?php dynamic_sidebar( 'blog-widget-area' ); ?>
			<?php endif;?>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'global-widget-area' ) ) : ?>
			<?php dynamic_sidebar( 'global-widget-area' ); ?>
		<?php endif; ?>

</div><!-- span3 -->