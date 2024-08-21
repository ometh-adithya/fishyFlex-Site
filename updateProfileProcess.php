<?php

include "connection.php";
session_start();

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$number = $_POST["number"];
$line1 = $_POST["line1"];
$line2 = $_POST["line2"];
$pcode = $_POST["pcode"];
$province = $_POST["province"];
$distric = $_POST["distric"];
$city = $_POST["city"];

if (isset($_SESSION["user"])) {

    if (empty($fname)) {
        echo "please enter your first name";
    } else if (strlen($fname) > 40) {
        echo "your first name must have maximum 40 characters";
    } else if (empty($lname)) {
        echo "please enter your last name";
    } else if (strlen($lname) > 40) {
        echo "your last name must have maximum 40 characters";
    } else if (empty($number)) {
        echo "please enter your mobile number";
    } else if (strlen($number) != 10) {
        echo "your mobile number must have 10 numbers";
    } else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $number)) {
        echo "invalid mobile number";
    } else if (empty($line1)) {
        echo "please enter your addres";
    } else if (strlen($line1) > 100) {
        echo "your addres must have maximum 100 characters";
    } else if (strlen($line2) > 100) {
        echo "your addres name must have maximum 100 characters";
    } else if (empty($pcode)) {
        echo "please enter your postalcode";
    } else if (strlen($pcode) > 30) {
        echo "your postalcode must have maximum 30 characters";
    } else if (empty($province)) {
        echo "please enter your province";
    } else if (empty($distric)) {
        echo "please enter your distric";
    } else if (empty($city)) {
        echo "please enter your city";
    } else if (strlen($city) > 50) {
        echo "your city name must have maximum 50 characters";
    } else {

        $u_id = $_SESSION["user"]["id"];

        $u_rs = Database::search("SELECT * FROM `users` WHERE `id`='$u_id'");
        if ($u_rs->num_rows == 1) {

            $u_data = $u_rs->fetch_assoc();

            $image = $_FILES["image"];
            $image_extension = $image["type"];

            $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

            if (in_array($image_extension, $allowed_image_extensions)) {
                $new_img_extension;

                if ($image_extension == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($image_extension == "image/png") {
                    $new_img_extension = ".png";
                } else if ($image_extension == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                $imgPath = "assets/profile/".$fname."_".uniqid().$new_img_extension;
                move_uploaded_file($image["tmp_name"], $imgPath);
            }

            Database::iud("UPDATE `users` SET `profileimg_img`='$imgPath' WHERE `id`='$u_id' ");

            Database::iud("UPDATE `users` SET `fname`='$fname', `lname`='$lname', `mobile_nb`='$number' WHERE 
               `id`='$u_id'");

            $address_rs = Database::search("SELECT * FROM `user_addres` WHERE `users_id`='$u_id'");

            if ($address_rs->num_rows == 1) {

                Database::iud("UPDATE `user_addres` SET `city`='$city', `line_1`='$line1', `line_2`='$line2', `postalcode`='$pcode' WHERE `users_id`='$u_id'");
            } else {

                Database::iud("INSERT INTO `user_addres`(`users_id`, `city`, `line_1`, `line_2`, `postalcode`, `distric_distric_id`) VALUES ('$u_id', ' $city', '$line1', '$line2', '$pcode', '$distric')");
            }

            echo ("success");

        } else {
            echo "user not found";
        }
    }
} else {
    echo "please signin first";
    exit();
}
