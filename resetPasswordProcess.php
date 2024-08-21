<?php

include "connection.php";

$newpw = $_POST["n"];
$vcode = $_POST["v"];

    $rs = Database::search("SELECT * FROM `users` WHERE `verification_code`='$vcode' ");
    $num = $rs->num_rows;

    if($num == 1){

        Database::iud("UPDATE `users` SET `password`='$newpw' WHERE `verification_code`='$vcode'");
        echo ("success");

    }else{
        echo ("Invalid Verification Code..");
    }

?>