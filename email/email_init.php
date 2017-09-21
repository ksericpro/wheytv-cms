<?php
/**
 * Init Email
 * Author : Eric See
 * 6/11/2016
 */
 
define('SMTP_HOST','smtp.gmail.com');
define('SMTP_PORT', 465); //465 or 587
define('SMTP_EMAIL_USERNAME','wheytvroot@gmail.com');
define('SMTP_EMAIL_PASSWORD', 'wheytv12345');
define('EMAIL_TEMPLATES_FOLDER','email_templates');

$EMAIL_DETAILS = array(
	"EMAIL_SIGNUP_SUBJECT"=>
	array(
		"SUBJECT"=>"Whey TV Sign Up",
		"TEMPLATE"=>EMAIL_TEMPLATES_FOLDER."/email_signup.html"
	)
);

?>