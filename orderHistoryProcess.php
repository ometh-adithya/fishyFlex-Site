<?php

include "connection.php";
session_start();
$userId = $_SESSION["user"]["id"];

$errors = [];

if (isset($_POST["payment"]) && isset($_SESSION["user"])) {

    $payment = json_encode($_POST["payment"], true);

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `order_history`(`order_id`, `order_date`, `amount`, `users_id`) 
    VALUES('" . $payment["order_id"] . "', '$date', '" . $payment["amount"] . "', '$userId')");

    $ohid = Database::$connection->insert_id;

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_id`='$userId'");
    $cart_num = $cart_rs->num_rows;

    for ($i = 0; $i < $cart_num; $i++) {
        $cart_data = $cart_rs->fetch_assoc();

        $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='" . $cart_data["product_product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();

        if ($product_data["qty"] >= $product_data["qty"]) {
            Database::iud("INSERT INTO `order_items`(`qty`, `price`, `order_history_oh_id`, `product_product_id`) 
        VALUES('".$cart_data["qty"]."', '".$product_data["price"] ."', '$ohid', '".$product_data["product_id"] ."')");

            $newQty = $product_data["qty"] - $product_data["qty"];
            Database::iud("UPDATE `product` SET `qty`='$newQty' WHERE `product_id`='".$product_data["product_id"] ."'");

        } else {
            $errors[0] = "invalid quantity";
        }
    }

    Database::iud("DELETE FROM `cart` WHERE `users_id`='$userId'");

}else{
    $errors[0] = "invalid request";
}

$json = [];

if(empty($errors)){
    $json["status"] = "success";
    $json["ohId"] = $ohid;
}else{
    $json["status"] = "error";
    $json["error"] = $errors[0];
}

echo json_encode($json);
