<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';

$mail       = new PHPMailer();
$mail->SMTPDebug = 1;
$mail->IsSMTP(true);            
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  
$mail->Host       = "mail.myyaara.com"; 
$mail->Port       =  25;                   
$mail->Username   = "support@myyaara.com";  
$mail->Password   = "sample123";  
$mail->SetFrom('support@myyaara.com', 'Myyaara Team');
$mail->AddReplyTo('support@myyaara.com','Myyaara Team');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send();   
}
?>