

<div class="wrap">

	<h2><?php echo esc_html( $page_title ); ?></h2>

	<form id="plugin_name" method="post" action="options.php">
		<?php
			settings_fields( $settings_name );
			do_settings_sections( $settings_name );
			submit_button();
		?>
	</form>

</div> <!-- .wrap -->
