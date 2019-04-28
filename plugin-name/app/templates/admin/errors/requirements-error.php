<div class="error">

	<p>Plugin Name error: Your environment doesn't meet the system requirements listed below.</p>

	<ul class="ul-disc">

		<?php if ( ! is_php_version_dependency_met() ) : ?>
			<li>
				<strong>PHP <?php echo esc_html( PLUGIN_NAME_REQUIRED_PHP_VERSION ); ?>+ is required</strong>
				<em>(You're running version <?php echo esc_html( PHP_VERSION ); ?>)</em>
			</li>
		<?php endif; ?>

		<?php if ( ! is_wp_version_dependency_met() ) : ?>
			<li>
				<strong>WordPress <?php echo esc_html( PLUGIN_NAME_REQUIRED_WP_VERSION ); ?>+ is required</strong>
				<em>(You're running version <?php echo esc_html( $wp_version ); ?>)</em>
			</li>
		<?php endif; ?>

		<?php if ( ! is_wp_multisite_dependency_met() ) : ?>
			<li>
				<strong>Your site is set up as a Network (Multisite)</strong>
				<em>(This plugin is not compatible with multisite environment)</em>
			</li>
		<?php endif; ?>

	</ul>

</div>
