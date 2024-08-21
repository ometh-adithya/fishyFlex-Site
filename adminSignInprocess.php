<?php
session_start();
include "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];
$rememberme = $_POST["rememberme"];

if(empty($email)){
    echo "please enter email";
}else if(strlen($email) > 100){
    echo "your email addres must have maxsimum 100 characters";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "invalid email";
}else if(empty($password)){
    echo "please enter your password";
}else if(strlen($password) < 8 || strlen($password) > 16){
    echo "password must be containe 8 to 16 characters";
}else {

    $type = '1';

    $rs = Database::search("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password' AND `user_type_id`='$type'");
    $num = $rs->num_rows;

    if($num == 1){
        $data = $rs->fetch_assoc();
        $_SESSION["admin"] = $data;
        echo "success";
        if($rememberme == "true"){

            setcookie("email",$email,time()+(60*60*24*365));
            setcookie("password",$password,time()+(60*60*24*365));

        }else{

            setcookie("email","",-1);
            setcookie("password","",-1);

        }
    }else{
        echo "please signup first";
    }

}

?>