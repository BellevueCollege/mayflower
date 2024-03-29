<?php
/**
 * Set Up Globals Calls
 *
 * These files provide plugin-like functionality embedded within Mayflower.
 *
 */

/**
 * Set Up Globals Paths
 */
$mayflower_globals_settings = get_option( 'globals_network_settings' );
if ( is_multisite() ) {
	$mayflower_globals_settings = get_site_option( 'globals_network_settings' );
}
$globals_path = defined('BC_GLOBALS_3_PATH') ? BC_GLOBALS_3_PATH : $mayflower_globals_settings['globals_path'];
$append_path = defined('BC_GLOBALS_3_APPEND_PATH') ? BC_GLOBALS_3_APPEND_PATH : $mayflower_globals_settings['append_path'];
if ( empty( $globals_path ) ) {
	$globals_path =  $_SERVER['DOCUMENT_ROOT'] . "/g/3/";
} else if ( $append_path == true ) {
	// Append globals path to document root if box is checked
	$globals_path = $_SERVER['DOCUMENT_ROOT'] . $globals_path;
}
$globals_url = defined('BC_GLOBALS_3_URL') ? BC_GLOBALS_3_URL : $mayflower_globals_settings['globals_url'];
if ( empty( $globals_url) ) {
	$globals_url = "/g/3";
}
$globals_version = defined('BC_GLOBALS_3_VERSION') ? BC_GLOBALS_3_VERSION : $mayflower_globals_settings['globals_version'];
$globals_path_over_http = $globals_url;
$globals_google_analytics_code = $mayflower_globals_settings['globals_google_analytics_code'];

$bc_globals_html_filepath      = $globals_path . "h/";
$bc_globals_lhead_filename     = 'lhead.html';
$bc_globals_bhead_filename     = 'bhead.html';
$bc_globals_bfoot_filename     = 'bfoot.html';
$bc_globals_legal_filename     = 'legal.html';
$bc_globals_galite_filename    = 'galite.html';
$bc_globals_gabranded_filename = 'gabranded.html';

/**
 * Add Globals 'lite' Header
 */
function bc_tophead(){
	global $bc_globals_html_filepath,
		$bc_globals_lhead_filename;

	$header_top =  $bc_globals_html_filepath . $bc_globals_lhead_filename;
	include_once($header_top);
}
add_action('mayflower_header','bc_tophead');

/**
 * Add Globals 'branded' Header
 */
function bc_tophead_big() {
	global $bc_globals_html_filepath,
		$bc_globals_bhead_filename;

	$header_top_big = $bc_globals_html_filepath . $bc_globals_bhead_filename;
	include_once($header_top_big);
}
add_action('mayflower_header','bc_tophead_big');


/**
 * Add Globals 'branded' Footer
 *
 * Function is pluggable for easy changes in child themes
 */
if ( ! function_exists ( 'bc_footer' ) ) {
	function bc_footer() {
		global $bc_globals_html_filepath,
			$bc_globals_bfoot_filename,
			$bc_globals_legal_filename;

		$bc_footer =  $bc_globals_html_filepath . $bc_globals_bfoot_filename;
		$bc_footerlegal =  $bc_globals_html_filepath . $bc_globals_legal_filename;
		include_once($bc_footer);
		include_once($bc_footerlegal);
	}
}
add_action('mayflower_footer', 'bc_footer', 50);

/**
 * Add Legal Footer
 */
function bc_footer_legal() {
	global $bc_globals_html_filepath,
		$bc_globals_legal_filename;

	$bc_footerlegal =  $bc_globals_html_filepath . $bc_globals_legal_filename;
	include_once($bc_footerlegal);
}
add_action('mayflower_footer', 'bc_footer_legal', 50);


/**
 * Add Google Analytics Scripts
 */
function mayflower_analytics () {
	global $bc_globals_html_filepath,
		$mayflower_brand,
		$bc_globals_galite_filename,
		$bc_globals_gabranded_filename;

	$bc_gacode_lite = $bc_globals_html_filepath . $bc_globals_galite_filename;
	$bc_gacode_branded =  $bc_globals_html_filepath . $bc_globals_gabranded_filename;

	if ( $mayflower_brand == 'lite' ) {
		include_once($bc_gacode_lite);
	} else {
		include_once($bc_gacode_branded);
	}

	$mayflower_options = mayflower_get_options();

	if ($mayflower_options['ga_code']) {
		// Format reference https://developers.google.com/analytics/devguides/collection/gajs/?hl=nl&csw=1#MultipleCommands
		?>
		<script type="text/javascript">
			/* Load google analytics scripts (may be duplicate) */
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			/*Site-Specific GA code*/
			ga('create','<?php echo $mayflower_options['ga_code'] ?>','bellevuecollege.edu',{'name':'singlesite'});
			ga('singlesite.send','pageview');
		</script>
	<?php }

} // end function
add_action('wp_head', 'mayflower_analytics', 30);
