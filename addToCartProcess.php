<?php

include "connection.php";
session_start();

if (!isset($_SESSION["user"])) {
    echo "Please signin first";
    exit();
}

$user = $_SESSION["user"]["id"];

$pid = $_GET["product"];
$qty = $_GET["qty"];

if(empty($pid)){
    echo "Invalid Product";
}else if(empty($qty)){
    echo "Please add quantity";
}else if($qty < 1){
    echo "Invalid quantity";
}else {

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$pid'");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_id`='$user' AND `product_product_id`='$pid'; ");
    $cart_num = $cart_rs->num_rows;

    if($cart_num > 0){
        $cart_data = $cart_rs->fetch_assoc();
        $cart_id = $cart_data["cartid"];

        $newQty = $cart_data["qty"] + $qty;
        if($product_num["qty"] >= $newQty){
            Database::iud("UPDATE `cart` SET `qty`='$newQty' WHERE `cartid`='$cart_id'");
            echo "successfully updated";
        }else{
            echo "invalid quantity";
        }

    }else{

        if($product_data["qty"] >= $qty){
            Database::iud("INSERT INTO `cart`(`qty`, `product_product_id`, `users_id`) VALUES ('$qty', '$pid', '$user')");
            echo "successfully added";
        }else{
            echo "invalid quantity";
        }

    }

}

?>
