<?php include "connection.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - addProduct</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <!-- header -->
    <?php include "adminHeader.php"; ?>
    <!-- header -->

    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5">
        <div class="row border rounded-5 p-3 bg-transparent shadow">
            <div class="col-12 ">
                <div class="row align-items-center">
                    <div class="header-text mb-4 ">
                        <p>Welcome</p>
                        <p>Add your product</p>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select bg-transparent text-info" id="categories">
                            <option value="0">categories</option>
                            <?php

                            $categories_rs = Database::search("SELECT * FROM `categories`");
                            $categories_num = $categories_rs->num_rows;

                            for ($i = 0; $i < $categories_num; $i++) {
                                $categories_data = $categories_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $categories_data["cat_id"]; ?> " style="background-color: #ff1a75;"><?php echo $categories_data["cat_name"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <select class="form-select bg-transparent text-info" id="fs">
                                <option value="0">fish size</option>
                                <?php

                                $size_rs = Database::search("SELECT * FROM `fish_size`");
                                $size_num = $size_rs->num_rows;

                                for ($i = 0; $i < $size_num; $i++) {
                                    $size_data = $size_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $size_data["fs_id"]; ?> " style="background-color: #ff1a75;"><?php echo $size_data["fish_size"]; ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select bg-transparent text-info" id="tankvaritey">
                            <option value="0">tank varitey</option>
                            <?php

                            $tv_rs = Database::search("SELECT * FROM `tank_varitey`");
                            $tv_num = $tv_rs->num_rows;

                            for ($i = 0; $i < $tv_num; $i++) {
                                $tv_data = $tv_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $tv_data["tv_id"]; ?>" style="background-color: #ff1a75;"><?php echo $tv_data["tank_varitey"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select bg-transparent text-info" id="certificate">
                            <option value="0">certificate</option>
                            <?php

                            $certificate_rs = Database::search("SELECT * FROM `certificate`");
                            $certificate_num = $certificate_rs->num_rows;

                            for ($i = 0; $i < $certificate_num; $i++) {
                                $certificate_data = $certificate_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $certificate_data["certificate_id"]; ?>" style="background-color: #ff1a75;"><?php echo $certificate_data["certificate"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select bg-transparent text-info" id="condition">
                            <option value="0">condition</option>
                            <?php

                            $condition_rs = Database::search("SELECT * FROM `condition`");
                            $condition_num = $condition_rs->num_rows;

                            for ($i = 0; $i < $condition_num; $i++) {
                                $condition_data = $condition_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $condition_data["con_id"]; ?>" style="background-color: #ff1a75;"><?php echo $condition_data["condition"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select bg-transparent text-info" id="ts">
                            <option value="0">tanksize</option>
                            <?php

                            $tank_size_rs = Database::search("SELECT * FROM `tank_size`");
                            $tank_size_num = $tank_size_rs->num_rows;

                            for ($i = 0; $i < $tank_size_num; $i++) {
                                $tank_size_data = $tank_size_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $tank_size_data["tz_id"]; ?>" style="background-color: #ff1a75;"><?php echo $tank_size_data["tank_size"]; ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="product name" id="proname">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light text-info fs-6" placeholder="description" id="desc">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light text-info fs-6" placeholder="price" id="price">
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control form-control-lg bg-light text-info fs-6" placeholder="qty" id="qty">
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control form-control-lg bg-light text-info fs-6" id="profileimage" />
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6" onclick="addProduct();">Add Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>

</body>

</html>