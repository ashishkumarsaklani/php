<h1>Ash Theme Support </h1>
	<?php 		settings_errors();			?>
	

<form method="post" action ="options.php" class ="ash-general-form">
	<?php 		settings_fields('ash-theme-support' );		?>
	<?php 		do_settings_sections('ash_theme'); 				?>
	<?php 		submit_button();							?>
</form>
