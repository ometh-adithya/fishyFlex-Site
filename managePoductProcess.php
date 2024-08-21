<?php

include "connection.php";

$pId = $_GET["pid"];

if(isset($pId)){

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$pId'");
    $product_num = $product_rs->num_rows;

    if($product_num == 1){

        $product_data = $product_rs->fetch_assoc();

        if($product_data["status_status_id"] == 1){
            Database::iud("UPDATE `product` SET `status_status_id`='2' WHERE `product_id`='$pId'");
        }else{
            Database::iud("UPDATE `product` SET `status_status_id`='1' WHERE `product_id`='$pId'");
        }

        echo "success";

    }else{
        echo "invalid product";
    }

}else{
    echo "please add product";
}

?>