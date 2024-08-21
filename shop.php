<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - Shop</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <!-- navbar -->
    <?php echo include "header.php"; ?>
    <!-- navbar -->

    <!-- banner -->
    <div class="container-fluid py-5 mt-5">
        <div class="row">
            <img src="assets/main/banner2.png" alt="banner" style="width: 100%;">
            <h1 class="text-center display-6">Shop <span>You can buy your lovelies</span></h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
    <!-- banner -->

    <!-- shop start -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4">FishyFlex shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <!-- search -->
                        <div class="col-xl-3">
                            <form method="GET" action="catResultProcess.php" class="input-group w-100 mx-auto d-flex ">
                                <input name="search" class=" form-control p-3 border-2 border-secondary" placeholder="Search">
                                <button type="submit" class="input-group-text p-3 btn btn-primary border-2 border-secondary">search</button>
                            </form>
                        </div>
                        <!-- search -->
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12 right">
                                        <div class="mb-3">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">

                                                <?php

                                                $cat_rs = Database::search("SELECT * FROM `categories` ");
                                                $cat_num = $cat_rs->num_rows;

                                                for ($i = 0; $i < $cat_num; $i++) {
                                                    $cat_data = $cat_rs->fetch_assoc();
                                                ?>

                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="catResultProcess.php?category=<?php echo $cat_data["cat_id"]; ?>"><i class="fa-solid fa-cart-shopping"></i> <?php echo $cat_data["cat_name"]; ?></a>
                                                        </div>
                                                    </li>

                                                <?php
                                                }

                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 left">
                                <div class="row g-4 justify-content-center">
                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id");
                                    $product_num = $product_rs->num_rows;

                                    for ($i = 0; $i < $product_num; $i++) {
                                        $product_data = $product_rs->fetch_assoc();

                                    ?>

                                        <div class="col-md-6 col-lg-6 col-xl-4">
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
                                                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
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
                </div>
            </div>
        </div>
    </div>
    <!--Shop End-->



    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>