<?php
$name=$_POST['cname'];
$email=$_POST['email'];
$sbj=$_POST['subject'];
$msg=$_POST['message'];

$str=generateRandomString();



// for mail purpose
include("class.phpmailer.php");
include("class.smtp.php"); // note, this is optional - gets called from main class if not already loaded

$mail             = new PHPMailer();

$body             = "your OTP is ".$str;
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
$mail->Subject    = "your OTP ";
$mail->AltBody    = "This is the body when user views in plain text format"; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);
$mail->AddAddress($email,$name);

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "OTP has been sent to your Email-id";
  
  echo "<form action='otpcheck.php' method='POST'>
    OTP: <input type='text' id='otptext' name='otptext'>
    <input type='hidden' id='otptext2' name='otptext2' value='".$str."'>

    <input type='hidden' id='txtemail' name='txtemail' value='".$email."'>
     <input type='hidden' id='txtnm' name='txtnm' value='".$name."'>
      <input type='hidden' id='txtsbj' name='txtsbj' value='".$sbj."'>
      <input type='hidden' id='txtmsg' name='txtmsg' value='".$msg."'>
    <button type='submit'> submit</button>
    </form>";

}


 
//echo $str;
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




?>