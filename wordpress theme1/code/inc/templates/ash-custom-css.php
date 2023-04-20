<h1>Ash Theme Support </h1>
	<?php 		settings_errors();			?>
	

<form id="save-custom-css-form" method="post" action ="options.php" class ="ash-general-form">
	<?php 		settings_fields('ash-custom-css-options' );	?>
	<?php 		do_settings_sections('ash_theme_css'); 			?>
	<?php 		submit_button();							?>
</form>
