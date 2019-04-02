

<div class="wrap">

	<h2><?php esc_html_e( __( $page_title ) ); ?></h2>

	<div id="message_update" class="updated notice is-dismissible" style="display:none;">
		<p>
			<strong><?php echo __( 'Plugin Name Settings Updated' ); ?>.</strong>
		</p>
	</div>
	
	<form id="plugin_name" method="post" action="options.php">
		<?php
			settings_fields( $settings_name );
			do_settings_sections( $settings_name );
			submit_button();
		?>
	</form>

</div> <!-- .wrap -->