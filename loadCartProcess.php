<?php

include "connection.php";
session_start();

if (isset($_SESSION["user"])) {

    $user_id = $_SESSION["user"]["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_id`='$user_id'");
    $cart_num = $cart_rs->num_rows;
}

?>
<div class="table-responsive">
    <table class="table table-dark ">
        <thead>
            <tr>
                <th scope="col">Products</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Handle</th>
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
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                        </div>
                    </th>
                    <td>
                        <p class="mb-0 mt-4"><?php echo $product_data["pro_name"]; ?></p>
                    </td>
                    <td>
                        <p class="mb-0 mt-4">Rs.<?php echo $product_data["price"]; ?> .00
                        <p>
                    </td>
                    <td>
                        <div class="input-group quantity mt-4" style="width: 100px;">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-minus rounded-circle bg-light border" onclick="minusQty('<?php echo $cart_data['cartid']; ?>');">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input id="qty-<?php echo $cart_data['cartid']; ?>" type="text" class="form-control form-control-sm text-center rounded-pill border-0" value="<?php echo $cart_data["qty"]; ?>">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-plus rounded-circle bg-light border" onclick="addQty('<?php echo $cart_data['cartid']; ?>');">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php
                        $netTotal += $product_data["price"] * $cart_data["qty"];
                        ?>
                        <p class="mb-0 mt-4">Rs.<?php echo $product_data["price"] * $cart_data["qty"]; ?>.00</p>
                    </td>
                    <td>
                        <button class="btn btn-md rounded-circle bg-light border mt-4" onclick="removeFromCart('<?php echo $cart_data['cartid']; ?>');">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                    </td>


                </tr>
            <?php
            }

            ?>
        </tbody>
    </table>
</div>
<div class="row g-4 justify-content-end right">
    <div class="col-8"></div>
    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
        <div class="bg-info rounded border border-info border-5">
            <div class="p-4">
                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                <div class="d-flex justify-content-between mb-4">
                    <h5 class="mb-0 me-4">Subtotal:</h5>
                    <p class="mb-0">Rs.<?php echo $netTotal; ?>.00</p>
                </div>
            </div>
            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                <h5 class="mb-0 ps-4 me-4">Total</h5>
                <p class="mb-0 pe-4">Rs.<?php echo $netTotal; ?>.00</p>
            </div>
            <button class="btn btn-danger border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" onclick="checkout();">Proceed Checkout</button>
        </div>
    </div>
</div>