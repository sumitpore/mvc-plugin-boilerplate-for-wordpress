<div class="error">
	
	<p>Plugin Name error: Your environment doesn't meet all of the system requirements listed below.</p>

	<ul class="ul-disc">
		<li>
			<strong>PHP <?php echo PLUGIN_NAME_REQUIRED_PHP_VERSION; ?>+</strong>
			<em>(You're running version <?php echo PHP_VERSION; ?>)</em>
		</li>

		<li>
			<strong>WordPress <?php echo PLUGIN_NAME_REQUIRED_WP_VERSION; ?>+</strong>
			<em>(You're running version <?php echo esc_html( $wp_version ); ?>)</em>
		</li>

		<li>
			<strong>WordPress is set up as a Network (Multisite)</strong>
			<em>(This plugin is not compatible with multisite environment)</em>
		</li>

	</ul>
	
</div>