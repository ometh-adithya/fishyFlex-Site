<?php

include "connection.php";

session_start();

if (isset($_SESSION["user"])) {

    $oid = $_POST["o"];
    $id = $_POST["i"];
    $uid = $_POST["u"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];

    $rs = database::search("SELECT * FROM `product` WHERE `product_id`='" . $id . "'");
    $data = $rs->fetch_assoc();

    $stock_id = $data["product_id"];

    $current_qty = $data["qty"];
    $new_qty = $current_qty - $qty;

    
    database::iud("UPDATE `product` SET `qty`='$new_qty' WHERE `product_id`='$id'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d");

    $order_history_id;

    database::iud("INSERT INTO `order_history`(`order_id`, `order_date`, `amount`, `users_id`) VALUES
    ('$oid','$date','$amount','$uid')");

    //get order history table PK
    $order_history_id = database::$connection->insert_id;

    database::iud("INSERT INTO `order_items`(`qty`, `price`, `order_history_oh_id`, `product_product_id`) 
    VALUES ('$qty','$amount','$order_history_id','$stock_id')");

    echo ("success");
}
