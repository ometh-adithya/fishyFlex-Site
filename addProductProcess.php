<?php

include "connection.php";
session_start();

$categories = $_POST["categories"];
$tankvaritey = $_POST["tankvaritey"];
$certificate = $_POST["certificate"];
$proname = $_POST["proname"];
$desc = $_POST["desc"];
$qty = $_POST["qty"];
$price = $_POST["price"];
$condition = $_POST["condition"];
$ts = $_POST["ts"];
$fs = $_POST["fs"];

if (isset($_SESSION["admin"])) {

    if (empty($categories)) {
        echo "Please add category";
    } else if (empty($tankvaritey)) {
        echo "please add tank varitey";
    } else if (empty($certificate)) {
        echo "please add certificate";
    } else if (empty($proname)) {
        echo "please add product name";
    } else if (empty($desc)) {
        echo "please add description";
    } else if (empty($qty)) {
        echo "please add quantity";
    } else if (empty($condition)) {
        echo "please add condition";
    } else if (empty($ts)) {
        echo "please add tank size";
    } else if (empty($fs)) {
        echo "please add fish size";
    } else {

        $u_id = $_SESSION["admin"]["id"];

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

                $imgPath = "assets/profile/" . $categories . "_" . uniqid() . $new_img_extension;
                move_uploaded_file($image["tmp_name"], $imgPath);
            }

            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format("Y-m-d H:i:s");

            $status = 1;

            if ($categories == 1) {
                Database::iud("INSERT INTO `product`(`pro_name`, `description`, `price`, `qty`, `pro_img`, `datetime_added`, `status_status_id`, `categories_cat_id`, `condition_con_id`, `certificate_certificate_id`, `fish_size_fs_id` ) 
            VALUES ('$proname', ' $desc', '$price', '$qty', '$imgPath', '$date', '$status', '$categories', '$condition', '$certificate', '$fs' )");
            } else if ($categories == 2) {
                Database::iud("INSERT INTO `product`(`pro_name`, `description`, `price`, `qty`, `pro_img`, `datetime_added`, `status_status_id`, `categories_cat_id`, `condition_con_id`, `certificate_certificate_id`, `tank_varitey_tv_id`, `tank_size_tz_id`) 
            VALUES ('$proname', ' $desc', '$price', '$qty', '$imgPath', '$date',  '$status', '$categories', '$condition', '$certificate', '$tankvaritey', '$ts' )");
            } else if ($categories == 3) {
                Database::iud("INSERT INTO `product`(`pro_name`, `description`, `price`, `qty`, `pro_img`, `datetime_added`, `status_status_id`, `categories_cat_id`, `condition_con_id`, `certificate_certificate_id`) 
            VALUES ('$proname', ' $desc', '$price', '$qty', '$imgPath', '$date', '$status', '$categories', '$condition', '$certificate')");
            } else if ($categories == 4) {
                Database::iud("INSERT INTO `product`(`pro_name`, `description`, `price`, `qty`, `pro_img`, `datetime_added`, `status_status_id`, `categories_cat_id`, `condition_con_id`, `certificate_certificate_id`) 
            VALUES ('$proname', ' $desc', '$price', '$qty', '$imgPath', '$date', '$status', '$categories', '$condition', '$certificate')");
            } else {
                echo "invalid category";
            }

            echo ("success");
        } else {
            echo "user not found";
        }
    }
} else {
    header("Location: signin.php");
}
