<?php

include "connection.php";

$cartId = $_GET["cartId"];
$qty = $_GET["qty"];

if(empty($cartId)){
    echo "invalid request";
}else if($qty < 1){
    echo "invalid quantity";
}else {

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cartid`='$cartId'");
    $cart_num = $cart_rs->num_rows;

    if($cart_num > 0){
        $cart_data = $cart_rs->fetch_assoc();
        $pId = $cart_data["product_product_id"];

        $p_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$pId'");
        $p_data = $p_rs->fetch_assoc();

        if($p_data["qty"] >= $qty){

            Database::iud("UPDATE `cart` SET `qty`='$qty' WHERE `cartid`='$cartId'");
            echo "success";

        }else{
            echo "invalid quantity";
        }

    }else{
        echo "Item note found";
    }

}

?>