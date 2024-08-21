<?php
include "connection.php";
session_start();

if (isset($_SESSION["user"])) {

    $id = $_GET["id"];
    $qty = $_GET["q"];

    $uid = $_SESSION["user"]["id"];

    $array;
    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$id'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `user_addres` WHERE `users_id`='$uid' ");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {
        $city_data = $city_rs->fetch_assoc();

        $city = $city_data["city"];
        $address = $city_data["line_1"] . "," . $city_data["line_2"];

        $delivery = '';
        $deliveryId = $city_data["distric_distric_id"];
        if($deliveryId > 1){
            $delivery = '300';
        }else{
            $delivery = '200';
        }
      

        $item = $product_data["pro_name"];
        $amount = ((int)$product_data["price"] * (int)$qty + (int)$delivery);

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $mobile = $_SESSION["user"]["mobile_nb"];
        $uaddress = $address;
 

        $merchant_id = "********";
        $merchant_secret = "*********************************";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["address"] = $uaddress;
        $array["umail"] = $uid;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);

    } else {
        echo ("2");
    }
} else {
    echo("1");
}

?>