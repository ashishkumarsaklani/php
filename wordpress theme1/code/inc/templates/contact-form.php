<form id ="AshContactForm" action="#" method="post" data-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div id="contactushere" style="clear:both; ">
	<div class="form-group">
	<input type="text" class="form-control" placeholder="Your Name" id="name"  name= "name" >
    <div class="text-danger form-control-msg"> Your Name is required </div>
	</div>
	<div class="form-group">
	<input type="email" class="form-control" placeholder="Your email" id="email"  name= "email" required="required">
        <div class="text-danger form-control-msg"> Your Email is required </div>
	</div>
	<div class="form-group">
	<textarea class="form-control" placeholder="Your message" id="message"  name= "message" required="required"></textarea>
       <div class="text-danger form-control-msg"> Message can not be Empty </div> 
	</div>
	
	<button type="submit" class="btn btn-default"> Submit </button>
 <div class="text-info form-control-msg js-form-submission">Submission in process </div> 
 <div class="text-success form-control-msg js-form-success"> Message Submitted </div> 
  <div class="text-danger form-control-msg js-form-error"> Message Failed please try again </div> 
 </div>
</form>
  