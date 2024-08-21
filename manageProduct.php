<?php include "connection.php";
session_start();

$admin = $_SESSION["admin"]["id"];

if (isset($admin)) {
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FishyFlex - manageProduct</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    </head>
</head>

<body>
    <?php include "adminHeader.php"; ?>

    <div class="container-fluid">
        <div class="row col-12 justify-content-center py-5">
            <h1 class="fw-bold text-info">Manage Product</h1>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body pb-0">
                            <h5 class="card-title">Manage Products</h5>
                            <hr>
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Product id</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Manage</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product`");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>
                                        <tr>
                                            <th scope="row"><a href="#"><img style="min-width: 96px; height: 96px;" class="img-fluid img-thumbnail" src="<?php echo $product_data["pro_img"]?>" alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold"><?php echo $product_data["pro_name"]; ?></a></td>
                                            <td>Rs.<?php echo $product_data["price"]; ?>.00</td>
                                            <td class="fw-bold"><option value="<?php echo $product_data["product_id"]; ?>" id="pId"><?php echo $product_data["product_id"]; ?></option></td>
                                            <?php
                                            $sId = $product_data["status_status_id"];
                                            $srs = Database::search("SELECT * FROM `status` WHERE `status_id`='$sId'");
                                            $snum = $srs->num_rows;
                                            $sdata = $srs->fetch_assoc();
                                            ?>
                                            <td class="fw-bold btn btn-info rounded-pill" id="status"><?php echo $sdata["status_name"]; ?></td>
                                            <td><a onclick="manageProduct('<?php echo $product_data['product_id']; ?>');" class="btn btn-info rounded-pill">Manage</a></td>
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
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>

<?php
}
?>