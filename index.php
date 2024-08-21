<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - home</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <!-- navbar -->
    <?php echo include "header.php"; ?>
    <!-- navbar -->

    <!-- img -->
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="image-container">
                    <img src="assets/main/img1.jpg" class="img-fluid bg-img1 bottom" alt="Image">
                    <div class="overlay-text">
                        <h1 class="top">Welcome to FishyFlex Aquarium, a leading breeder and exporter of freshwater fish, marine fish, and aquatic plants in Sri Lanka.</h1>
                        <p class="py-5 text-uppercase right">Take a journey of discovery through the Sri Lankan largest online fish market</p>
                        <a href="shop.php" class="btn btn-danger rounded-pill col-6 left">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- img -->

    <hr>

    <!-- carsoul -->
    <div class="container mt-lg-5 mt-5 ">
        <div class="row">
            <!-- search -->
            <div class="col-lg-6 col-12 ">
                <h4 class="mb-3 text-secondary top">Best Quality Fiss</h4>
                <h1 class="mb-5 display-3 text-primary left">Exoctic fish & Aquarium Equipments</h1>
            </div>
            <!-- search -->
            <div class="col-12 col-lg-6 mt-5 mt-lg-5 right">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="assets/main/img1.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/products/albino loach.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="assets/products/oscar.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- carsoul -->

    <hr>

    <!-- card -->
    <div class="container-fluid fruite py-5 mt-3">
        <div class="container py-5">
            <div class="tab-class text-center">
                <div class="row g-4">
                    <div class="col-lg-4 text-start left">
                        <h1>Our Products</h1>
                        <a href="shop.php" class="btn btn-primary rounded-5 mt-2 mb-2"><i class="fa-solid fa-arrow-right"> Shop Now</i></a>
                    </div>
                    <div class="col-lg-8 text-end">
                        <ul class="nav nav-pills d-inline-flex text-center mb-5 right">
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                    <span style="width: 130px;">All Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex py-2 m-2 rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                    <span style="width: 130px;">Tropical fish</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                    <span style="width: 130px;">Fish tanks</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                    <span style="width: 130px;">Aquarium plants</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="d-flex m-2 py-2 rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                    <span style="width: 130px;">Aquarium equipments</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content bottom">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id ");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>

                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="singleProductView.php?product=<?php echo $product_data["product_id"]; ?>&category=<?php echo $product_data["categories_cat_id"]; ?>" class="link-light">
                                                    <div class="fruite-img">
                                                        <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $product_data["cat_name"]; ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $product_data["pro_name"]; ?></h4>
                                                        <p><?php echo $product_data["description"]; ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $product_data["price"]; ?>.00</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `categories_cat_id`='1'");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>

                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="singleProductView.php?product=<?php echo $product_data["product_id"]; ?>&category=<?php echo $product_data["categories_cat_id"]; ?>" class="link-light">
                                                    <div class="fruite-img">
                                                        <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $product_data["cat_name"]; ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $product_data["pro_name"]; ?></h4>
                                                        <p><?php echo $product_data["description"]; ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $product_data["price"]; ?>.00</p>

                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-lg-12">
                                <div class="row g-4">
                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `categories_cat_id`='2'");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>

                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative fruite-item">
                                                <a href="singleProductView.php?product=<?php echo $product_data["product_id"]; ?>&category=<?php echo $product_data["categories_cat_id"]; ?>" class="link-light">
                                                    <div class="<?php echo $product_data["pro_img"]; ?>">
                                                        <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $product_data["cat_name"]; ?></div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4><?php echo $product_data["pro_name"]; ?></h4>
                                                        <p><?php echo $product_data["description"]; ?></p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $product_data["price"]; ?>.00</p>

                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane fade show p-0">
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="rounded position-relative fruite-item">
                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `categories_cat_id`='3'");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();
                                    ?>


                                        <a href="singleProductView.php?product=<?php echo $product_data["product_id"]; ?>&category=<?php echo $product_data["categories_cat_id"]; ?>" class="link-light">
                                            <div class="fruite-img">
                                                <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $product_data["cat_name"]; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $product_data["pro_name"]; ?></h4>
                                                <p><?php echo $product_data["description"]; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $product_data["price"]; ?>.00</p>

                                                </div>
                                            </div>
                                        </a>
                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-5" class="tab-pane fade show p-0">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="rounded position-relative fruite-item">
                            <?php
                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `categories_cat_id`='4'");
                            $product_num = $product_rs->num_rows;
                            for ($i = 0; $i < $product_num; $i++) {
                                $product_data = $product_rs->fetch_assoc();
                            ?>
                                <a href="singleProductView.php?product=<?php echo $product_data["product_id"]; ?>&category=<?php echo $product_data["categories_cat_id"]; ?>" class="link-light">
                                    <div class="fruite-img">
                                        <img src="<?php echo $product_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                                    </div>
                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $product_data["cat_name"]; ?></div>
                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                        <h4><?php echo $product_data["pro_name"]; ?></h4>
                                        <p><?php echo $product_data["description"]; ?></p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $product_data["price"]; ?>.00</p>

                                        </div>
                                    </div>
                                </a>

                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card -->
        </div>
    </div>

    <hr>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/scrollreveal"></script>

</body>

</html>