<?php

include "connection.php";

$cartId = $_GET["cartId"];

if(empty($cartId)){
    echo "invalid request";
}else{

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cartid`='$cartId'");
    $cart_num = $cart_rs->num_rows;

    if($cart_num > 0){
        Database::iud("DELETE FROM `cart` WHERE `cartid`='$cartId'");
    }else{
        echo "Cart item note available";
    }

    echo "success";

}

?>