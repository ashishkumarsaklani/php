<h1>Ash Contact Form </h1>
	<?php 		settings_errors();			?>
	
<p>Use this <strong>ShortCode</strong> to activate the conact form inside a Page or a Post </p>
<code>[contact_form]</code>
<form method="post" action ="options.php" class ="ash-general-form">
	<?php 		settings_fields('ash-contact-options' );		?>
	<?php 		do_settings_sections('ash_theme_contact'); 				?>
	<?php 		submit_button();							?>
</form>
