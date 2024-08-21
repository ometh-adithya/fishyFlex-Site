<?php

include "connection.php";
session_start();

$msg = $_POST["msg"];
$email = $_POST["email"];
$name = $_POST["name"];

if (!isset($_SESSION["admin"])) {
    header("Location : adminSignIn.php");
} else if (empty($email)) {
    echo "please enter your email";
} else if (strlen($email) > 100) {
    echo "Customer email must have maxsimum 100 characters";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "invalid email";
} else if (empty($name)) {
    echo "please enter your name";
} else if (empty($msg)) {
    echo "please enter your msg";
}

include "mail/PHPMailer.php";
include "mail/SMTP.php";
include "mail/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$rs = Database::search("SELECT * FROM `users` WHERE `email`='$email'");
$num = $rs->num_rows;

if ($num == 1) {

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
    $mail->Subject = 'FishyFlex Admin Message for you';
    $bodyContent = '<h1 style="color:green;">Your Message is ' . $msg . '</h1>';
    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo "Message sending failed.";
    } else {
        echo "Success";
    }
} else {
    echo ("Invalid Email Address.");
}
