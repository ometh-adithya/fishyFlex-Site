<?php

include "connection.php";

include "mail/PHPMailer.php";
include "mail/SMTP.php";
include "mail/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET["e"])){

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'");
    $num = $rs->num_rows;

    if($num == 1){

        $code = uniqid();
        Database::iud("UPDATE `users` SET `verification_code`='".$code."' WHERE `email`='".$email."'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'omethadithya236@gmail.com';
        $mail->Password = '*****************';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('omethadithya236@gmail.com', 'Reset Password');
        $mail->addReplyTo('omethadithya236@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'FishyFlex Forgot password Verification Code';
        $bodyContent = '<h1 style="color:green;">Your Verification Code is '.$code.'</h1>';
        $mail->Body    = $bodyContent;

        if(!$mail->send()){
            echo "Verification code sending failed.";
        }else{
            echo "Success";
        }

    }else{
        echo ("Invalid Email Address.");
    }

}else{
    echo ("Please enter your Email Address in Email Field.");
}

?>