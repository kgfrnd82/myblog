<?php
		
session_start();
session_regenerate_id();
if(!isset($_SESSION['user']))      // if there is no valid session
{
    header("Location: index.php");
}


		$st= $_POST['otptext2'];
		$st1 = $_POST['otptext'];
		$name=$_POST['txtnm'];
		$sbj=$_POST['txtsbj'];
		$msg=$_POST['txtmsg'];
		$email=$_POST['txtemail'];
		

		if($st===$st1)
		{
			
			//echo "correct OTP";
			// for mail purpose
include("class.phpmailer.php");
include("class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

$mail             = new PHPMailer();

$body             = "Name: ".$name."  
                     <br />Subject: ".$sbj."  
                     <br />Email: ".$email." 
                     <br />Message : ".$msg;
//echo $body;
$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port

$mail->Username   = "msitbcaresponse@gmail.com";  // GMAIL username
$mail->Password   = "msitbca1234";            // GMAIL password, Some times if two step varification enabled in this mail id, Mail will not be sent.

$mail->From       = "msitbcaresponse@gmail.com";
$mail->FromName   = "MSIT Response Team";
$mail->Subject    =  "Client detail";
$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);
$mail->AddAddress("kgfrnd82@gmail.com","Kumar Gourab Mallik");

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  
  
  echo "<h1> Thank you for your interest.. please be in touch </h1>";

}
		}
		else
			echo "wrong OTP";
		//echo $st ." and ". $st1;
	?>