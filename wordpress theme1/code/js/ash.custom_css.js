
jQuery(document).ready( function($){
	
	var updateCSS = function(){
		$("#ash_css").val(editor.getSession().getValue() ); 	}
		$("#save-custom-css-form").submit( updateCSS );
});
var editor = ace.edit("customcss");
editor.setTheme("ace/theme/monokai");
editor.getSession().setMode("ace/mode/css");