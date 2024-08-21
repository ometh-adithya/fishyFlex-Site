

<div class="col-lg-9">
    <div class="row g-4 justify-content-center">
        <?php

        include "connection.php";

        $search = $_GET["search"];

        $search_rs = Database::search("SELECT * FROM `product` WHERE `pro_name` LIKE '%$search%' ");
        $search_num = $search_rs->num_rows;

        for ($i = 0; $i < $search_num; $i++) {
            $search_data = $search_rs->fetch_assoc();
        ?>

            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="rounded position-relative fruite-item">
                    <a href="singleProductView.php?product=<?php echo $search_data["product_id"]; ?>&category=<?php echo $search_data["categories_cat_id"]; ?>" class="link-light">
                        <div class="fruite-img">
                            <img src="<?php echo $search_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $search_data["cat_name"]; ?></div>
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4><?php echo $search_data["pro_name"]; ?></h4>
                            <p><?php echo $search_data["description"]; ?></p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $search_data["price"]; ?>.00</p>
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