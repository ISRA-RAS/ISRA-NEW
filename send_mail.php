<?php
    $upload_folder = "uploads/";
    $name_of_uploaded_file = $_FILES["attachment"]["name"];
    $ext = pathinfo($name_of_uploaded_file, PATHINFO_EXTENSION);
    $ALLOWED_EXTENSIONS =array("doc","docx");
    $validFileExtension = in_array($ext, $ALLOWED_EXTENSIONS);
    if($validFileExtension != TRUE){
        echo('Invalid file type');
        exit();
    }
    move_uploaded_file($_FILES["attachment"]["tmp_name"],$name_of_uploaded_file);
      $mailto = "ieeerasvitchennai@gmail.com";
    $mailSub ="New Submission ISRA 2020" ;
    $mailSub1 = "Thank You for Submission to ISRA 2020";
    $date=date("d-m-Y h:i:s A");
    $mailMsg = nl2br("Name:".$_POST['name']."\n"."E.Mail: ".$_POST['email']."\n"."Mobile: ".$_POST['mobile']."\n"."College Location: ".$_POST['location']."\n"."Institution: ".$_POST['institution']."\n"."Department : ".$_POST['dept']."\n"."Topic: ".$_POST['topic']."\n"."\n"."Submitted Date:".$date);
   require 'PHPMailer-master/PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'tls';
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 587; // or 587 or 465 for ssl
   $mail ->IsHTML(true);
   $mail ->Username = "ieeerasvitchennai@gmail.com";
   $mail ->Password = "ieeeras@vitcc";
   $mail ->SetFrom("yourmail@gmail.com");
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg;
   $mail ->addAttachment($name_of_uploaded_file);
   $mail ->AddAddress($mailto);

   if(!$mail->Send())
   {
       echo "Mail Not Sent,Please Try again after sometime. Sorry for the inconvinence caused.";
   }
   else
   {
       echo "Submission Successful, Check your Mail Id for Confirmation. Mail us at admin@isra-ras.in in case of enquiry."; 
       echo '<p style="color: red"><a href="http://www.isra-ras.in">  Click here to visit ISRA site</a></p>';
   }
   $email1=$_POST['email'];
   $mail->ClearAddresses();
   $mail->AddAddress($email1);
   $mail ->Subject = $mailSub1;
   $mail->AddAttachment('img/ISRA 2020.png');
   $mail->Body =($mailMsg);
   $mail->Send();
   $file_pointer = $name_of_uploaded_file;
   unlink($file_pointer);  
?>

