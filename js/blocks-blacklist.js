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
	wp.blocks.unregisterBlockType('core/media-text');
	wp.blocks.unregisterBlockType('core/more');
	wp.blocks.unregisterBlockType('core/search');
	wp.blocks.unregisterBlockType('core/calendar');
	wp.blocks.unregisterBlockType('core-embed/collegehumor');
	wp.blocks.unregisterBlockType('core-embed/mixcloud');
}
