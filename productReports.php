<?php include "connection.php";
session_start();

$admin = $_SESSION["admin"];

if (isset($admin)) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - productReporsts</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <?php include "adminHeader.php"; ?>

    <div class="container-fluid">
        <div class="row py-5">
            <h1 class="fw-bold text-info">product Reports</h1>
        </div>
        <div class="col-12 mb-5 justify-content-center">
            <button class="btn btn-info rounded-pill me-2" onclick="printArea();"><i class="bi bi-printer-fill"></i> Print</button>
        </div>
        <div class="col-lg-12 justify-content-center">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto d-flex">
                        <div class="card-body pb-0" id="page">
                            <h5 class="card-title">products Reports</h5>
                            <hr>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">Product name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product`");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>
                                        <tr class="py-3">
                                            <th scope="row"><?php echo $product_data["product_id"] ?></th>
                                            <td><a href="#" class="text-primary fw-bold"><?php echo $product_data["pro_name"]; ?></a></td>
                                            <td>Rs.<?php echo $product_data["price"]; ?>.00</td>
                                            <td class="fw-bold"><?php echo $product_data["qty"]; ?></td>
                                            <?php
                                            $sId = $product_data["status_status_id"];
                                            $srs = Database::search("SELECT * FROM `status` WHERE `status_id`='$sId'");
                                            $snum = $srs->num_rows;
                                            $sdata = $srs->fetch_assoc();
                                            ?>
                                            <td class="fw-bold btn btn-info rounded-pill"><?php echo $sdata["status_name"]; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
<?php
}else{
    header("Location: adminsignin.php");
}
?>