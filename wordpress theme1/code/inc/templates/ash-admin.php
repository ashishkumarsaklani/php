<h1>ash SideBar Options </h1>
	<?php 		settings_errors();			?>
	
	
<?php
			$picture = esc_attr( get_option('profile_picture') );
			$firstName = esc_attr( get_option('first_name') );
			$lastName = esc_attr( get_option('last_name') );
			$fullName = $firstName.' '.$lastName;
			$details =esc_attr(get_option('user_details'));

?>	
	
	
	
	
	
	
<div class = "ash-sidebar-preview">
		<div class = "ash-sidebar">
			<div class = "imgage-container">
				<div id="profile-picture-preview" class = "profile-picture" style="background-image: url(<?php print $picture; ?>);" >	</div>
			</div>
			<h1 class="ash-username" ><?php print $fullName; ?></h1>
			<h2 class="ash-details" ><?php print $details; ?></h2>
			<div class="icons-wrapper" >
			
				
			</div>
		</div>	
</div>	
	
	
	
	
<form method="post" action ="options.php" class ="ash-general-form">
	<?php 		settings_fields('ash-settings-group' );		?>
	<?php 		do_settings_sections('ash'); 			?>
	<?php 		submit_button('Save Changes','primary','btnSubmit');							?>
</form>
