<div class="error">

	<p>Your environment doesn't meet the system requirements listed below. Therefore <strong>Plugin Name</strong> has been <strong>deactivated.</strong></p>

	<ul class="ul-disc">
		<?php foreach ( $errors as $error ) : ?>
			<li>
				<strong><?php echo esc_html( $error->error_message ); ?></strong>
				<em><?php echo esc_html( $error->supportive_information ); ?></em>
			</li>
		<?php endforeach; ?>
	</ul>

</div>
