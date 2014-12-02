<?php
if(isset($_POST['email'])) {
     
    $admin_email_to = "only two in here";
    $admin_email_cc = "only one in here";
    $admin_email_bcc = "only one in here";
    $admin_email_subject = "Email subject here";
    
    function died($error) {
        // your error code can go here
        echo "There has been an error processing your registration form as we don't have the correct information on the form.  Please check the errors listed below and try again. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['first_name']) ||
        !isset($_POST['last_name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['company'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $phone = $_POST['phone']; // required
    $company = $_POST['company']; // required
    $job_title = $_POST['job_title']; // required

   /* $option = (array_key_exists('option name', $_POST) ? $_POST['option name'] : ''); // required */

         
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
  if(!preg_match($string_exp,$company)) {
    $error_message .= 'The company name you entered does not appear to be valid.<br />';
  }  
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    
function clean_string($string) {
  $bad = array("content-type","bcc:","to:","cc:","href");
  return str_replace($bad,"",$string);
}

$admin_email_message = '<html><body>';
$admin_email_message .= "Form details below.\n\n";
$admin_email_message .= "<p style=\"margin-top: 0 !important;\">First Name: ".clean_string($first_name)."<br/>";
$admin_email_message .= "Last Name: ".clean_string($last_name)."<br/>";
$admin_email_message .= "Email: ".clean_string($email_from)."<br/>";
$admin_email_message .= "Phone: ".clean_string($phone)."<br/>";
$admin_email_message .= "Company: ".clean_string($company)."<br/>";
$admin_email_message .= "Job Title: ".clean_string($job_title)."<br/>";
/* if($technical) { $admin_email_message .= "Option selected: ".clean_string($technical)."<br/>"; } */
$admin_email_message .= '</body></html>';

     
// create email headers
$headers = "From: " . $email_from . "\r\n";
$headers .= "Reply-To: ". $email_from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
$headers .= "Cc: " . $admin_email_cc . "\r\n";
$headers .= "Bcc: " . $admin_email_bcc . "\r\n";



if(@mail($admin_email_to, $admin_email_subject, $admin_email_message, $headers) // admin email
    /*&& @mail($email_from, $user_email_subject, $user_email_message, $headers)*/) // user email
{
//    header('Location: http://www.bigspring.co.uk/');
}
}
?>

		
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Starters | Welcome</title>
    <link rel="stylesheet" href="assets/dist/base.min.css" />
    <script src="assets/js/modernizr.js"></script>
  </head>
  <body>

	
	<div class="wrapper-main">