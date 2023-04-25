<?php require_once ("../includes/session.php");?>
<?php require_once ("../includes/db_connect.php");?>
<?php include ("../includes/functions.php");?>
<?php include ("../includes/layouts/header.php");?>
<?php	find_selected_pages_public(true); ?>

<div id="main">

			
			<div id="navigation" class="hidden" <?php if("public") {?> style="line-height:1.7;" <?php }?>>

						<?php if ($current_subjects)  { ?> 
						<a href="index.php">
							<img src="image1.php?tab=owner&r=pic&id=<?php echo $current_subjects["owner_id"] ;?>" ; style=" height:140;width:140;resize:both" class="img"	alt="">  <?php 
							echo "</a>";
							//if ($current_subjects["owner_id"]==5){
								echo public_navigation2($current_subjects,$current_pages,$current_step1,$current_step2);
							//}
	/* 						else {
								echo public_navigation($current_subjects,$current_pages,$current_step1,$current_step2);
							}
							 */
						
						} elseif ($current_pages)  {	?>
						<a href="index.php">
							 <img src="image1.php?tab=owner&r=pic&id=<?php  $subject=find_owner_for_page($current_pages["id"]) ; echo $subject["owner_id"] ;?>"  style=" height:140;width:140;resize:both" class="img"	alt=""> <?php
						echo "</a>";	
							
							//if ($subject["owner_id"]==5){
								echo public_navigation2($current_subjects,$current_pages,$current_step1,$current_step2);
							//}
	/* 						else {
								echo public_navigation($current_subjects,$current_pages,$current_step1,$current_step2);
							} */
							

							 } ?>
		
			

			</div>
			<div id="pages">
								
							<?php if ($current_subjects)  {	?>

									
									<div class="fadeinDown animated">
										<a href="index.php">
										<img src="image1.php?tab=subjects&r=menu_pic&id=<?php echo $current_subjects["id"] ;?> ;"style=" height:140 ;width:210;resize:both; clear:right; float:left; margin-top:20px;margin-left:0px "; class="teaserimg" ><br/>
										</a>
									<h2><?php echo htmlentities($current_subjects["menu_name"]);?>	</h2>
									</div>		
											<?php $pages_set = find_pages_for_subjects($current_subjects["id"]); 
												while($pages =mysqli_fetch_assoc($pages_set)) 
												{ ?>
												<a href="step2.php?pages=<?php echo $pages["id"] ;?>">	
												<div class="container ">
														<?php
														echo "<h3>{$pages["menu_name"]}</h3></br>";
														echo "<p>{$pages["content"]}</p>";
														?>
												</div>
												</a>
										<?php } 
											 } elseif ($current_pages)  
											 {			 
											 ?>
											 <a href=<?php if($current_step1) { echo "index.php?pages={$current_step1["pages_id"]}";} else{ echo "index.php?subjects={$current_pages["subjects_id"]}";} ?>>
											<div class="container" >	
											<div style="clear:right; float:left; height:200 ;width:200; margin-top:-3px; margin-left:11px"; class="teaserimg" ;>
												
												<img src="image1.php?tab=subjects&r=menu_pic&id=<?php  find_owner_for_page($current_pages["id"]) ; echo $subject["id"] ;?> "style=" height:180 ;width:250; clear:right; float:left; margin-top:-30px;margin-left:-60px"; class="teaserimg" ;		
												
											 <h2><?php 	echo htmlentities($current_pages["menu_name"]);?></h2>
											</div>
											</div></a>
											
												<div style="float:padding-top:20px;float:left;width:60%; height:auto;margin:0;text-align:center; padding 0 2em;";>	
													
															</br> <h3>Pages in <?php echo  htmlentities($current_pages["menu_name"]); ?> </h3></br> 
															 
												</div>	

												<?php $step1_set = find_step1_for_pages($current_pages["id"]); 
											if (isset($step1_set)){
												while($step1 =mysqli_fetch_assoc($step1_set)) 
												{ ?>
												<a href="index.php?pages=<?php echo $current_pages["id"];?>&step1=<?php echo $step1["id"] ;?>">
														
													<div style=" height:80 ;width:200;clear:right; float:left;  margin-top:0px;margin-left:50px"; class="teaserimg " ;>
														 <h3><?php echo  htmlentities($step1["menu_name"]); ?> </h3>
													</div>	
												</a>
												
											<?php } }else {
														
														redirect_to("index.php");
													}?>
													<?php if(($current_step1) and(!$current_step2)) { ?>	
													
													<div style="float:padding-top:20px;float:left;width:70%; height:auto;margin:20;text-align:center; padding 0 2em;color:#d4e6f4;background:#353535;";>			
													<h3><?php echo  htmlentities($current_step1["menu_name"]); ?> </h3><br/>
													<?php echo  nl2br(htmlentities($current_step1["content"])); ?>	
													</div>
													<div style="float:padding-top:20px;float:left;width:80%; height:auto;margin:0;text-align:center; padding 0 2em;";>	
													
															</br> <h3>Pages in <?php echo  htmlentities($current_step1["menu_name"]); ?> </h3></br> 
															 
													</div>		 
															<?php $step2_set = find_step2_for_step1($current_step1["id"]);
															while($step2 =mysqli_fetch_assoc($step2_set)){?>
															
															<div style=" height:80 ;width:200;clear:right; float:left;  margin-top:0px;margin-left:50px"; class="teaserimg " ;>
															<a href="step2.php?pages=<?php echo "{$current_pages["id"]}&step1={$current_step1["id"]}&step2={$step2["id"]}";?>">	
															<h3><?php echo  htmlentities($step2["menu_name"]); ?> </h3>
															</a>
															</div>	
															
															
															
															
													<?php } }}else { ?> 
						<svg width="88%" style="float:left;clear:right;" height="20%" class="fadeInDown animated" version="1.1" xmlns="http://www.w3.org/2000/svg">
						  <text class="path" xml:space="preserve" text-anchor="middle"
						  font-family="arial" font-size="300%" id="svg_1" y="90%" x="50%"
						  stroke-width="10" stroke="rgb(1, 141, 125)" fill="white">Welcome to Website</text>
					
			 <path class="path" fill="#013731" stroke="#000000" stroke-width="4" stroke-miterlimit="10"d="m38,67c0.38889,-0.29605 0.94066,-0.12401 1.55556,-0.5921c0.61488,-0.46811 0.77777,-1.18422 1.55556,-1.77632c1.16666,-0.88815 5.11597,-3.51529 7,-5.32895c2.41226,-2.32213 5.36026,-5.13957 8.16666,-7.99342c2.19868,-2.23584 4.84944,-4.63423 7.3889,-7.40131c2.10118,-2.28952 4.30638,-3.92226 5.83333,-5.92106c1.67041,-2.18658 3.01596,-4.18382 3.88889,-5.32894c1.40756,-1.84647 2.64209,-2.98641 3.5,-4.4408c0.35623,-0.60389 2.46797,-2.57727 3.11111,-3.25658c1.01691,-1.07407 1.25792,-1.82139 1.55556,-2.36842c0.21046,-0.38681 1.16667,-0.5921 0.77777,-0.5921c-0.38889,0 -0.38889,0.88816 -0.38889,1.18421c0,0.5921 -0.38889,1.18421 -0.77777,1.77631c-0.3889,0.59211 -0.89862,2.39218 -1.16667,3.25658c-0.39958,1.28857 -1.81313,2.68406 -2.33333,4.4408c-0.6226,2.10253 -1.82562,4.76131 -2.72223,7.10526c-1.03149,2.69661 -1.65211,4.78105 -2.33333,6.80922c-0.82312,2.45062 -1.16138,3.60985 -1.94444,5.92105c-0.52306,1.54376 -1.16667,3.55263 -1.55556,4.73685c-0.38889,1.1842 -0.59909,2.0882 -0.77779,2.66446c-0.19978,0.64429 -0.38889,1.48027 -0.38889,1.77632c0,0.29605 0.43607,1.1483 -0.38889,1.77632c-0.27499,0.20934 -0.38889,-0.5921 -0.38889,-0.88817c0,-0.29605 0,-0.5921 0,-1.1842c0,-0.5921 0,-0.88815 0,-1.48027c0,-0.88815 0,-1.77631 0,-2.36841c0,-0.29605 0.29764,-0.93323 0,-1.48027c-0.21046,-0.38681 -0.59909,-0.90399 -0.77779,-1.48026c-0.19978,-0.64429 -0.73019,-0.61165 -1.16666,-1.18422c-0.70378,-0.92323 -2.3013,-1.59479 -2.72223,-2.36842c-0.14882,-0.27351 -0.77777,-0.5921 -1.16667,-0.88815c-0.38889,-0.29605 -0.83698,-0.36551 -1.55556,-0.5921c-0.5081,-0.16023 -1.00557,-0.17343 -1.55554,-0.5921c-0.27499,-0.20935 -0.78944,-0.15137 -2.33334,-0.29607c-1.59142,-0.14914 -2.72221,-0.29605 -3.11111,-0.29605c-0.38889,0 -1.16666,0 -1.94444,0c-0.77777,0 -1.55556,0.29605 -1.94444,0.59212c-0.38889,0.29605 -1.16666,0.5921 -1.55556,0.88815c-0.38889,0.29605 -0.77777,0.5921 -1.55556,1.1842c-0.38889,0.29605 -0.84509,0.54851 -1.16666,0.88817c-0.50845,0.53703 -0.77779,0.5921 -0.77779,0.88815c0,0.29605 -0.11389,0.67882 -0.38889,0.88815c-0.27498,0.20935 -0.38889,0.29605 -0.38889,0.5921c0,0.29607 0,0.59212 0,0.88817c0,0.5921 0.4623,0.71504 0.77777,0.88815c0.99765,0.54741 0.3889,1.18422 0.77779,1.18422c0.38889,0 0.80737,0.47881 1.16666,0.5921c0.50812,0.16022 0.77779,0.5921 1.16667,0.5921c0.77779,0 1.17708,0.22803 1.55556,0.29605c0.84633,0.1521 1.04745,0.43188 1.55556,0.5921c0.71857,0.22659 1.16856,-0.02917 1.55556,0c1.9733,0.14876 2.33333,0.29605 3.11111,0.29605c0.77777,0 1.55554,0 2.72221,0c1.55556,0 3.1387,0.10571 7.38889,-0.5921c4.70218,-0.77202 10.23312,-1.8235 14.77779,-3.25658c2.41016,-0.76001 3.94989,-1.05978 6.22221,-1.77632c1.60678,-0.50667 3.14162,-0.82594 4.27779,-1.1842c1.60678,-0.50667 2.72221,-0.88815 2.72221,-1.1842l0.77779,0l0.38889,0
c1.77383,-1.34313 4.60258,-3.55484 5.73236,-4.48771c0.6986,-0.57684 0.84668,-1.25237 1.14648,-1.79509c0.1896,-0.34324 0,-0.29918 -0.22929,-0.29918c-0.45859,0 -0.68789,0 -1.14648,0c-0.68788,0 -1.33535,0.14548 -1.83436,0.29918c-0.44632,0.13747 -1.02238,0.20747 -1.14647,0.59836c-0.08775,0.27641 -0.53796,0.51024 -0.91718,1.19672c-0.2998,0.54271 -0.3345,0.80583 -0.45859,1.19672c-0.08775,0.27641 0.08775,0.62113 0,0.89754c-0.12409,0.39089 -0.22929,0.89754 -0.22929,1.19672c0,0.29918 0,0.59836 0,1.19672c0,0.59837 0.38808,1.85073 0.68788,2.39345c0.37921,0.68648 0.89828,0.71411 1.14647,1.4959c0.1755,0.55281 0.26354,1.03944 0.4586,1.19672c0.43613,0.35171 0.34079,1.144 0.45858,1.79509c0.10537,0.58236 0,0.89754 0,1.4959c0,0.29918 0.2411,0.98691 0,1.4959c-0.26955,0.56907 -2.31092,2.03139 -2.98083,2.39345c-0.94738,0.51202 -4.57975,1.04704 -7.79601,1.19672c-2.29149,0.10666 -3.66871,-0.29918 -4.35659,-0.59836l-0.68789,0l-0.22929,-0.29918l0,-0.29918
18.3382,-4.78308 2.23032,-1.56612c0.89216,-0.78308 2.2483,-1.93821 4.46069,-3.52383c2.69856,-1.93411 5.13934,-4.50809 8.47529,-7.04766c3.36983,-2.56537 6.24496,-5.48151 9.8135,-8.61382c3.56856,-3.13227 6.12596,-5.57261 8.47528,-7.83074c2.12698,-2.04438 7.31026,-6.17729 9.81349,-10.17994c0.95996,-1.53494 1.20757,-3.24698 0.89214,-3.52383c-0.31541,-0.27685 -2.23033,-0.39152 -3.12245,-0.39152c-0.89217,0 -2.28778,-0.34039 -3.56856,0c-1.53931,0.40909 -2.85661,1.33574 -4.90674,2.74075c-2.48615,1.7038 -3.27693,2.23389 -4.0146,3.13227c-0.58324,0.71025 -1.07767,1.47263 -1.78429,2.74075c-0.61974,1.11225 -1.3382,2.34924 -1.78427,3.13231c-0.89214,1.56615 -1.51834,2.67121 -2.23033,4.30691c-1.81518,4.1702 -3.12248,8.61378 -3.56856,10.17993c-0.44604,1.56616 -0.97616,4.28483 -1.3382,5.48151c-0.58379,1.92956 -1.14618,4.35897 -1.78425,5.87307c-0.34607,0.82112 -0.67777,1.97282 -0.89216,3.13227c-0.22594,1.22215 -0.66298,1.88868 -0.89212,2.74075c-0.20499,0.76212 -0.65073,1.44612 -0.89216,1.95768c-0.17068,0.36176 -0.20466,1.0546 -0.44604,1.56615c-0.17072,0.36173 -0.65073,1.0546 -0.89216,1.56615c-0.17068,0.36173 -0.13065,1.05994 -0.44604,0.78308c-0.31543,-0.27685 0.15441,-1.45085 0.89213,-2.34924c0.5832,-0.71025 0.87811,-2.11903 1.78428,-3.52383c0.93242,-1.44551 1.48875,-2.47057 2.23032,-3.52383c0.66331,-0.94201 1.58722,-2.16099 3.12248,-3.13227c0.80917,-0.51194 1.46885,-0.89775 1.78428,-1.17464c0.3154,-0.27685 0.13065,-0.50619 0.44604,-0.78304c0.31544,-0.27689 0.89216,0 1.3382,0c0.44608,0 0.89215,0 1.3382,0c0.44609,0 0.75543,0.57115 1.33821,0.78304c0.41212,0.14983 0.13068,0.50623 0.44608,0.78308c0.3154,0.27685 0.5127,0.18571 0.89215,0.39156c0.84846,0.46028 0.44604,1.56612 0.44604,2.3492c0,0.78308 -0.10248,1.18511 0,1.56615c0.22919,0.85207 0.44609,1.56615 0.44609,1.95767c0,1.17463 0,2.34923 0,2.74075c0,0.39156 -0.13065,0.89779 -0.44609,1.17463c-0.3154,0.27685 -0.13063,0.5062 -0.44604,0.78308c-0.31543,0.27685 -0.44608,0.78304 -0.44608,1.17459l0,0.39152l0,-0.39152
2.71642,.42376 1.07463,-0.84753c0.71642,-0.84755 1.63702,-1.92453 4.29851,-4.2377c2.72339,-2.36693 3.55037,-3.42943 4.29851,-4.23769c2.06589,-2.23188 2.9323,-2.83607 3.58208,-3.39013c0.82193,-0.70084 0.68288,-1.31512 1.07463,-1.69508c0.99881,-0.96869 1.60703,-2.04417 1.79105,-2.9664c0.08231,-0.41241 0.35822,-0.42376 0.35822,-0.84754c0,-0.42376 -0.10492,-0.5479 -0.35822,-0.84754c-0.25328,-0.29964 -0.10492,-0.54787 -0.35822,-0.84754c-0.25328,-0.29964 -0.46312,-0.12411 -0.7164,-0.42376c-0.50659,-0.59931 -0.99234,0.01134 -1.07463,0.42376c-0.18404,0.92223 -0.82133,1.39544 -1.07463,1.69508c-0.2533,0.29964 -0.35822,1.27132 -0.35822,1.69508c0,0.42378 -0.53238,1.19663 -0.71642,2.11886c-0.08229,0.41241 -0.17418,0.77285 -0.3582,1.69508c-0.16461,0.82485 -0.35822,2.54259 -0.35822,4.23767c0,0.84754 -0.16434,1.1414 -0.3582,1.69508c-0.27417,0.78302 0,1.27132 0,1.69508c0,0.42378 0,0.84754 0,1.27132c0,0.42376 0,0.84754 0,1.27129c0,0.42378 0.1049,0.5479 0.3582,0.84753c0.2533,0.29965 0.35822,0.42378 0.71642,0.42378c0.35822,0 0.71642,0 1.79105,0c0.35822,0 0.3678,-0.32642 0.71642,-0.42378c0.77956,-0.21768 1.22627,-0.60523 3.22388,-2.54261c0.78354,-0.75989 1.79106,-1.2713 2.14926,-1.69508c0.71642,-0.84754 2.38168,-0.93048 3.22388,-2.54261c0.18832,-0.36046 0.35822,-0.42376 0.71643,-0.84754l0.3582,-0.42376,
.77383,-1.34313 4.60258,-3.55484 5.73236,-4.48771c0.6986,-0.57684 0.84668,-1.25237 1.14648,-1.79509c0.1896,-0.34324 0,-0.29918 -0.22929,-0.29918c-0.45859,0 -0.68789,0 -1.14648,0c-0.68788,0 -1.33535,0.14548 -1.83436,0.29918c-0.44632,0.13747 -1.02238,0.20747 -1.14647,0.59836c-0.08775,0.27641 -0.53796,0.51024 -0.91718,1.19672c-0.2998,0.54271 -0.3345,0.80583 -0.45859,1.19672c-0.08775,0.27641 0.08775,0.62113 0,0.89754c-0.12409,0.39089 -0.22929,0.89754 -0.22929,1.19672c0,0.29918 0,0.59836 0,1.19672c0,0.59837 0.38808,1.85073 0.68788,2.39345c0.37921,0.68648 0.89828,0.71411 1.14647,1.4959c0.1755,0.55281 0.26354,1.03944 0.4586,1.19672c0.43613,0.35171 0.34079,1.144 0.45858,1.79509c0.10537,0.58236 0,0.89754 0,1.4959c0,0.29918 0.2411,0.98691 0,1.4959c-0.26955,0.56907 -2.31092,2.03139 -2.98083,2.39345c-0.94738,0.51202 -4.57975,1.04704 -7.79601,1.19672c-2.29149,0.10666 -3.66871,-0.29918 -4.35659,-0.59836l-0.68789,0l-0.22929,-0.29918l0,-0.29918
18.3382,-4.78308 2.23032,-1.56612c0.89216,-0.78308 2.2483,-1.93821 4.46069,-3.52383c2.69856,-1.93411 5.13934,-4.50809 8.47529,-7.04766c3.36983,-2.56537 6.24496,-5.48151 9.8135,-8.61382c3.56856,-3.13227 6.12596,-5.57261 8.47528,-7.83074c2.12698,-2.04438 7.31026,-6.17729 9.81349,-10.17994c0.95996,-1.53494 1.20757,-3.24698 0.89214,-3.52383c-0.31541,-0.27685 -2.23033,-0.39152 -3.12245,-0.39152c-0.89217,0 -2.28778,-0.34039 -3.56856,0c-1.53931,0.40909 -2.85661,1.33574 -4.90674,2.74075c-2.48615,1.7038 -3.27693,2.23389 -4.0146,3.13227c-0.58324,0.71025 -1.07767,1.47263 -1.78429,2.74075c-0.61974,1.11225 -1.3382,2.34924 -1.78427,3.13231c-0.89214,1.56615 -1.51834,2.67121 -2.23033,4.30691c-1.81518,4.1702 -3.12248,8.61378 -3.56856,10.17993c-0.44604,1.56616 -0.97616,4.28483 -1.3382,5.48151c-0.58379,1.92956 -1.14618,4.35897 -1.78425,5.87307c-0.34607,0.82112 -0.67777,1.97282 -0.89216,3.13227c-0.22594,1.22215 -0.66298,1.88868 -0.89212,2.74075c-0.20499,0.76212 -0.65073,1.44612 -0.89216,1.95768c-0.17068,0.36176 -0.20466,1.0546 -0.44604,1.56615c-0.17072,0.36173 -0.65073,1.0546 -0.89216,1.56615c-0.17068,0.36173 -0.13065,1.05994 -0.44604,0.78308c-0.31543,-0.27685 0.15441,-1.45085 0.89213,-2.34924c0.5832,-0.71025 0.87811,-2.11903 1.78428,-3.52383c0.93242,-1.44551 1.48875,-2.47057 2.23032,-3.52383c0.66331,-0.94201 1.58722,-2.16099 3.12248,-3.13227c0.80917,-0.51194 1.46885,-0.89775 1.78428,-1.17464c0.3154,-0.27685 0.13065,-0.50619 0.44604,-0.78304c0.31544,-0.27689 0.89216,0 1.3382,0c0.44608,0 0.89215,0 1.3382,0c0.44609,0 0.75543,0.57115 1.33821,0.78304c0.41212,0.14983 0.13068,0.50623 0.44608,0.78308c0.3154,0.27685 0.5127,0.18571 0.89215,0.39156c0.84846,0.46028 0.44604,1.56612 0.44604,2.3492c0,0.78308 -0.10248,1.18511 0,1.56615c0.22919,0.85207 0.44609,1.56615 0.44609,1.95767c0,1.17463 0,2.34923 0,2.74075c0,0.39156 -0.13065,0.89779 -0.44609,1.17463c-0.3154,0.27685 -0.13063,0.5062 -0.44604,0.78308c-0.31543,0.27685 -0.44608,0.78304 -0.44608,1.17459l0,0.39152l0,-0.39152
			fill="none"/>
			
						</svg>


														<?php
														$subjects_set = find_all_subjects(); 
														while($subjects =mysqli_fetch_assoc($subjects_set)) 
													{	
														$sub_id = htmlentities($subjects["id"]); 
														$own_id =	htmlentities($subjects["owner_id"]); 
														?>
														<?php
														if (((isset($_SESSION["owner_id"])) and ($_SESSION["owner_id"] == $subjects["owner_id"] )) or (isset($_SESSION["admins_id"])))
															{
															$output = "<a href=\"manage_content.php?subjects={$sub_id}\">" ;
															}else{
															$output = "<a href=\"index.php?subjects={$sub_id}\">";
															}
														?>
														<?php echo $output ; ?>
												<div class="card-container pulse animated " style="height:180;width:280;resize:both;padding:10">
																  <div class="card " >
																	<div class="side"> 
																			<img src="image1.php?tab=subjects&r=menu_pic&id=<?php echo $sub_id ;?>" style="height:160;width:250;resize:both;"	alt="">    
																	</div>
																	<div class="side back" style="height:180;width:280;resize:both;">	
																			<img src="images.php?tab=owner&id=<?php  find_owner_by_id($own_id) ;   echo $owner["id"] ;?> "; height="80" width ="60" class="img"	alt=""> TEL :99909 88058   MAIL:<?php find_owner_by_id($own_id); echo $owner["email"] ; ?>
																	</div>
																  </div>
												</div>
														</a> 
														<?php	
													}
											} 
			?> 
			
			</div>		
</div>
	

<?php include ("../includes/layouts/footer.php");?>