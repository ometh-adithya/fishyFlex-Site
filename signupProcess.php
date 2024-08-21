<?php

include "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$nb = $_POST["nb"];
$email = $_POST["email"];
$pass = $_POST["pass"];
$gender = $_POST["gender"];

if(empty($fname)){
    echo "please enter your first name";
}else if(strlen($fname) > 40){
    echo "your first name must have maxsimum 40 characters";
}else if(empty($lname)){
    echo "please enter your last name";
}else if(strlen($lname) > 40){
    echo "your last name must have maxsimum 40 characters";
}else if(empty($nb)){
    echo "please enter your mobile number";
}else if(strlen($nb) != 10){
    echo "your mobile number must have 10 numbers";
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$nb)){
    echo "invalid mobile number";
}else if(empty($email)){
    echo "please enter your email";
}else if(strlen($email) > 100){
    echo "your email must have maxsimum 100 characters";
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "invalid email";
}else if(empty($pass)){
    echo "please enter password";
}else if(strlen($pass) < 8 || strlen($pass) > 16){
    echo "password must be containe 8 to 16 characters";
}else {

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' OR `mobile_nb`='".$nb."'");
    $num = $rs->num_rows;

    if($num > 0){
        echo "user has already exsists";
    }else{

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $user_type = 2;
        $status = 1;

        Database::iud("INSERT INTO `users`
        (`fname`, `lname`, `email`, `mobile_nb`, `password`, `reg_date`, `gender_gender_id`, `status_status_id`, `user_type_id`) VALUES
         ('".$fname."', '".$lname."', '".$email."', '".$nb."', '".$pass."', '".$date."', '".$gender." ', '$status', '$user_type')");

        echo "success";    

    }

}

?>