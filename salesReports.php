<?php

include "connection.php";
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - salesReporsts</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <?php include "adminHeader.php"; ?>

    <div class="container-fluid">
        <div class="row col-12 justify-content-center py-5">
            <h1 class="fw-bold text-info">Sales so far</h1>
        </div>
        <div class="col-12 mb-5 justify-content-center">
            <button class="btn btn-info rounded-pill me-2" onclick="printArea();"><i class="bi bi-printer-fill"></i> Print</button>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body pb-0" id="page">
                            <h5 class="card-title">Your Sales so far</h5>
                            <hr>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Product id</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $sale_rs = Database::search("SELECT * FROM `order_history` INNER JOIN `order_items` ON order_history.oh_id=order_items.order_history_oh_id");
                                    $sale_num = $sale_rs->num_rows;

                                    for ($i = 0; $i < $sale_num; $i++) {
                                        $sale_data = $sale_rs->fetch_assoc();

                                        $sale_id = $sale_data["product_product_id"];

                                        $produt_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$sale_id' ");
                                        $produt_num = $produt_rs->num_rows;
                                        $produt_data = $produt_rs->fetch_assoc();
                                    ?>
                                        <tr>
                                            <th scope="row"><a href="#"><img style="min-width: 96px; height: 96px;" class="img-fluid img-thumbnail" src="<?php echo $produt_data["pro_img"] ?>" alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold"><?php echo $produt_data["pro_name"]; ?></a></td>
                                            <td>Rs.<?php echo $produt_data["price"]; ?>.00</td>
                                            <td class="fw-bold" id="pId"><?php echo $produt_data["product_id"]; ?></td>
                                            <?php
                                            $sId = $produt_data["status_status_id"];
                                            $srs = Database::search("SELECT * FROM `status` WHERE `status_id`='$sId'");
                                            $snum = $srs->num_rows;
                                            $sdata = $srs->fetch_assoc();
                                            ?>
                                            <td class="fw-bold btn btn-info rounded-pill" id="status"><?php echo $sdata["status_name"]; ?></td>
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