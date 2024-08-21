<?php

include "connection.php";

if (!isset($_GET["product"]) || empty($_GET["product"])) {
    header("Location: index.php");
}

$pid = $_GET["product"];
$cat_id = $_GET["category"];

$product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `product_id`='$pid'");
$product_num = $product_rs->num_rows;

if ($product_num < 1) {
?>
    <script>
        showAlert("Error", "Product Unavalible", "error");
        deley(500);
        window.location = "index.php";
    </script>
<?php
}

$product_data = $product_rs->fetch_assoc();

$condition_rs = Database::search("SELECT * FROM `product` INNER JOIN `condition` ON product.condition_con_id=condition.con_id WHERE `product_id`='$pid'");
$condition_num = $condition_rs->num_rows;
$condition_data = $condition_rs->fetch_assoc();

$certificate_rs = Database::search("SELECT * FROM `product` INNER JOIN `certificate` ON product.certificate_certificate_id=certificate.certificate_id WHERE `product_id`='$pid'");
$certificate_num = $certificate_rs->num_rows;
$certificate_data = $certificate_rs->fetch_assoc();

$tank_varitey_rs = Database::search("SELECT * FROM `product` INNER JOIN `tank_varitey` ON product.tank_varitey_tv_id=tank_varitey.tv_id WHERE `product_id`='$pid'");
$tank_varitey_num = $tank_varitey_rs->num_rows;
$tank_varitey_data = $tank_varitey_rs->fetch_assoc();

$tank_size_rs = Database::search("SELECT * FROM `product` INNER JOIN `tank_size` ON product.tank_size_tz_id=tank_size.tz_id WHERE `product_id`='$pid'");
$tank_size_num = $tank_size_rs->num_rows;
$tank_size_data = $tank_size_rs->fetch_assoc();

$fish_size_rs = Database::search("SELECT * FROM `product` INNER JOIN `fish_size` ON product.fish_size_fs_id=fish_size.fs_id WHERE `product_id`='$pid'");
$fish_size_num = $fish_size_rs->num_rows;
$fish_size_data = $fish_size_rs->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - SingleProductView</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <!-- navbar -->
    <?php echo include "header.php"; ?>
    <!-- navbar -->

    <div class="p-3 text-center border-bottom">
        <div class="container">
            <?php

            if ($cat_id == 1) {

            ?>
                <!-- content -->
                <section class="py-5 border border-3 border-primary rounded-5 d-flex ">
                    <div class="container">
                        <div class="row gx-5">
                            <aside class="col-lg-6 top">
                                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                                    <a class="rounded-4" data-type="image">
                                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $product_data["pro_img"]; ?>" />
                                    </a>
                                </div>
                            </aside>
                            <main class="col-lg-6">
                                <div class="ps-lg-3">
                                    <h4 class="title top">
                                        <?php echo $product_data["pro_name"]; ?>
                                    </h4>
                                    <div class="d-flex flex-row my-3">
                                        <span class="text-success ms-2 left"><?php echo $product_data["qty"]; ?> Product Available</span>
                                    </div>

                                    <div class="mb-3 bottom">
                                        <span class="h5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                        <span class="text-muted">/per box</span>
                                    </div>

                                    <p class="bottom">
                                        <?php echo $product_data["description"]; ?>
                                    </p>

                                    <div class="row right">
                                        <dt class="col-3">Category:</dt>
                                        <dd class="col-9"><?php echo $product_data["cat_name"]; ?></dd>

                                        <dt class="col-3">size:</dt>
                                        <dd class="col-9"><?php echo $fish_size_data["fish_size"]; ?></dd>

                                        <dt class="col-3">Certificate:</dt>
                                        <dd class="col-9"><?php echo $certificate_data["certificate"]; ?></dd>

                                        <dt class="col-3">condition:</dt>
                                        <dd class="col-9"><?php echo $condition_data["condition"]; ?></dd>
                                    </div>

                                    <hr />

                                    <div class="row mb-4">
                                        <!-- col.// -->
                                        <div class="col-md-4 col-6 mb-3 bottom">
                                            <label class="mb-2 d-block">Quantity</label>
                                            <div class="input-group mb-3" style="width: 170px;">
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control text-center border border-secondary" placeholder="14" id="qty" />
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary shadow-0 left" onclick="buynow('<?php echo $pid; ?>');"> Buy now </a>
                                        <button class="btn btn-primary shadow-0 left" onclick="addToCart('<?php echo $product_data['product_id']; ?>');"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </button>
                                </div>
                            </main>
                        </div>
                    </div>
                </section>
                <!-- content -->
            <?php

            } else if ($product_data["categories_cat_id"] == 2) {
            ?>
                <!-- content -->
                <section class="py-5 border border-3 border-primary rounded-5 d-flex ">
                    <div class="container">
                        <div class="row gx-5">
                            <aside class="col-lg-6 top">
                                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                                    <a class="rounded-4" data-type="image">
                                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $product_data["pro_img"]; ?>" />
                                    </a>
                                </div>
                            </aside>
                            <main class="col-lg-6">
                                <div class="ps-lg-3">
                                    <h4 class="title top">
                                        <?php echo $product_data["pro_name"]; ?>
                                    </h4>
                                    <div class="d-flex flex-row my-3">
                                        <span class="text-success ms-2 left"><?php echo $product_data["qty"]; ?> Product Available</span>
                                    </div>

                                    <div class="mb-3 bottom">
                                        <span class="h5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                        <span class="text-muted">/per box</span>
                                    </div>

                                    <p class="bottom">
                                        <?php echo $product_data["description"]; ?>
                                    </p>

                                    <div class="row right">
                                        <dt class="col-3">Tank variety:</dt>
                                        <dd class="col-9"><?php echo $tank_varitey_data["tank_varitey"]; ?></dd>

                                        <dt class="col-3">size:</dt>
                                        <dd class="col-9"><?php echo $tank_size_data["tank_size"]; ?></dd>

                                        <dt class="col-3">Certificate:</dt>
                                        <dd class="col-9"><?php echo $certificate_data["certificate"]; ?></dd>

                                        <dt class="col-3">condition:</dt>
                                        <dd class="col-9"><?php echo $condition_data["condition"]; ?></dd>
                                    </div>

                                    <hr />

                                    <div class="row mb-4">
                                        <!-- col.// -->
                                        <div class="col-md-4 col-6 mb-3 bottom">
                                            <label class="mb-2 d-block">Quantity</label>
                                            <div class="input-group mb-3" style="width: 170px;">
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control text-center border border-secondary" placeholder="14" id="qty" />
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary shadow-0 left" onclick="buynow('<?php echo $pid; ?>');"> Buy now </button>
                                    <button class="btn btn-primary shadow-0 left" onclick="addToCart('<?php echo $product_data['product_id']; ?>');"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </button>
                                </div>
                            </main>
                        </div>
                    </div>
                </section>
                <!-- content -->
            <?php
            } else if ($product_data["categories_cat_id"] == 3) {
            ?>
                <!-- content -->
                <section class="py-5 border border-3 border-primary rounded-5 d-flex ">
                    <div class="container">
                        <div class="row gx-5">
                            <aside class="col-lg-6 top">
                                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                                    <a class="rounded-4" data-type="image">
                                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $product_data["pro_img"]; ?>" />
                                    </a>
                                </div>
                            </aside>
                            <main class="col-lg-6">
                                <div class="ps-lg-3">
                                    <h4 class="title top">
                                        <?php echo $product_data["pro_name"]; ?>
                                    </h4>
                                    <div class="d-flex flex-row my-3">
                                        <span class="text-success ms-2 left"><?php echo $product_data["qty"]; ?> Product Available</span>
                                    </div>

                                    <div class="mb-3 bottom">
                                        <span class="h5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                        <span class="text-muted">/per box</span>
                                    </div>

                                    <p class="bottom">
                                        <?php echo $product_data["description"]; ?>
                                    </p>

                                    <div class="row right">
                                        <dt class="col-3">Certificate:</dt>
                                        <dd class="col-9"><?php echo $certificate_data["certificate"]; ?></dd>

                                        <dt class="col-3">condition:</dt>
                                        <dd class="col-9"><?php echo $condition_data["condition"]; ?></dd>
                                    </div>

                                    <hr />

                                    <div class="row mb-4">
                                        <!-- col.// -->
                                        <div class="col-md-4 col-6 mb-3 bottom">
                                            <label class="mb-2 d-block">Quantity</label>
                                            <div class="input-group mb-3" style="width: 170px;">
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control text-center border border-secondary" placeholder="14" id="qty" />
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary shadow-0 left" onclick="buynow('<?php echo $pid; ?>');" class="btn btn-warning shadow-0 left"> Buy now </button>
                                    <button class="btn btn-primary shadow-0 left" onclick="addToCart('<?php echo $product_data['product_id']; ?>');"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </button>
                                </div>
                            </main>
                        </div>
                    </div>
                </section>
                <!-- content -->
            <?php
            } else if ($product_data["categories_cat_id"] == 4) {
            ?>
                <!-- content -->
                <section class="py-5 border border-3 border-primary rounded-5 d-flex ">
                    <div class="container">
                        <div class="row gx-5">
                            <aside class="col-lg-6 top">
                                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                                    <a class="rounded-4" data-type="image">
                                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?php echo $product_data["pro_img"]; ?>" />
                                    </a>
                                </div>
                            </aside>
                            <main class="col-lg-6">
                                <div class="ps-lg-3">
                                    <h4 class="title top">
                                        <?php echo $product_data["pro_name"]; ?>
                                    </h4>
                                    <div class="d-flex flex-row my-3">
                                        <span class="text-success ms-2 left"><?php echo $product_data["qty"]; ?> Product Available</span>
                                    </div>

                                    <div class="mb-3 bottom">
                                        <span class="h5">Rs.<?php echo $product_data["price"]; ?>.00</span>
                                        <span class="text-muted">/per box</span>
                                    </div>

                                    <p class="bottom">
                                        <?php echo $product_data["description"]; ?>
                                    </p>

                                    <div class="row right">
                                        <dt class="col-3">Certificate:</dt>
                                        <dd class="col-9"><?php echo $certificate_data["certificate"]; ?></dd>

                                        <dt class="col-3">condition:</dt>
                                        <dd class="col-9"><?php echo $condition_data["condition"]; ?></dd>
                                    </div>

                                    <hr />

                                    <div class="row mb-4">
                                        <!-- col.// -->
                                        <div class="col-md-4 col-6 mb-3 bottom">
                                            <label class="mb-2 d-block">Quantity</label>
                                            <div class="input-group mb-3" style="width: 170px;">
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="form-control text-center border border-secondary" placeholder="14" id="qty" />
                                                <button class="btn btn-white border border-secondary px-3" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary shadow-0 left" onclick="buynow('<?php echo $pid; ?>');">Buy now </button>
                                    <button class="btn btn-primary shadow-0 left" onclick="addToCart('<?php echo $product_data['product_id']; ?>');"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </button>
                                </div>
                            </main>
                        </div>
                    </div>
                </section>
                <!-- content -->
            <?php
            } else {
            ?>
                <script>
                    showAlert("Error", "Product Unavalible", "error");
                </script>
            <?php
            }

            ?>
            <section class="border-top py-4 mt-5">
                <div class="container">
                    <div class="row gx-4">
                        <!-- feedback -->
                        <form action="#">
                            <h4 class="mb-5 fw-bold top">Leave a Reply</h4>
                            <div class="row g-4 mb-5 bg-transparent">
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0  me-4 text-bg-info left " placeholder="Your Name " id="name">
                                    </div>
                                </div>
                                <div class="col-lg-6 d-none">
                                    <div class="border-bottom rounded">
                                        <input type="text" class="form-control border-0  me-4 text-bg-info left " placeholder="Product id " id="product" value="<?php echo $pid; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border-bottom rounded">
                                        <input type="email" class="form-control border-0 text-bg-info right" placeholder="Your Email " id="email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded my-4">
                                        <textarea id="feedback" class="form-control border-0 text-bg-info bottom" cols="30" rows="8" placeholder="Your Review *"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class=" justify-align-content-center py-3 mb-5">
                                        <a class="btn fw-bold text-primary rounded-pill px-4 py-3 top" style="background-color: #ff1a75;" onclick="sendFeedback();"> Post Comment</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- feedback -->
                        <div class="col-lg-4">
                            <div class="px-0 ">
                                <div class="card">
                                    <div class="card-body bg-dark border rounded-2 border-primary text-bg-light">
                                        <h5 class="card-title top">Similar items</h5>

                                        <?php
                                        $similer_rs = Database::search("SELECT * FROM `product` WHERE `categories_cat_id`='$cat_id' LIMIT 4 ");
                                        $similer_num = $similer_rs->num_rows;

                                        for ($i = 0; $i < $similer_num; $i++) {
                                            $similer_data = $similer_rs->fetch_assoc();
                                        ?>
                                            <div class="d-flex mb-3">
                                                <a href="singleProductView.php?product=<?php echo  $similer_data["product_id"]; ?>&category=<?php echo  $similer_data["categories_cat_id"]; ?>" class="me-3">
                                                    <img src="<?php echo $similer_data["pro_img"]; ?>" style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                                                </a>
                                                <div class="info">
                                                    <a href="#" class="nav-link mb-1">
                                                        <?php echo $similer_data["pro_name"]; ?>
                                                    </a>
                                                    <strong class="text-bg-warning rounded-pill">Rs.<?php echo $similer_data["price"]; ?>.00</strong>
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
            </section>

            <h1 class="fw-bold mb-0">Comments</h1>
            <div class="">

                <?php
                $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_product_id`='$pid'");
                $feedback_num = $feedback_rs->num_rows;

                for ($i = 0; $i < $feedback_num; $i++) {
                    $feedback_data = $feedback_rs->fetch_assoc();
                ?>
                    <div class="owl-carousel">
                        <div class="border border-primary rounded position-relative mb-3">
                            <div class="p-4 pb-0 rounded-bottom">
                                <h4><?php echo $feedback_data["uname"]; ?></h4>
                                <p><?php echo $feedback_data["feedback"]; ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-white bg-primary px-3 py-1 rounded-pill "><?php echo $feedback_data["uemail"]; ?></p>
                                    <a href="#" class="btn btn-info border border-secondary rounded-pill px-3 py-1 mb-4 text-danger">HELPFULL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>