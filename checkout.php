<?php

include "connection.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
} else {

    $user_id = $_SESSION["user"]["id"];
    $user_rs = Database::search("SELECT * FROM `users` WHERE `id`='$user_id'");

    if ($user_rs->num_rows < 1) {
        echo "user not found";
    }

    $user_data = $user_rs->fetch_assoc();;

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_id`='$user_id'");
    $cart_num = $cart_rs->num_rows;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FishyFlex - checkout</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    </head>

    <body>

        <!-- header -->
        <?php include "header.php"; ?>
        <!-- header -->

        <!-- checkout -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4 text-center mb-5">Billing details</h1>
                <form action="#">
                    <div class="row g-5">
                        <div class="col-md-12 col-lg-6 col-xl-7">
                            <div class="row">
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">First name</label>
                                        <input type="text" class="form-control" value="<?php echo $user_data["fname"]; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-6">
                                    <div class="form-item w-100">
                                        <label class="form-label my-3">Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo $user_data["fname"]; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Mobile Number</label>
                                <input type="number" class="form-control" value="<?php echo $user_data["mobile_nb"]; ?>" disabled>
                            </div>
                            <?php

                            $userAddres_rs = Database::search("SELECT * FROM `user_addres` INNER JOIN `distric` ON 
                            user_addres.distric_distric_id=distric.distric_id INNER JOIN `province` ON 
                            distric.province_province_id=province.province_id WHERE `users_id`='$user_id'");

                            $line1 = "";
                            $line2 = "";
                            $pcode = "";
                            $city = "";
                            $province = "";
                            $distric = "";

                            if ($userAddres_rs->num_rows > 0) {
                                $userAddres_data = $userAddres_rs->fetch_assoc();

                                $line1 = $userAddres_data["line_1"];
                                $line2 = $userAddres_data["line_2"];
                                $pcode = $userAddres_data["postalcode"];
                                $city = $userAddres_data["city"];
                                $province = $userAddres_data["province_name"];
                                $distric = $userAddres_data["distric_name"];
                            }

                            ?>
                            <div class="form-item">
                                <label class="form-label my-3">Address</label>
                                <input type="text" class="form-control" placeholder="House Number Street Name" value="<?php echo ($line1); ?>" disabled>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Town/City</label>
                                <input type="text" class="form-control" value="<?php echo ($city); ?>" disabled>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Postcode/Zip</label>
                                <input type="text" class="form-control" value="<?php echo ($pcode); ?>" disabled>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Email Address</label>
                                <input type="email" class="form-control" value="<?php echo $user_data["email"]; ?>" disabled>
                            </div>
                            <div class=" my-3">
                                <label class="form-check-label">Change addrese details? <a href="userProfile.php">Click here</a></label>
                            </div>
                            <hr>
                            <div class="form-item">
                                <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-5">
                            <div class="table-responsive">
                                <table class="table table-dark border border-info">
                                    <thead>
                                        <tr>
                                            <th scope="col">Products</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $netTotal = 0;

                                        for ($i = 0; $i < $cart_num; $i++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            $productId = $cart_data["product_product_id"];

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$productId'");
                                            $product_num = $product_rs->num_rows;
                                            $product_data = $product_rs->fetch_assoc();

                                        ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="d-flex align-items-center mt-2">
                                                        <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                                    </div>
                                                </th>
                                                <td class="py-5"><?php echo $product_data["pro_name"]; ?></td>
                                                <td class="py-5">Rs.<?php echo $product_data["price"]; ?> .00</td>
                                                <td class="py-5"><?php echo $cart_data["qty"]; ?></td>
                                                <?php
                                                $netTotal += $product_data["price"] * $cart_data["qty"];
                                                ?>
                                                <td class="py-5">Rs.<?php echo $product_data["price"] * $cart_data["qty"]; ?>.00</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5"></td>
                                            <td class="py-5"></td>
                                            <td class="py-5">
                                                <p class="mb-0 py-3">Subtotal</p>
                                            </td>
                                            <td class="py-5">
                                                <div class="py-3 border-bottom border-top">
                                                    <p class="mb-0">Rs.<?php echo $netTotal; ?>.00</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                            </th>
                                            <td class="py-5">
                                                <p class="mb-0 py-4">Shipping</p>
                                            </td>
                                            <td colspan="3" class="py-5">
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="shiping">
                                                    <label class="form-check-label">Ship to colombo</label>
                                                </div>
                                                <div class="form-check text-start">
                                                    <input type="checkbox" class="form-check-input bg-primary border-0" id="shiping2">
                                                    <label class="form-check-label">Ship to out of colombo</label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                                <button class="btn btn-info border-secondary py-3 px-4 text-uppercase w-100 rounded-pill" onclick="checkout();">Place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- checkout -->

        <!-- footer -->
        <?php include "footer.php"; ?>
        <!-- footer -->


        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>

    </body>

    </html>

<?php
}
?>