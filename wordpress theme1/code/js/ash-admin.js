jQuery(document).ready(function($){
	
	var	mediaUploader;
	
	$('#upload-button').on('click' ,function(e){
		e.preventDefault();
		if (mediaUploader) {
			mediaUploader.open();
			return;
		 }
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			
			title : 'Choose a Profile Picture',
			button: {
				text: 'Choose Picture'
			},
			multiple: false
		});
		
		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#profile-picture').val(attachment.url);
			$('#profile-picture-preview').css('background-image','url(' + attachment.url + ')');
				
		});
		
			mediaUploader.open();
				
	});
	
	
	$('#remove-picture').on('click',function(e){
		e.preventDefault();
		
		var answer = confirm("Are you sure you want to delete Your Profile Picture ?");
		if (answer == true ){
				$('#profile-picture').val('');
				$('.ash-general-form').submit();
			}
		return;
		
	});
  
  
// for image upload in user profile
  
   var _shr_media = true;
    var _orig_send_attachment = wp.media.editor.send.attachment;
 
    jQuery( '#shr-image' ).click( function() {
 
        var button = jQuery( this ),
                textbox_id = jQuery( this ).attr( 'data-id' ),
                image_id = jQuery( this ).attr( 'data-src' ),
                _shr_media = true;
 
        wp.media.editor.send.attachment = function( props, attachment ) {
 
            if ( _shr_media && ( attachment.type === 'image' ) ) {
                if ( image_id.indexOf( "," ) !== -1 ) {
                    image_id = image_id.split( "," );
                    $image_ids = '';
                    jQuery.each( image_id, function( key, value ) {
                        if ( $image_ids )
                            $image_ids = $image_ids + ',#' + value;
                        else
                            $image_ids = '#' + value;
                    } );
 
                    var current_element = jQuery( $image_ids );
                } else {
                    var current_element = jQuery( '#' + image_id );
                }
 
                jQuery( '#' + textbox_id ).val( attachment.id );
                                console.log(textbox_id)
                current_element.attr( 'src', attachment.url ).show();
            } else {
                alert( 'Please select a valid image file' );
                return false;
            }
        }
 
        wp.media.editor.open( button );
        return false;
    } );

  
  
  
  
  
  
  
  
  
  
  
  
  
 	
});

			

