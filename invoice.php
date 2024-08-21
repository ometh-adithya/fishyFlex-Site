<?php include "connection.php";
session_start();

if (!isset($_SESSION["user"]) || !isset($_GET["oid"])) {
    echo "plese signin first";
}

$user = $_SESSION["user"];
$oid = $_GET["oid"];

$order_rs = Database::search("SELECT * FROM `order_history` WHERE `order_id`= '$oid'");
$order_num = $order_rs->num_rows;

if ($order_num < 1) {
    header("Location : index.php");
}

$order_data = $order_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - Invoice</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <?php include "adminheader.php"; ?>

    <!-- Invoice body -->
    <section class="py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-8 col-xxl-7 border border-2 shadow shadow-lg bg-dark" id="page">
                    <div class="row gy-3 mb-3">
                        <div class="col-6">
                            <h2 class="text-uppercase text-endx m-0">Invoice</h2>
                        </div>
                        <div class="col-6">
                            <a class="d-block text-end" href="#!">
                                <a class="justify-content-end text-decoration-none" width="135" height="44">FishyFlex</a>
                            </a>
                        </div>
                        <hr>
                        <div class="col-12">
                            <h4>From</h4>
                            <address>
                                <strong>FishyFlex</strong><br>
                                No 1/Main Road/Kandy<br>
                                Phone: 0701410874<br>
                                Email: omeathadithya236@gmail.com
                            </address>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 col-md-8">
                            <h4>Bill To</h4>
                            <?php
                            $id = $_SESSION["user"]["id"];
                            $addres_rs = Database::search("SELECT * FROM `user_addres` WHERE `users_id`='$id'");
                            $addres_data = $addres_rs->fetch_assoc();
                            ?>
                            <div>
                                <strong><?php echo $user["fname"] . "" . $user["lname"]; ?></strong><br>
                                addressline 1: <?php echo $addres_data["line_1"]; ?><br>
                                addressline 2:<?php echo $addres_data["line_2"]; ?><br>
                                Sri lanka<br>
                                Mobile: <?php echo $user["mobile_nb"]; ?><br>
                                Email: <?php echo $user["email"]; ?>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <h4 class="row">
                                <span class="col-6">Invoice #</span>
                                <span class="col-6 text-sm-end">INT-</span>
                            </h4>
                            <div class="row">
                                <span class="col-6">Account</span>
                                <span class="col-6 ">1</span>
                                <span class="col-6">Order ID</span>
                                <span class="col-6 "><?php echo $order_data["order_id"]; ?></span>
                                <span class="col-6">Invoice Date</span>
                                <span class="col-6 "><?php echo $order_data["order_date"]; ?></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase">#id</th>
                                            <th scope="col" class="text-uppercase">Qty</th>
                                            <th scope="col" class="text-uppercase">Product</th>
                                            <th scope="col" class="text-uppercase text-end">Unit Price</th>
                                            <th scope="col" class="text-uppercase text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <?php
                                        $oi_rs = Database::search("SELECT * FROM `order_history` INNER JOIN `order_items` ON order_history.oh_id=order_items.order_history_oh_id WHERE `order_id` = '$oid'");
                                        $oi_num = $oi_rs->num_rows;

                                        while ($oi_data = $oi_rs->fetch_assoc()) {
                                            $oh_id = $oi_data["product_product_id"];

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$oh_id'");
                                            $product_data = $product_rs->fetch_assoc();
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $oi_data["oi_id"]; ?></th>
                                                <th scope="row"><?php echo $oi_data["qty"]; ?></th>
                                                <td><?php echo $product_data["pro_name"]; ?></td>
                                                <td class="text-end">Rs.<?php echo $product_data["price"]; ?>.00</td>
                                                <?php
                                                $amount = $oi_data["qty"] * $product_data["price"];
                                                ?>
                                                <td class="text-end">Rs.<?php echo $amount ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">Subtotal</td>
                                                <td class="text-end">Rs.<?php echo $oi_data["qty"] * $product_data["price"]; ?>.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end">Shipping</td>
                                                <td class="text-end">Rs.300.00</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" colspan="3" class="text-uppercase text-end">Total</th>
                                                <td class="text-end">Rs.<?php echo $oi_data["qty"] * $product_data["price"] + 300; ?>.00</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary mb-3">Download Invoice</button>
                            <button type="submit" class="btn btn-danger mb-3" onclick="printArea();">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>

</body>

</html>