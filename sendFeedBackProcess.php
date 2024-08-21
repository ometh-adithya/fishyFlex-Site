<?php

include "connection.php";
session_start();

$name = $_POST["name"];
$email = $_POST["email"];
$feedback = $_POST["feedback"];
$product = $_POST["product"];

if (!isset($_SESSION["user"])) {
    echo "please signin First";
    header("Location: signin.php");
}

if(empty($name)){
    echo "please enter your name";
}else if(strlen($name) > 50){
    echo "your name must have maxsimum 100 characters";
}else if(empty($email)){
    echo "please enter email";
}else if(strlen($email) > 100){
    echo "your email addres must have maxsimum 100 characters";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "invalid email";
}else if(empty($feedback)){
    echo "please enter your feedback";
}else if(strlen($feedback) > 100){
    echo "your feedback must have maxsimum 100 characters";
}else{

    Database::iud("INSERT INTO `feedback`(`uname`, `uemail`, `feedback`, `product_product_id`) VALUES ('$name', '$email', '$feedback', '$product') ");
    echo "success";

}

?>
