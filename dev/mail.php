<?php
   use PHPMailer\PHPMailer\PHPMailer;
   require 'Exception.php';
   require 'PHPMailer.php';
   require 'SMTP.php';

function send_group_mail($subject,$msg,$link)
{
   $mail             = new PHPMailer;
   $mail->IsSMTP(); // telling the class to use SMTP
   $mail->SMTPAuth   = true;                  // enable SMTP authentication
   $mail->SMTPSecure = "tls";
   $mail->Host       = "smtp.gmail.com";      // SMTP server
   $mail->Port       = 587;                   // SMTP port
   $mail->Username   = "@gmail.com";  // username
   $mail->Password   = "";            // password
   
   $mail->SetFrom('rfkmartin@gmail.com', 'NCAA MBB Pool');
   
   $mail->Subject    = $subject;
   
   $mail->MsgHTML($msg);
   
   $sql = 'select email,name from user';
   $data = mysqli_query ( $link, $sql );
   while ( list ( $email,$name) = mysqli_fetch_row ( $data ) )
   {
      $mail->AddAddress($email, $name);
   }
   
   if(!$mail->Send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
   }
}
?>