	</div><!-- #main .container -->
</div><!-- #main-wrap -->

		<?php 
		global $globals_path, $globals_path_over_http, $mayflower_version, $mayflowerVersion;
		//echo " Globals Path: " . $globals_path . ". HTTP Path: " . $globals_path_over_http;
		if( $mayflowerVersion == 'lite') {
			bc_footer_legal();
		} else {
			bc_footer();
		}
		?>
        
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo $globals_path_over_http; ?>j/bootstrap.min.js"></script>
<script src="<?php echo $globals_path_over_http; ?>j/g.js"></script>
<?php wp_footer(); ?>

<!-- Mayflower Version: <?php echo $mayflower_version; ?> -->
</body>
</html>