<?php

if (!defined('ABSPATH')){
    exit;
}

 
 
  function CSMS_insert_data()
  {
    global $wpdb;
	$email = sanitize_email($_POST['mail_to']);
    $table_name = $wpdb->prefix . 'reports';
    $ins =  $wpdb->query( $wpdb->prepare( "INSERT INTO $table_name( email, created_by )VALUES ( %s, %d )", $email, get_current_user_id() ) );     

}
  
   
  
  function CSMS_test_mail() 
   {
	if(!current_user_can('manage_options'))
    wp_die ( 'Insufficient Access Priv' );
	if(isset($_POST['mail_to']))
		{
		
		 if(wp_verify_nonce($_POST['CSMS_test_mail_nonce_field'], 'CSMS_test_mail_nonce_action'))
		 {	 
			if(!empty($_POST['mail_to']))
				{
					$to=sanitize_email($_POST['mail_to']);
					$subject=sanitize_text_field($_POST['mail_subject']);
					$body=" This is the test mail from ".get_bloginfo('name');
					$headers = array('Content-Type: text/html; charset=UTF-8'); 
					$test_email=wp_mail($to, $subject, $body, $headers );
					
					if($test_email)
					{
				    CSMS_insert_data();
						?>
						<div class="notice notice-success is-dismissible">
							<p><?php _e( 'Email has been sent!' ); ?></p>
						</div>
						<?php
					}
					else
					{
						?>
						<div class="notice notice-error is-dismissible">
							<p><?php _e( 'Email not sent! , Check your server setting' ); ?></p>
						</div>
						<?php
					}
				}
		  }
		}

    
	
	?>
	<div class="wrap">
	<h1><?php _e( 'Test Server Mail' ); ?></h1>
	
	<form method="post">		
		
		
		<table class="form-table">
			<tr valign="top">
				<th scope="row" style=" width: 10%;font-size: 18px;font-family: sans-serif;"><?php _e( 'To' ); ?></th>
				<td>
					<input type="email" placeholder="email@gmail.com" name="mail_to" value=""/>
					<p class="description"><i><?php _e( 'Enter "To address" here.' ); ?></i></p>
				</td>
			</tr> 
			<tr valign="top">
				<th scope="row" style=" width: 10%;font-size: 18px;font-family: sans-serif;"><?php _e( 'Subject' ); ?></th>
				<td>
					<input type="text" name="mail_subject" placeholder="Test Mail" />
					<p class="description"><i><?php _e( 'Enter mail subject here' ); ?></i></p> 
				</td>
			</tr> 			
		</table> 
		<?php wp_nonce_field( 'CSMS_test_mail_nonce_action', 'CSMS_test_mail_nonce_field' ); ?>
		<?php submit_button($text = 'Test'); ?>
		</form>

		
		<?php
		
		
		
		
 }	
  
  CSMS_test_mail();
  