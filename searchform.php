<?php
global $mayflower_options;

// Load options if they are not already present.
if ( ! ( is_array( $mayflower_options ) ) ) {
	$mayflower_options = mayflower_get_options();
}

// Set variables for ease of use/configuration
$limit_searchform_scope  = $mayflower_options['limit_searchform_scope']; //
$search_url_default      = 'https://www.bellevuecollege.edu/search/'; //
$search_url              = ( $limit_searchform_scope && ( '' !== $mayflower_options['custom_search_url'] ) ) ?
								$mayflower_options['custom_search_url'] : $search_url_default; //
$search_field_id         = $limit_searchform_scope ? 'college-search-field-custom' : 'college-search-field'; //
$filter_value            = mayflower_trimmed_url(); //
$search_api_key          = '' !== $mayflower_options['custom_search_api_key'] ? $mayflower_options['custom_search_api_key'] :
							'YUFwdxQ6-Kaa9Zac4rpb'; // <-- Default API Key //
$search_query_peram      = 'txtQuery';
$filter_peram            = 'site[]'; // hardcoded default.

?>
<form action="<?php echo esc_url( $search_url ); ?>" method="get" class="form-search" id="bc-search">
	<label class="sr-only" for="<?php echo esc_attr( $search_field_id ); ?>">Search</label>
	<div class="input-group" role="search">
		<input type="text" name="<?php echo esc_attr( $search_query_peram ); ?>" class="form-control" maxlength="255" autocomplete="off" id="<?php echo esc_attr( $search_field_id ) ?>"  />

		<?php if ( $limit_searchform_scope ) : ?>
			<?php
			if ( '' === $mayflower_options['custom_search_url'] ) :
				// If there is NOT a custom search URL, output filter peram and filter js ?>
				<input type="hidden" class="college-search-filter" name="<?php echo esc_attr( $filter_peram ); ?>" value="<?php echo esc_attr( $filter_value ); ?>">
			<?php endif; // no custom search url set ?>
		<?php endif; // limit searchform scope ?>
		<div class="input-group-append">
			<button type="submit" class="btn btn-light" id="college-search-submit">Search</button>
			<?php if ( $limit_searchform_scope ) : ?>
				<button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="sr-only">More Search Options</span>
				</button>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="<?php echo esc_url( $search_url ); ?>" id="college-search-site-link">Search <?php bloginfo( 'name' ); ?></a>
					<a class="dropdown-item" href="<?php echo esc_url( $search_url_default ); ?>" id="college-search-all-link">Search Bellevue College <i class="fas fa-external-link-alt" aria-hidden="true"></i></a>
				</div>
			<?php endif; // limit searchform scope ?>
		</div>
	</div>
</form>
