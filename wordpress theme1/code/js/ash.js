  $(window).on('beforeunload', function() {
   $(window).scrollTop(0);
});

jQuery(document).ready( function($){
	$("body").css("padding-top", "0px");
	 $(".col-md-4 p" ).slideUp( 800 );         
 
  
  //Smooth scrolling 
   $( ".smooth" ).click(function(e) { 
   	var linkHref =$(this).attr('href');
		var ele=linkHref.substr(linkHref.indexOf("#") + 1)     
		var Tolo=$("#"+ ele ).offset();
	  e.preventDefault();   
     
      $('html, body').stop().animate({ scrollTop: Tolo.top },500);  
     
   });

  
  
   $( ".MoveUpDown" ).click(function(e) {
     var elem =  $( ".MoveUpDown" ).offset().top * 1.2;
     
      
     e.preventDefault();   
      $('html, body').animate({ scrollTop  : elem },1500);  
   });
  
  
  
  
  
  
  
	//custom Ash script
	//init functoin
	revealPosts();
	fixed = 0;
	var title="";
	$('<style>.navbar-fixed:before{content:"'+document.title+'" ;  font-size:30px; display:inline-block; float:left; color:white;}</style>').appendTo('head');  
	//variable
	var carousel = '.ash-carousel-thumb' ;
	var last_scroll = 0;
		console.log (1);
		
	ash_get_bs_thumb( carousel );
	
	$(carousel).on('slid.bs.carousel', function(){	
		ash_get_bs_thumb(carousel);
 		});
	
		
		
		
	function ash_get_bs_thumb( carousel ){
		
	$(carousel).each(function(){
		var nextThumb =	$(this).find('.item.active').find('.next-image-preview').data('image');
		//console.log (nextThumb);
		var prevThumb =	$(this).find('.item.active').find('.prev-image-preview').data('image');
		//console.log (prevThumb);
		$(this).find('.carousel-control.right').find('.thumbnail-container').css({'background-image' : 'url('+nextThumb+')' });		
		$(this).find('.carousel-control.left').find('.thumbnail-container').css({'background-image' : 'url('+prevThumb+')' });		
		});


	}	
	/*     PopOVer */	
  

 $( ".circle" ).click(function() {
 	$(".col-md-4 p" ).not((($(this).parent()).find('p'))).slideUp('fast');    
  (($(this).parent()).find('p')).slideToggle( "1000" );
});

$(document).click(function(e){
    // Check if click was triggered on or within .circle
    if(( $(e.target).closest(".circle").length > 0 ) ||( $(e.target).closest(".col-md-4 p").length > 0 )) {
    return false;
    }else{
    $(".col-md-4 p" ).slideUp( 800 );  
    }

});


 				

  
  
  
	
	/*     AJAX   Functions */	
	
		$(document).on('click','.ash-load-more:not(.loading)', function(){
		//console.log( $(this).data('title')); 
		
		var that = $(this);	
		var page = $(this).data('page');
		title = $(this).data('title');
		var ajaxurl = that.data('url');
		var prev = that.data('prev');
	
		if( typeof prev === 'undefined' ){	prev = 0;}
			console.log( '46-prev='+ prev +'newPage='+newPage ); 
		if( prev == 1){	var newPage = page-1;}
		if (prev == 0){ var newPage = page+1;}
		
		
			console.log( '53-prev='+ prev +'newPage='+newPage ); 
			
		that.addClass('loading').find('.text').slideUp(320);
		that.find('.glyphicon-refresh').addClass('spin');
		
						$.ajax({
							url : ajaxurl,
							type : 'post',
							data : { 
									title : title,
									page : page,
									prev : prev,
									action: 'ash_load_more' 
							},
							error : function( response ){ 
									console.log( response ); 
							},		
							success : function( response ){ 
							
								if ( response == 0){
									
								$('.ash-posts-container').append('<div class="text-center"><h3> you have reached end of posts nothing more to load</h3></div>');		
								that.slideUp(320);
								} else {
							
									setTimeout(function(){
								
												
													
												if( prev == 1){
													$('.ash-posts-container').prepend( response );
													
												}
												if (prev == 0){
													$('.ash-posts-container').append( response );		
														
												}
												if (newPage == 1 ){
													that.slideUp(320);									
												}
												if (newPage != 1){
													that.data('page', newPage );
													that.removeClass('loading').find('.text').slideDown(320);
													that.find('.glyphicon-refresh').removeClass('spin');	
													
												}
												
								
									revealPosts();	
										
									},1000);
									
							}
						}
						});  
		});

		
		
	/* Helper Functions */
	
	
	
	
	
		
    $(window).scroll(function() {
	var scroll = $(window).scrollTop() +1;
	


	if( Math.abs( scroll - last_scroll ) > $(window).height()*0.01){
		
		last_scroll = scroll;
		$('.page-limit').each(function( index ){
			
			if( isVisible( $(this) ) &&(title =="" ) ){
//				
				history.replaceState( null, null, title + $(this).attr("data-page") );
				return(false);
			}
		});
				
	} 	
    });
	
	
	
	
	
	
	
	
	
	
	
	
	
	

/* Helper Functions */


function revealPosts(){
  
/* to trigger popover*/
  $('[data-toggle="popover"]').popover();
  
  
	var posts = $('article:not(.reveal)');
	var i = 0;
	setInterval(function(){
		if ( i >= posts.length ) return false;
		var el = posts[i] ;
		$(el).addClass('reveal').find('.ash-carousel-thumb').carousel();
    $(".reveal" ).slideDown( 800 );     
		i++
	},200);
	
}	
function isVisible( element ){
			var scroll_pos = $(window).scrollTop();
			var window_height = $(window).height();
			var el_top = $(element).offset().top;
			var el_height = $(element).height();
			var el_bottom = el_top + el_height;
			return (( el_bottom - el_height*1.1 > scroll_pos ) && ( el_top < ( scroll_pos+1.1*window_height ) ) );
			
		}


  
  
  
/* Contact Form */
  
  
  
 $('#AshContactForm').on('submit', function(e){
 e.preventDefault();
   $('.has-error').removeClass('has-error');
	 $('.js-show-feedback').removeClass('js-show-feedback');
   
   var form = $(this),
   		 name = form.find('#name').val(),
  		email = form.find('#email').val(),
    message = form.find('#message').val(),
    ajaxurl = form.data('url');  
   
         if ( name==='' ){
            $('#name').parent('.form-group').addClass('has-error');
                return;
          }
         if ( email ==''  ){
            $('#email').parent('.form-group').addClass('has-error');
                return;
          }   
       	 if ( message ==''){
            $('#message').parent('.form-group').addClass('has-error');
             return;
          }   
    

     form.find('input, button, textarea').attr('disabled','disabled');
   		$('.js-form-submission').addClass('js-show-feedback');


   $.ajax({
							url : ajaxurl,
							type : 'post',
							data : { 
									name : name,
									email : email,
									message : message,
									action: 'ash_save_contact_form' 
							},
     					error : function( response ){ 
								  $('.js-form-submission').removeClass('js-show-feedback');
                  $('.js-form-error').addClass('js-show-feedback');
                	form.find('input, button, textarea').removeAttr('disabled');
							},		
							success : function( response ){ 
                if ( response == 0 ){
                  
                 setTimeout(function(){
                      $('.js-form-submission').removeClass('js-show-feedback');
                      $('.js-form-error').addClass('js-show-feedback');
                      form.find('input, button, textarea').removeAttr('disabled');
                 },1000);
                } else {
                  setTimeout(function(){
                      $('.js-form-submission').removeClass('js-show-feedback');
                      $('.js-form-success').addClass('js-show-feedback');
                      form.find('input, button, textarea').removeAttr('disabled').val('');
                 },1000);  
                }
              }
   });
   
   console.log(form);

 
 }) 
  
  
  
  
  


					
						
								$('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
									event.preventDefault(); 
									event.stopPropagation(); 
									$(this).parent().siblings().removeClass('open');
									$(this).parent().toggleClass('open');
								});
			
						

  
});

