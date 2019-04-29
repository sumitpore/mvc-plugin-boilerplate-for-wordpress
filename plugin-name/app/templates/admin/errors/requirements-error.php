<div class="error">

	<p>Plugin Name error: Your environment doesn't meet the system requirements listed below.</p>

	<ul class="ul-disc">
		<?php foreach ( $errors as $error ) : ?>
			<li>
				<strong><?php echo esc_html( $error->error_message ); ?></strong>
				<em><?php echo esc_html( $error->supportive_information ); ?></em>
			</li>
		<?php endforeach; ?>
	</ul>

</div>
