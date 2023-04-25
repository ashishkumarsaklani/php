<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php include ("../includes/layouts/header.php");?>
<?php	find_selected_pages_public(true); ?>

<div id="main">


			
			<div id="navigation" <?php if("public") {?> style="line-height:1.7;color:rgba(83, 163, 255, 1);" <?php }?>>
			<?php 
			$pages= $_GET["pages"];
			$subject=find_owner_for_page($pages);
										
							if ($current_subjects)  { ?> <img src="image1.php?tab=owner&r=pic&id=<?php echo $current_subjects["owner_id"] ;?> ; " style=" height:140 ;width:140;resize:both" class="img"	alt="">  <?php 
							} elseif ($current_pages)  {	?>
							<img src="image1.php?tab=owner&r=pic&id=<?php  $subject=find_owner_for_page($current_pages["id"]) ; echo $subject["owner_id"] ;?>" style=" height:140 ;width:140;resize:both" class="img"	alt=""> <?php }?>
			<?php 
			
								echo public_navigation2($current_subjects,$current_pages,$current_step1,$current_step2);
							
								//echo public_navigation($current_subjects,$current_pages,$current_step1,$current_step2);
						
					 ?>
			</div>
			<div id="navigation3" <?php if("public") {?> style="line-height:1.7;color:rgb(138, 0, 0)" <?php }?>> 
<img src="image1.php?tab=subjects&r=menu_pic&id=<?php  find_owner_for_page($current_pages["id"]) ; echo $subject["id"] ;?> "style=" height:140 ;width:210;resize:both; clear:right; float:left; margin-left:0px "; class="teaserimg fadeinDown animated" >
					<?php echo public_navigation3($pages,$current_step1,$current_step2); ?>
					
			
			</div>
		
			
			
			<?php if($current_step2) { ?>

														
			<?php }?>
			

			<div  style="padding-top:20px;padding-left:10;min-width:0;overflow:hidden ; min-height:200;margin-left:5; padding 0 2em;";>			
			<?php	
				$step1_set=find_step1_for_pages($pages);
				while($step1 =mysqli_fetch_assoc($step1_set)){
					//echo $step1["menu_name"];
					$step2_set=find_step2_for_step1($step1["id"]);
					while($step2 =mysqli_fetch_assoc($step2_set)){
						?>
						<div id="<?php echo $step2["menu_name"];?>" style="z-index:0;display:none;padding:0px;float:left;width:100%;margin-top:-20;overflow:hidden ;min-height:1020; padding 0 2em;color:#353535;position: relative"; class="txtbox";>			
							
<?php

			
	//------------------------------------------------------------------------------------------------------------------------

	$table = trim(strtolower($step2["menu_name"]));
	$tables_set = find_all($table) ;
	echo "</br>";
	echo "<div style =\"width:100% ;margin-top:0;\"></br>"	;	
		
	while ($table =mysqli_fetch_assoc($tables_set)){
	
	if (($table["content"]) != null){
		echo "<div class=\"hoverzone fadeinDown animated\" style=\"z-index:10;padding-top:20px;float:left;width:100%;" ;// will apply proprties set to DIV
		$elements_properties = find_properties_for_elements_name($table["menu_name"]);
		while ($properties =mysqli_fetch_assoc($elements_properties)) {
				if 	($properties["menu_name"]!="content"){	

			
	
		echo "{$properties["menu_name"]}:";
		$name = trim(strtolower($properties["menu_name"]));
		$value_set=find_row($step2["menu_name"],"id = {$table["id"]}");
		while ($value =mysqli_fetch_assoc($value_set)) {
		echo "{$value[$name]}";	
		}
		echo ";";
		}	
		}
		echo "\">";
		
		echo  nl2br(htmlentities($table["content"]));
		echo ". ";
	

	echo "</div>" ;

	}}
	echo "</div>" ; 	



	//------------------------------------------------------------------------------------------------------------------------
	



?>						
		
							</div>	
							<?php	}}?>
							</div>	
							</div>
							</div>	
			<?php include ("../includes/layouts/footer.php");?>