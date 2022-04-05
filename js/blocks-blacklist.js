/**
 * Gutenberg blocks that are disabled by Mayflower
 */
window.onload = function () {
	wp.blocks.unregisterBlockType('core/table');
	wp.blocks.unregisterBlockType('core/verse');
	wp.blocks.unregisterBlockType('core/video');
	wp.blocks.unregisterBlockType('core/pullquote');
	wp.blocks.unregisterBlockType('core/code');
	wp.blocks.unregisterBlockType('core/latest-comments');
	wp.blocks.unregisterBlockType('core/columns');
	wp.blocks.unregisterBlockType('core/column');
	wp.blocks.unregisterBlockType('core/button');
	wp.blocks.unregisterBlockType('core/buttons');
	wp.blocks.unregisterBlockType('core/more');
	wp.blocks.unregisterBlockType('core/search');
	wp.blocks.unregisterBlockType('core/calendar');
	wp.blocks.unregisterBlockType('core-embed/collegehumor');
	wp.blocks.unregisterBlockType('core-embed/mixcloud');

	wp.blocks.unregisterBlockType('core/navigation');
	wp.blocks.unregisterBlockType('core/navigation-link');
	wp.blocks.unregisterBlockType('core/navigation-submenu');
	wp.blocks.unregisterBlockType('core/site-logo');
	wp.blocks.unregisterBlockType('core/site-title');
	wp.blocks.unregisterBlockType('core/site-tagline');
	wp.blocks.unregisterBlockType('core/post-comments');
	wp.blocks.unregisterBlockType('core/loginout');
	wp.blocks.unregisterBlockVariation( 'core/group', 'group-row' );
}
