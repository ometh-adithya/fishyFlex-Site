<?php
include "connection.php";
session_start();

if (isset($_SESSION["user"])) {
    $uid = $_SESSION["user"]["id"];
    $array = [];

    $order_id = uniqid();
    $amount = 0;
    $cart_rs = database::search("SELECT * FROM `cart`");
    $cart_num = $cart_rs->num_rows;

    $city_rs = database::search("SELECT * FROM `user_addres` WHERE `users_id`='" . $uid . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {
        $city_data = $city_rs->fetch_assoc();
        $address = $city_data["line_1"] . "," . $city_data["line_2"];

        for ($x = 0; $x < $cart_num; $x++) {
            $cart_data = $cart_rs->fetch_assoc();
            $cart_product_id = $cart_data["product_product_id"];
            $cart_qty = $cart_data["qty"];


            $product_rs = database::search("SELECT * FROM `product` WHERE `product_id`='" . $cart_product_id . "'");
            $product_data = $product_rs->fetch_assoc();

            $unitPrice = $product_data["price"];

            $total = $unitPrice * $cart_qty ;            
        }     

        $amount = $amount + $total;  

        $fname = $_SESSION["user"]["fname"];
        $lname = $_SESSION["user"]["lname"];
        $mobile = $_SESSION["user"]["mobile_nb"];
        $uaddress = $address;
        $city = $city_data["city"];
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

        // Include payment parameters
        $array["id"] = $order_id;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["city"] = $city;
        $array["uid"] = $uid;
        $array["address"] = $uaddress;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;

        echo json_encode($array);
    } else {
        echo "2";
    }
} else {
    echo "1";
}
