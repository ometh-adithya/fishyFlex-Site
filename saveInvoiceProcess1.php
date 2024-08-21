<?php
include "connection.php";
session_start();

if (isset($_SESSION["user"])) {

    $oid = $_POST["o"];
    $amount = $_POST["a"];
    $uid = $_POST["u"];

    $cart_rs = database::search("SELECT * FROM `cart` WHERE `users_id`='" . $uid . "'");
    $cart_num = $cart_rs->num_rows;
    $invoice_id;

    $address_rs = Database::search("SELECT * FROM `user_addres` WHERE `users_id`='" . $uid . "'");
    $address_data = $address_rs->fetch_assoc();

    $city_id = $address_data["distric_distric_id"];

    $line1 = $address_data["line_1"];
    $line2 = $address_data["line_2"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d ");

    Database::iud("INSERT INTO `order_history`(`order_id`, `order_date`, `amount`, `users_id`) VALUES
    ('$oid','$date','$amount','$uid')");
    $invoice_id = database::$connection->insert_id;

    Database::iud("INSERT INTO `order_addres`(`line_1`, `line_2`, `order_history_oh_id` ) 
    VALUES ('" . $line1 . "','" . $line2 . "','" . $invoice_id . "')");

    $delivery = 500;

    for ($x = 0; $x < $cart_num; $x++) {
        $cart_data = $cart_rs->fetch_assoc();
        $cart_qty = $cart_data["qty"];

        $product_rs = database::search("SELECT * FROM `product` WHERE `product_id`='" . $cart_data["product_product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();
        $unitPrice = $product_data["price"];

        $total = ((int)$unitPrice * (int)$cart_qty) + $delivery;

        $product_qty = $product_data["qty"];
        $new_qty = $product_qty - $cart_qty;


        database::iud("UPDATE `product` SET `qty`='" . $new_qty . "' WHERE `product_id`='" . $cart_data["product_product_id"] . "'");

        Database::iud("INSERT INTO `order_items`( `qty`, `price`, `product_product_id`, `order_history_oh_id`) 
        VALUES ('" . $cart_qty . "','" . $total . "','" .  $cart_data["product_product_id"] . "', '" . $invoice_id . "')");

        $cartid = $cart_data["cartid"];

        Database::iud("DELETE FROM `cart` WHERE `cartid`='$cartid'");
    }

    echo "success";
} else {
    echo ("Please Sign In First.");
}
