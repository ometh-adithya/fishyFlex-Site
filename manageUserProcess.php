<?php

include "connection.php";
session_start();

if(!isset($admin)){
    header("Location: adminsignin.php");
}

$uId = $_GET["uId"];

if(isset($uId)){

    $user_rs = Database::search("SELECT * FROM `users` WHERE `id`='$uId'");
    $user_num = $user_rs->num_rows;

    if($user_num == 1){

        $user_data = $user_rs->fetch_assoc();

        if($user_data["status_status_id"] == 1){
            Database::iud("UPDATE `users` SET `status_status_id`='2' WHERE `id`='$uId'");
        }else{
            Database::iud("UPDATE `users` SET `status_status_id`='1' WHERE `id`='$uId'");
        }

        echo "success";

    }else{
        echo "invalid user";
    }

}else{
    echo "please add user";
}

?>