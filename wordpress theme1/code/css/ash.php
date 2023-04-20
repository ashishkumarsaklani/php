<?php

require_once('../../../../wp-config.php'); 
$headColor = get_option( 'color_scheme_1' );
 
// secondary color
$backgroundColor = get_option( 'color_scheme_2' );
 
// link color
$link_color = get_option( 'link_color' );
 
// hover or active link color
$hover_link_color = get_option( 'hover_link_color' );


// Paragraph Text color
$txt_color = get_option( 'text_color' );

// Meta color
$meta_color = get_option( 'meta_color' );

   
/*

@package ash_theme

/*=========		 IMport	 	 ============*/



/*===============================================
			MIXINS
===============================================*/





 //header("Content-type: text/css; charset: UTF--8");

?>


@keyframes MoveUpDown {
  from {
transform: translate3d( 0px , 0px, 0px);
opacity: 0;
}
to {
transform: translate3d( 0px , 20px, 0px);
opacity: 1;
}
}


.MoveUpDown {
  animation-name: MoveUpDown;
  animation-duration: 1000ms;
  animation-iteration-count: infinite;
  animation-timing-function: linear; 
  position:fixed;
	z-index:1300;
	bottom:0;
}



@keyframes spin {
  from {
    transform: rotate(0deg); }
  to {
    transform: rotate(360deg); } }

.spin {
  animation-name: spin;
  animation-duration: 1000ms;
  animation-iteration-count: infinite;
  animation-timing-function: linear; }

/*===============================================
			Variables
===============================================*/


.ash-pop{
min-height:600px;
width:250px;
visibility: visible;


}
.ash-pop h3{
visibility: visible;

}

#AshContactForm{
    clear: both;
    width: 80%;
    margin: auto;
}


::-webkit-scrollbar {
    width: 15px;
}

::-webkit-scrollbar-track {
      background-color:<?php echo $backgroundColor ?>;
   -webkit-box-shadow: inset 0 0 1px rgba(0,0,0,0.3);
} /* the new scrollbar will have a flat appearance with the set background color */
 
::-webkit-scrollbar-thumb {
    background: <?php echo $backgroundColor ?>;
    -webkit-box-shadow: inset 0px 0px 24px -2px  <?php echo $headColor ?>;} /* this will style the thumb, ignoring the track */
 
::-webkit-scrollbar-button {
      background-color:<?php echo $backgroundColor ?>;
   -webkit-box-shadow: inset 0px 0px 15px -4px  <?php echo $headColor ?>;
} /* optionally, you can style the top and the bottom buttons (left and right for horizontal bars) */
 
::-webkit-scrollbar-corner {
      background-color:<?php echo $backgroundColor ?>;
} /* if both the vertical and the horizontal bars appear, then perhaps the right bottom corner also needs to be styled */
/*=======================			Form Control			=======================*/
/* Change Autocomplete styles in Chrome*/
input:-webkit-autofill,
input:-webkit-autofill:hover, 
input:-webkit-autofill:focus
input:-webkit-autofill, 
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {

  -webkit-text-fill-color: <?php echo $txt_color ?> ;
  -webkit-box-shadow: rgba(230,230,102,0.8) 1000px #000 inset;
  transition: background-color 5000s ease-in-out 1s;
  background-color: rgba(241, 241, 241, 0.1) ;
}



.form-control-msg {
display :none;
 font-size: 25px; 
}

.form-control {
    color: <?php echo $headColor ?> !important;
    background-color: rgba(241, 241, 241, 0.1) !important;
    border: 1px solid  <?php echo $headColor ?> !important;
}
.form-control: focus ,.form-control: hover {
box-shadow: rgba(230,230,102,0.8) 1000px #000 inset;
}

.has-error .form-control-msg {
display :block;
}

.js-show-feedback{
display:block;
}
   
   
.custom-logo{
float: left ;  
margin-top: 60px;
margin-left: 10px;  
position:fixed;
z-index:500;  
}
   

/*=======================			place holder 			=======================*/
.header-container, .ash-format-image .entry-header {
  text-shadow: 0 3px 1px black; 
border: white 10px solid;
}
.entry-header {  height: 70%;}
.entry-excerpt.image-caption {
  background: -moz-linear-gradient(top, rgba(76, 76, 76, 0) 0%, rgba(76, 76, 76, 0.01) 1%, rgba(89, 89, 89, 0.12) 12%, rgba(102, 102, 102, 0.25) 25%, rgba(71, 71, 71, 0.39) 39%, rgba(44, 44, 44, 0.5) 50%, rgba(0, 0, 0, 0.51) 51%, rgba(17, 17, 17, 0.6) 60%, rgba(43, 43, 43, 0.76) 76%, rgba(28, 28, 28, 0.91) 91%, #131313 100%);
  /* FF3.6-15 */
  background: -webkit-linear-gradient(top, rgba(76, 76, 76, 0) 0%, rgba(76, 76, 76, 0.01) 1%, rgba(89, 89, 89, 0.12) 12%, rgba(102, 102, 102, 0.25) 25%, rgba(71, 71, 71, 0.39) 39%, rgba(44, 44, 44, 0.5) 50%, rgba(0, 0, 0, 0.51) 51%, rgba(17, 17, 17, 0.6) 60%, rgba(43, 43, 43, 0.76) 76%, rgba(28, 28, 28, 0.91) 91%, #131313 100%);
  /* Chrome10-25,Safari5.1-6 */
  background: linear-gradient(to bottom, rgba(76, 76, 76, 0) 0%, rgba(76, 76, 76, 0.01) 1%, rgba(89, 89, 89, 0.12) 12%, rgba(102, 102, 102, 0.25) 25%, rgba(71, 71, 71, 0.39) 39%, rgba(44, 44, 44, 0.5) 50%, rgba(0, 0, 0, 0.51) 51%, rgba(17, 17, 17, 0.6) 60%, rgba(43, 43, 43, 0.76) 76%, rgba(28, 28, 28, 0.91) 91%, #131313 100%);
  /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#004c4c4c', endColorstr='#131313',GradientType=0 );
  /* IE6-9 */ }


.ash-popover{
cursor : pointer;
color :#ff9d1d;
 display:block !important;
 max-width: 800px!important;
 width:auto;
}
.popover-title{

}
.popover-content{

padding:10px;
text-align:center;
font-size:10px;
}

.popover-title{
color :<?php echo $headColor ?>;
}
.popover-content{
color :<?php echo $meta_color ?>;
}





  /*=========		 BOOTSTRAP CORRECTION	 	 ============*/

 
h2{    color:<?php echo $headColor ;?> ; text-shadow: 0px 0px 2px #000000;}

h3 , p{
    font-size: 16px;
    letter-spacing: .9px;
    font-family: raleway;
		text-align:justify;
  
}
.section{ min-height:300px; transition: all 0.5s ease-in-out;box-shadow: inset 0px 0px 0px 0px #ff0;overflow:hidden; margin-top:30px;z-index:500;}
.section:hover{ box-shadow: inset 0px 0px 12px -5px <?php echo $headColor ?>; }
.section:hover h2{    color: <?php echo $headColor ?>; text-shadow: 0px 0px 9px #000000;}
.section1{    background-color: rgba(255,255,255,.2);filter: grayscale(0%);  -webkit-filter: grayscale(0%);transition: all 0.5s ease-in-out;margin-top: 0px;box-shadow: 0px 0px 1px #ff0, 0px 0px 20px <?php echo $headColor ?>;}
.section1:hover { filter: grayscale(0%);  -webkit-filter: grayscale(0%); }
.section2{    background-color: rgba(255,255,255,.2);}
.section3{    background-color: rgba(255,255,255,.2); filter: grayscale(50%);  -webkit-filter: grayscale(50%);transition: all 0.5s ease-in-out;}
.section3:hover { filter: grayscale(0%);  -webkit-filter: grayscale(0%); }
.section4{    background-color: rgba(255,255,255,.2);  filter: grayscale(50%);  -webkit-filter: grayscale(50%);transition: all 0.5s ease-in-out;}
.section4:hover { filter: grayscale(0%);  -webkit-filter: grayscale(0%); }
.section5{    background-color: rgba(255,255,255,.2); filter: grayscale(50%);  -webkit-filter: grayscale(50%);transition: all 0.5s ease-in-out;}
.section5:hover { filter: grayscale(0%);  -webkit-filter: grayscale(0%); }
.section6{    background-color: rgba(255,255,255,.2);}
.section7{  width:80%;  background-color: rgba(255,255,255,.2);    margin: auto;}
.section7 p{ text-align:center;} 




.container{
 padding-left:0 !important;
 padding-right:0 !important;
 width:100%;


 }  
    /*=========		 Custom CORRECTION	 	 ============*/
 .container-fluid{
	 overflow:hidden;
 } 
 
.content-area{
display:table;
 width:100%;

}
.site-main{
display:table-cell;
}
.cont  {
    width: 100%;
    height: 70%;
    overflow: visible;
    position: relative;
 
}  
.circlebox{
font-size: 18px;
    height: 180px;
    width: 180px;
    line-height: 220px;
    color: #9d9d9d;
    background: #ffffff;
    border: 1px solid <?php echo $headColor ?>;
 		 border-style: double;
    border-radius: 30px;
   float	:left ;

}
.circlebox:hover {
  filter: grayscale(0%);
  -webkit-filter: grayscale(0%);

  	
}


 
.outer {
   position: relative;
    width: 180px;
    height: 180px;
    border-radius: 30px;
 		overflow: hidden;
}
.cover-text{
   	background: rgba(0, 0, 0, 0.9); 
  	position:absolute ;
    width: 178px;
    height: 178px;
 		top :-180px ;
  	text-align: center;
		-webkit-transform: matrix(-1, 0, 0, 1, 0, 0);
    -moz-transform: matrix(-1, 0, 0, 1, 0, 0);
    -o-transform: matrix(-1, 0, 0, 1, 0, 0);
    transform: matrix(-1, 0, 0, 1, 0, 0);

}
.cover-text p {
  	font-size : 10px;
		text-align :center;
		color:<?php echo $headColor ?> ;
}
.cover-text h3 {
  	font-size : 20px;
		text-align :center;
		color: <?php echo $headColor ?>; 
}

.outer:hover .cover-text{
 top :0px ;
 -webkit-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out; 
}


.circle{
   	visibility: visible;
		font-size: 18px;
    height: 222px;
    width: 222px;
    line-height: 220px;
    color: #9d9d9d;
    background: #ffffff;
    border: 1px solid <?php echo $headColor ?>;
 		 border-style: double;
    border-radius: 500px;
   float	:left ;
  filter: grayscale(100%);
  -webkit-filter: grayscale(100%);
  
}
.circle:hover {
  filter: grayscale(0%);
  -webkit-filter: grayscale(0%);
    border-color: <?php echo $headColor ?> !important;
  	
}
.circle:hover .cover1 , .circle:hover .cover-text{
color: <?php echo $headColor ?>!important;
}


.outerC {
     background: rgba(17, 17, 17, 0.4); 
    width: 219px;
    height: 219px;
    border-radius: 120px;
  	-webkit-transition: all 0.5s ease-in-out;
  	transition: all 0.5s ease-in-out;
    margin: -19px 1px;
}
.circle:hover .outerC{
 background: rgba(17, 17, 17, 0.0); 
}
.cover1 {
 text-align: center;
 color: rgba(255, 255, 0, 0.1);
}

.hover-zoom {
  -webkit-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  background-size: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-color: gray;
  position: relative;
}
.hover-zoom:hover {
  background-size: 160%;

}



article{
}

.art-cont  {
transform: rotateX(36deg);
margin-top: 20px;
margin-bottom: 20px;
height: 400px; 
}

.art-cont-horizontal{
height: 180px;
width: 180px;
}

.art-cont-horizontal:hover .flipper,.art-cont-horizontal.hover .flipper  {
transform: rotateY(180deg);

}


.art-cont:hover .flipper, .art-cont.hover .flipper {
transform: rotateX(-12deg);
}
.flipper {
	transition: 1.6s;
	transform-style: preserve-3d;
	position: relative;
}



h1 {
  font-size: 48px;
  font-weight: 200; }
  h1 a {
    color: #000000; }

h1.entery-title {
  font-size: 30px;
  font-weight: 200;
  line-height: 1.5em;
  padding: 0; }
  h1.entery-title:before {
    content: "	";
    display: inline-block;
    position: relative; }
  h1.entery-title:after {
    content: "";
    display: inline-block;
    position: relative; }
h3 a{
  font-size:20px;
	color: <?php echo $txt_color ?>!important;
  line-height: 1.3em;}
.button-container{
  border-bottom: 4px solid #898989;
}

.entery-footer {
  padding: 10px 5px;
  color: <?php echo $meta_color ?>; 
  font-size: 10px;
  text-transform: uppercase; }
  .entery-footer a {
    color: <?php echo $meta_color ?>; 
    display: inline-block;
    font-size: 10px; }
    .entery-footer a:hover, .entery-footer a:focus {
      color: #cccccc;
      font-weight: 500; }
  .entery-footer .tags-list {
    margin-left: 2px; }
  .entery-footer a {
    padding: 0 4px; }

/*=========			Generic Section	 ============*/
body {
  font-family:'Raleway', 'Josefin Sans', 'Helvetica Neue', 'Helvetica' , Arial , Verdana, sans-serif;     background-color:<?php echo $backgroundColor ?>!important;}

.background-image {
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
  background-attachment:scroll;}

.table {
  display: table;
  height: 100%;
  width: 100%; }
  .table .table-cell {
    display: table-cell;
    height: 100%;
    width: 97%;
    vertical-align: middle; }

a {
  -webkit-transition: color 320ms ease;
  -moz-transition: color 320ms ease;
  -ms-transition: color 320ms ease;
  -o-transition: color 320ms ease;
  transition: color 320ms ease; }
  a:hover, a:focus {
    text-decoration: none; }

/*=========			Header Section	 ============*/
.header-container {
  position: relative;
  display: block;
  height: 90%; }


.nav-container {
  position: absolute;
  bottom: 3px;
  left: 0;
  right: 0; 
  height:50px;
  width: 100%;}

.nav-previous{
  float:left;
  font-size:large;
  margin-top :0;

}
.nav-next{
  float:right;
  font-size:large;
  margin-top :0;
  
}
.screen-reader-text{
text-align: center;
}

.comments-area{
margin-top:100px;
}

.comment{
height: 200px;
}  
  
 @media only screen and (min-width:768px){
	 
/*=========			Side BAR Section 	 ============*/


 /*=========			NAV BAR Section 	 ============*/
  

   
.navbar-ash {
  text-align: center;
  border: none;
  border-radius: 0;
  min-height: auto;
	padding-top: 10px;
  background: rgba(0, 0, 0, 0.65);
  border-top: 1px solid rgba(255, 255, 255, 0.1); }
  .navbar-ash ul {
    float: none; }
  .navbar-ash li {
    float: none;
    display: inline-block; }
  .navbar-ash .open a {
    background-color: rgba(0, 0, 0, 0.3);
    border-color: #337ab7; }



	
.navbar .open a:focus, .navbar .open a:hover  {
  background-color: rgba(0, 0, 0, 0.3);
  border-color: #337ab7;
  color:#fbff00;
   }

.navbar-ash li.active a {
 		 opacity: 1; 
     color:<?php echo $headColor ?>;
     font-size: 16px;}
  .navbar-ash li.active a:after {
    -webkit-transform: translateY(0px);
    -moz-transform: translateY(0px);
    -ms-transform: translateY(0px);
    -o-transform: translateY(0px);
    transform: translateY(0px);
    opacity: 1; 
 		color:<?php echo $headColor ?>;
}
.navbar-ash li a {
  text-transform: uppercase;
  color: #fff;
  font-size: 12px;
  background-color: rgba(0, 0, 0, 0.3);
  opacity: 0.7;
  letter-spacing: 0.05em;
  background: none;
  -webkit-transition: opacity 320ms ease;
  -moz-transition: opacity 320ms ease;
  -ms-transition: opacity 320ms ease;
  -o-transition: opacity 320ms ease;
  transition: opacity 320ms ease; }
  .navbar-ash li a:hover, .navbar-ash li a:focus, .navbar-ash li a.open, .navbar-ash li a:visited {
    background: none;
    opacity: 1;
    background-color: rgba(0, 0, 0, 0.3); }
  .navbar-ash li a:hover:after, .navbar-ash li a:focus:after, .navbar-ash li a.open:after, .navbar-ash li a:visited:after {
    -webkit-transform: translateY(0px);
    -moz-transform: translateY(0px);
    -ms-transform: translateY(0px);
    -o-transform: translateY(0px);
    transform: translateY(0px);
    opacity: 1; 
   }
  .navbar-ash li a:after {
    content: "";
    position: absolute;
    display: block;
    left: 15px;
    right: 15px;
    bottom: 10px;
    height: 2px;
    background: #fff none repeat scroll 0% 0%;
    -webkit-transition: all 320ms ease;
    -moz-transition: all 320ms ease;
    -ms-transition: all 320ms ease;
    -o-transition: all 320ms ease;
    transition: all 320ms ease;
    opacity: 0;
    -webkit-transform: translateY(8px);
    -moz-transform: translateY(8px);
    -ms-transform: translateY(8px);
    -o-transform: translateY(8px);
    transform: translateY(8px); }
.navbar-ash li ul.dropdown-menu {
  border: 0;
  border-radius: 0;
  background: rgba(0, 0, 0, 0.3); }
  .navbar-ash li ul.dropdown-menu li {
    display: block; }

.navbar-ash li ul.dropdown-menu li a:hover {
  background: rgba(0, 0, 0, 0.3) !important;
  color: #fff; }

.navbar-ash li ul.dropdown-menu li a:focus, .navbar-ash li ul.dropdown-menu li a:visited {
  background: rgba(0, 0, 0, 0.3) !important;
  color: #fff; }
.navbar-ash li ul.dropdown-menu li a:after {
  display: table; }

.dropdown-menu {
  min-width: 10%; }

.dropdown-menu sub-menu {
  opacity: 0;
  display: none;
  width: 18%; }

.dropdown-menu li {
  position: relative;
  border-radius: 10px;
  border: 2px solid rgba(178, 178, 178, 0.9); }

.dropdown-menu li:hover > ul {
  opacity: 1;
  display: block;
  left: 100%;
  top: 0%;
  margin-left: 0px; }
  

   
.site-title {
  position:fixed;
  color:<?php echo $headColor ?>;
  margin-left: 50px;
  margin-top: 55px;
  font-size:400%;
  font-family: raleway;
  z-index:500;
  float: left;
    }


.site-description {
  font-size:120%;
  color: #fff;
  z-index:500;
 
}
.smmenu{
font-size:24px;border-radius: 50%; width: 200px; height: 35px;  
}
  }









ul, li, .menu-navi-container {
  margin: 0;
  padding: 0;
  border: 0;
  text-align: center;
  text-transform: uppercase;
  font-size: medium;
  
}
.menu-navi-container {width :200px;}

ol, ul { list-style: none }




body {
  font: 100% "roboto", "Trebuchet MS", sans-serif;
}

a { text-decoration: none; }

/**
 * Hidden fallback
 */


/**
 * Styling navigation
 */


/**
 * Styling top level items
 */

.menu-navi-container a, .menu-navi-container label {
    display: block;
    color: #807f7f;
    background-color: #b3b2b2;
    text-shadow: 1px 1px #ffffff;
  -webkit-transition: all .25s ease-in;
  transition: all .25s ease-in;
  border: 1px solid;
  border-radius: 50px;
}

.menu-navi-container a:focus, .menu-navi-container a:hover, .menu-navi-container label:focus, .menu-navi-container label:hover {
     color: rgb(84, 75, 75);
    background: #8e8d8d;
}

.menu-navi-container label { cursor: pointer;   font-size: medium;}

/**
 * Styling first level lists items
 */

.sub-menu_1 a, .sub-menu_1 label {
  background: #252525;
  box-shadow: inset 0 -1px #373737;
}

.sub-menu_1 a:focus, .sub-menu_1 a:hover, .sub-menu_1 label:focus, .sub-menu_1 label:hover { background: #131313; }

/**
 * Styling second level list items
 */

.sub-menu_2 a, .sub-menu_2 label {
  background: #353535;
  box-shadow: inset 0 -1px #474747;
}

.sub-menu_2 a:focus, .sub-menu_2 a:hover, .sub-menu_2 label:focus, .sub-menu_2 label:hover { background: #232323; }

/**
 * Styling third level list items
 */

.sub-menu_3 a, .sub-menu_3 label {
  background: #454545;
  box-shadow: inset 0 -1px #575757;
}

.sub-menu_3 a:focus, .sub-menu_3 a:hover, .sub-menu_3 label:focus, .sub-menu_3 label:hover { background: #333333; }

/**
 * Hide nested lists
 */

.sub-menu_1, .sub-menu_2, .sub-menu_3 {
  height: 100%;
  max-height: 0;
  overflow: hidden;
  -webkit-transition: max-height .5s ease-in-out;
  transition: max-height .5s ease-in-out;
  font-size: medium;
}


.sub-menu_0 input[type=checkbox]:checked + label + ul { /* reset the height when checkbox is checked */
max-height: 1000px; 
display: block;

}


/**
 * Rotating chevron icon
 */

label > span {
  float: right;
  -webkit-transition: -webkit-transform .65s ease;
  transition: transform .65s ease;
}

.sub-menu_0 input[type=checkbox]:checked + label > span {
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}


@media (max-width: 768px) {
/*=========		Mobile	NAV BAR Section 	 ============*/


.smmenu{
font-size:16 px;border-radius: 50%; width: 120px; height: 35px;  
}

  


  
.site-title {
  color:<?php echo $headColor ?>;
  margin-top: 1%;
  font-size:300%;
  text-align:center;
	padding: 5px 0px;
  font-family: raleway;
  z-index:0;
	background-color: rgba(0,0,0,0.7);

    }

  
   
.custom-logo{
float: left ;  
margin-top: 5px;
z-index:500;  
}
  
 
.site-description {
  font-size:100%;
  color: #fff;
  z-index:0;

}

.navbar-toggle{
	background-color:  rgba(0, 0, 0, 0.7) ;
	z-index:500;
	float: right;
  margin-left: 90%;
  position: absolute;
  top: 0px;
	 }
.icon-bar{
	
	background-color:  rgba(255,255,255, 1);
}

.nav-container {
    position: fixed;
    right: 0;
    top: 0;
    z-index: 1;
		height:7%;
}
.navbar-fixed-top {
    top: 0px; 
		margin-left:0%;
} 



ul{
	background: rgba(255,255,255,.8)
}
.nav>li>a {
color : black;
text-shadow:none;	
	
}

 .dropdown-menu>li>a{
    color: #efefef;
    background: rgba(0, 0, 0, 0.71);
    text-shadow: none;
    text-align: center;
}

/*=========		Mobile	NAV BAR Section 	 ============*/
}







}


h1 {
  font-size: 48px;
  font-weight: 200; }
  h1.entry-title {
    line-height: 1.5em;
    margin: 50px 0 20px;
    padding: 0; }
  h1:before, h1:after {
    content: "	  	";
    display: inline-block;
    position: relative; }

.entry-meta {
  font-size: 13px;
  font-weight: 300;
  color: #bfbfbf; }
  .entry-meta a {
    text-decoration: none;
    font-weight: 500;
    color: #bfbfbf; }
  .entry-meta:hover, .entry-meta:focus {
    color: #cccccc; }

.standard-featured-link {
  display: block;
  position: relative; }
  .standard-featured-link:hover .standard-featured:after, .standard-featured-link:focus .standard-featured:after {
    background-color: transparent; }

.standard-featured {
  height: 300px;
  display: block;
  position: relative; }
  .standard-featured:after {
    -webkit-transition: background-color 320ms ease;
    -moz-transition: background-color 320ms ease;
    -ms-transition: background-color 320ms ease;
    -o-transition: background-color 320ms ease;
    transition: background-color 320ms ease;
    content: '';
    position: absolute;
    display: block;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.15);
    box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.35); }
  .standard-featured .entry-excerpt.image-caption {
    -webkit-transition: transform 320ms ease;
    -moz-transition: transform 320ms ease;
    -ms-transition: transform 320ms ease;
    -o-transition: transform 320ms ease;
    transition: transform 320ms ease;
    -webkit-transform: translateY(100%);
    -moz-transform: translateY(100%);
    -ms-transform: translateY(100%);
    -o-transform: translateY(100%);
    transform: translateY(100%); }
  .standard-featured:hover .entry-excerpt.image-caption {
    -webkit-transform: translateY(0%);
    -moz-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%); }

.entry-excerpt {
  margin: 30px 0 0px; }
  .entry-excerpt p {
    font-size: 17px;
    line-height: 1.5em;
    font-weight: 300;
    letter-spacing: 0.02em; }

.btn-ash {
  -webkit-transition: all 320ms ease;
  -moz-transition: all 320ms ease;
  -ms-transition: all 320ms ease;
  -o-transition: all 320ms ease;
  transition: all 320ms ease;
  text-transform: uppercase;
  font-size: 14px;
  font-weight: 200;
  color: <?php echo $meta_color ?>; 
  padding: 8px 12px;
  border-radius: 0;
  border: 1px solid #898989;
  background-color: transparent; }
  .btn-ash:hover, .btn-ash:focus {
    color: #fff;
    border-color: #333333;
    background-color: #333333; 
			.btn-ash a { color: <?php echo $meta_color ?>; }

}
			
/*#  IMAGE POST FORMAT */
.ash-format-image .entry-header {
  position: relative; }
.ash-format-image h1,
.ash-format-image .entry-meta,
.ash-format-image .entry-header {
  color: #ffffff; }
  .ash-format-image h1 a,
  .ash-format-image .entry-meta a,
  .ash-format-image .entry-header a {
    color: #ffffff; }

.image-text {
  position	: absolute;
  width: 100%; }

.image-text h2 {
	   margin-top: -100px;
    text-align: center;
    color: #000000;
    text-shadow: 0px 0px 3px white, 0px 0px 7px #ffffff, 0px 0px 12px #ffffff, 0px 0px 19px black, 0px 0px 21px black;
    font-size: 44px;
}
.section1:hover .image-text h2 {
color: <?php echo $headColor ?>;
text-shadow: 0px 0px 3px black, 0px 0px 7px #ffffff, 0px 0px 12px #ffffff, 0px 0px 19px #000000, 0px 0px 21px black;
}



.entry-excerpt.image-caption {
  position: absolute;
  left: 0;
  bottom: 0;
  right: 0; }
  .entry-excerpt.image-caption p {
    margin: 20px 0;
    font-size: 14px; }

.image-caption {
  color: #fff; }

/*#  AUDIO POST FORMAT */
.ash-format-audio h1 {
  font-size: 30px; }
  .ash-format-audio h1.entry-title {
    display: inline-block;
    margin-right: 20px; }
  .ash-format-audio h1:before, .ash-format-audio h1:after {
    display: none; }
.ash-format-audio .entry-meta {
  display: inline-block;
  margin-bottom: 0; }
.ash-format-audio .entry-content iframe {
  width: 100%;
  height: 180px; }

/*#  VIDEO POST FORMAT */
.ash-format-video header h1.entry-title {
  margin-top: 20px; 
}

/*#  GALLERY POST FORMAT */
.slide {
height:80%;
}
.ash-format-gallery header h1.entry-title {
  margin-top: 20px; }
.ash-format-gallery .standard-featured {
		width:100.4%;}
  .ash-format-gallery .standard-featured:after {
    background-color: rgba(255, 255, 255, 0.01); }
.ash-format-gallery .carousel-control {
  font-size: 30px;
  width: auto; }
  .ash-format-gallery .carousel-control .preview-container {
    position: relative;
    display: block;
    padding: 0px;
    background-color: transparent;
    line-height: 0;
    -webkit-transition: background-color 320ms ease;
    -moz-transition: background-color 320ms ease;
    -ms-transition: background-color 320ms ease;
    -o-transition: background-color 320ms ease;
    transition: background-color 320ms ease; }
    .ash-format-gallery .carousel-control .preview-container .thumbnail-container {
      position: absolute;
      display: block;
      height: 50px;
      width: 50px;
      border-radius: 50%;
      background-color: #000000;
      top: -10px;
      -webkit-transition: transform 320ms ease;
      -moz-transition: transform 320ms ease;
      -ms-transition: transform 320ms ease;
      -o-transition: transform 320ms ease;
      transition: transform 320ms ease;
      -webkit-transform: scale(0);
      -moz-transform: scale(0);
      -ms-transform: scale(0);
      -o-transform: scale(0);
      transform: scale(0); }
    .ash-format-gallery .carousel-control .preview-container .glyphicon-menu-right, .ash-format-gallery .carousel-control .preview-container .glyphicon-menu-left {
      -webkit-transition: transform 320ms ease;
      -moz-transition: transform 320ms ease;
      -ms-transition: transform 320ms ease;
      -o-transition: transform 320ms ease;
      transition: transform 320ms ease;
      -webkit-transform: translateX(0%);
      -moz-transform: translateX(0%);
      -ms-transform: translateX(0%);
      -o-transform: translateX(0%);
      transform: translateX(0%);
      opacity: 1; }
  .ash-format-gallery .carousel-control.right .preview-container {
    padding-left: 10px;
    border-radius: 35px 0 0 35px; }
    .ash-format-gallery .carousel-control.right .preview-container .thumbnail-container {
      left: 1px; }
  .ash-format-gallery .carousel-control.left .preview-container {
    padding-right: 10px;
    border-radius: 0 35px 35px 0; }
    .ash-format-gallery .carousel-control.left .preview-container .thumbnail-container {
      right: 1px; }
  .ash-format-gallery .carousel-control:hover .preview-container, .ash-format-gallery .carousel-control:focus .preview-container {
    background-color: transparent; }
    .ash-format-gallery .carousel-control:hover .preview-container .thumbnail-container, .ash-format-gallery .carousel-control:focus .preview-container .thumbnail-container {
      -webkit-transform: scale(1);
      -moz-transform: scale(1);
      -ms-transform: scale(1);
      -o-transform: scale(1);
      transform: scale(1); }
    .ash-format-gallery .carousel-control:hover .preview-container .glyphicon-menu-left, .ash-format-gallery .carousel-control:focus .preview-container .glyphicon-menu-left {
      -webkit-transform: translateX(-100%);
      -moz-transform: translateX(-100%);
      -ms-transform: translateX(-100%);
      -o-transform: translateX(-100%);
      transform: translateX(-100%);
      opacity: 0; }
    .ash-format-gallery .carousel-control:hover .preview-container .glyphicon-menu-right, .ash-format-gallery .carousel-control:focus .preview-container .glyphicon-menu-right {
      -webkit-transform: translateX(100%);
      -moz-transform: translateX(100%);
      -ms-transform: translateX(100%);
      -o-transform: translateX(100%);
      transform: translateX(100%);
      opacity: 0; }

/*#  QUOTE POST FORMAT */
.ash-format-quote .quote-content {
  font-size: 42px;
  font-weight: 100;
  line-height: 1.3em;
  letter-spacing: 0.03em; }
  .ash-format-quote .quote-content:before, .ash-format-quote .quote-content:after {
    content: '"';
    display: inline-block;
    position: relative;
    color: #ccc; }
.ash-format-quote .quote-author {
  color: #403636;
  font-size: 15px;
  letter-spacing: 0.09em; }

/*#  FOOTER SECTION */
.ash-footer {
  background-color: #333;
  padding: 20px 0;
  display: block;
	color: white;
  font-size: 14;
  font-family: monospace; }

/*#  AJAX SECTION */
.ash-posts-container {
 // padding-top: 40px; }
  .ash-posts-container article {
    -webkit-transition: all 320ms ease;
    -moz-transition: all 320ms ease;
    -ms-transition: all 320ms ease;
    -o-transition: all 320ms ease;
    transition: all 320ms ease;
    -webkit-transform: translateY(50px);
    -moz-transform: translateY(50px);
    -ms-transform: translateY(50px);
    -o-transform: translateY(50px);
    transform: translateY(50px);
    opacity: 0; }
    .ash-posts-container article.reveal {
      -webkit-transform: translateY(0px);
      -moz-transform: translateY(0px);
      -ms-transform: translateY(0px);
      -o-transform: translateY(0px);
      transform: translateY(0px);
      opacity: 1; }

.btn-ash-load {
  display: block;
  width: 200px;
  color: #222;
  font-size: 30px;
  margin: 0 auto;
  margin-top: 180px;
  cursor: pointer;
  opacity: 0.7;
  -webkit-transition: opacity 320ms ease;
  -moz-transition: opacity 320ms ease;
  -ms-transition: opacity 320ms ease;
  -o-transition: opacity 320ms ease;
  transition: opacity 320ms ease; }
  .btn-ash-loadhover, .btn-ash-loadfocus
  .btn-ash-loadloading {
    opacity: 1; }
  .btn-ash-loadloading {
    cursor: default; }
  .btn-ash-load span {
    display: block; }



/*# sourceMappingURL=ash.css.map */

/*# sourceMappingURL=ash.css.map */
duration: 1000ms;
  animation-iteration-count: infinite;
  animation-timing-function: linear; }




/*# sourceMappingURL=ash.css.map */

/*# sourceMappingURL=ash.css.map */
