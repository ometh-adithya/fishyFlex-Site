<div class="col-lg-12 py-5 cat position-relative">
    <h4 class="mb-3 right">Filter products</h4>
    <?php

    if ($catId == 1) {
    ?>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="type">
                <option value="0">fish type</option>
                <?php

                $type_rs = Database::search("SELECT * FROM `type`");
                $type_num = $type_rs->num_rows;

                for ($i = 0; $i < $type_num; $i++) {
                    $type_data = $type_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $type_data["type_id"]; ?> " style="background-color: #ff1a75;"><?php echo $type_data["type_name"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="fishSize">
                <option value="0">fish size</option>
                <?php

                $fish_size_rs = Database::search("SELECT * FROM `fish_size`");
                $fish_size_num = $fish_size_rs->num_rows;

                for ($i = 0; $i < $fish_size_num; $i++) {
                    $fish_size_data = $fish_size_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $fish_size_data["fs_id"]; ?>" style="background-color: #ff1a75;"><?php echo $fish_size_data["fish_size"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="tank_size" disabled>
                <option value="0">tank size</option>
                <?php

                $ts_rs = Database::search("SELECT * FROM `tank_size`");
                $ts_num = $ts_rs->num_rows;

                for ($i = 0; $i < $ts_num; $i++) {
                    $ts_data = $ts_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $ts_data["tz_id"]; ?>" style="background-color: #ff1a75;"><?php echo $ts_data["tank_size"]; ?></option>
                <?php
                }

                ?>

            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="tankvaritey" disabled>
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
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="certificate">
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
        <div class="d-flex mb-2 col-xl-2 py-3 ">
            <div class="form">
                <div class="form-item">
                    <label class="form-label">Price from</label>
                    <input type="text" class="form-control" id="pf">
                </div>
                <div class="form-item">
                    <label class="form-label">price to</label>
                    <input type="text" class="form-control" id="pt">
                </div>
            </div>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 justify-content-between left">
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Imported</div>
                </label>
                <input type="checkbox" id="check" class="form-check-input" value="1">
            </div>
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Local</div>
                </label>
                <input type="checkbox" id="check1" class="form-check-input" value="2">
            </div>
        </div>
        <div class="col-xl-2">
            <div class="row">
                <button class="btn btn-info rounded-pill border border-2" onclick="advanceSearch(1);">Search</button>
            </div>
        </div>
    <?php
    } else if ($catId == 2) {
    ?>

        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="type" disabled>
                <option value="0">fish type</option>
                <?php

                $type_rs = Database::search("SELECT * FROM `type`");
                $type_num = $type_rs->num_rows;

                for ($i = 0; $i < $type_num; $i++) {
                    $type_data = $type_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $type_data["type_id"]; ?> " style="background-color: #ff1a75;"><?php echo $type_data["type_name"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="fishSize" disabled>
                <option value="0">fish size</option>
                <?php

                $fish_size_rs = Database::search("SELECT * FROM `fish_size`");
                $fish_size_num = $fish_size_rs->num_rows;

                for ($i = 0; $i < $fish_size_num; $i++) {
                    $fish_size_data = $fish_size_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $fish_size_data["fs_id"]; ?>" style="background-color: #ff1a75;"><?php echo $fish_size_data["fish_size"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="tank_size">
                <option value="0">tank size</option>
                <?php

                $ts_rs = Database::search("SELECT * FROM `tank_size`");
                $ts_num = $ts_rs->num_rows;

                for ($i = 0; $i < $ts_num; $i++) {
                    $ts_data = $ts_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $ts_data["tz_id"]; ?>" style="background-color: #ff1a75;"><?php echo $ts_data["tank_size"]; ?></option>
                <?php
                }

                ?>

            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="tankvaritey">
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
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="certificate">
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
        <div class="d-flex mb-2 col-xl-2 py-3 ">
            <div class="form">
                <div class="form-item">
                    <label class="form-label">Price from</label>
                    <input type="text" class="form-control" id="pf">
                </div>
                <div class="form-item">
                    <label class="form-label">price to</label>
                    <input type="text" class="form-control" id="pt">
                </div>
            </div>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 justify-content-between left">
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Imported</div>
                </label>
                <input type="checkbox" id="check" class="form-check-input" value="1">
            </div>
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Local</div>
                </label>
                <input type="checkbox" id="check1" class="form-check-input" value="2">
            </div>
        </div>
        <div class="col-xl-2">
            <div class="row">
                <button class="btn btn-info rounded-pill border border-2" onclick="advanceSearch(1);">Search</button>
            </div>
        </div>

    <?php
    } else if ($catId == 3) {
    ?>

        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="type" disabled>
                <option value="0">fish type</option>
                <?php

                $type_rs = Database::search("SELECT * FROM `type`");
                $type_num = $type_rs->num_rows;

                for ($i = 0; $i < $type_num; $i++) {
                    $type_data = $type_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $type_data["type_id"]; ?> " style="background-color: #ff1a75;"><?php echo $type_data["type_name"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="fishSize" disabled>
                <option value="0">fish size</option>
                <?php

                $fish_size_rs = Database::search("SELECT * FROM `fish_size`");
                $fish_size_num = $fish_size_rs->num_rows;

                for ($i = 0; $i < $fish_size_num; $i++) {
                    $fish_size_data = $fish_size_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $fish_size_data["fs_id"]; ?>" style="background-color: #ff1a75;"><?php echo $fish_size_data["fish_size"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="tank_size" disabled>
                <option value="0">tank size</option>
                <?php

                $ts_rs = Database::search("SELECT * FROM `tank_size`");
                $ts_num = $ts_rs->num_rows;

                for ($i = 0; $i < $ts_num; $i++) {
                    $ts_data = $ts_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $ts_data["tz_id"]; ?>" style="background-color: #ff1a75;"><?php echo $ts_data["tank_size"]; ?></option>
                <?php
                }

                ?>

            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="tankvaritey" disabled>
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
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="certificate">
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
        <div class="d-flex mb-2 col-xl-2 py-3 ">
            <div class="form">
                <div class="form-item">
                    <label class="form-label">Price from</label>
                    <input type="text" class="form-control" id="pf">
                </div>
                <div class="form-item">
                    <label class="form-label">price to</label>
                    <input type="text" class="form-control" id="pt">
                </div>
            </div>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 justify-content-between left">
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Imported</div>
                </label>
                <input type="checkbox" id="check" class="form-check-input" value="1">
            </div>
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Local</div>
                </label>
                <input type="checkbox" id="check1" class="form-check-input" value="2">
            </div>
        </div>
        <div class="col-xl-2">
            <div class="row">
                <button class="btn btn-info rounded-pill border border-2" onclick="advanceSearch(1);">Search</button>
            </div>
        </div>

    <?php
    } else if ($catId == 4) {

    ?>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="type" disabled>
                <option value="0">fish type</option>
                <?php

                $type_rs = Database::search("SELECT * FROM `type`");
                $type_num = $type_rs->num_rows;

                for ($i = 0; $i < $type_num; $i++) {
                    $type_data = $type_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $type_data["type_id"]; ?> " style="background-color: #ff1a75;"><?php echo $type_data["type_name"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="fishSize" disabled>
                <option value="0">fish size</option>
                <?php

                $fish_size_rs = Database::search("SELECT * FROM `fish_size`");
                $fish_size_num = $fish_size_rs->num_rows;

                for ($i = 0; $i < $fish_size_num; $i++) {
                    $fish_size_data = $fish_size_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $fish_size_data["fs_id"]; ?>" style="background-color: #ff1a75;"><?php echo $fish_size_data["fish_size"]; ?></option>
                <?php
                }

                ?>
            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 left">
            <select class="form-select" id="tank_size" disabled>
                <option value="0">tank size</option>
                <?php

                $ts_rs = Database::search("SELECT * FROM `tank_size`");
                $ts_num = $ts_rs->num_rows;

                for ($i = 0; $i < $ts_num; $i++) {
                    $ts_data = $ts_rs->fetch_assoc();
                ?>
                    <option value="<?php echo $ts_data["tz_id"]; ?>" style="background-color: #ff1a75;"><?php echo $ts_data["tank_size"]; ?></option>
                <?php
                }

                ?>

            </select>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="tankvaritey" disabled>
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
        <div class="d-flex mb-2 col-xl-2 py-3 right">
            <select class="form-select" id="certificate">
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
        <div class="d-flex mb-2 col-xl-2 py-3 ">
            <div class="form">
                <div class="form-item">
                    <label class="form-label">Price from</label>
                    <input type="text" class="form-control" id="pf">
                </div>
                <div class="form-item">
                    <label class="form-label">price to</label>
                    <input type="text" class="form-control" id="pt">
                </div>
            </div>
        </div>
        <div class="d-flex mb-2 col-xl-2 py-3 justify-content-between left">
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Imported</div>
                </label>
                <input type="checkbox" id="check" class="form-check-input" value="1">
            </div>
            <div class="form-check">
                <label class="form-check-label text-secondary">
                    <div>Local</div>
                </label>
                <input type="checkbox" id="check1" class="form-check-input" value="2">
            </div>
        </div>
        <div class="col-xl-2">
            <div class="row">
                <button class="btn btn-info rounded-pill border border-2" onclick="advanceSearch(1);">Search</button>
            </div>
        </div>
    <?php
    } else if ($catId > 4) {
    ?>
        <script>
            window.location = "shop.php";
        </script>
    <?php
    }
    ?>
</div>
<div class="col-lg-9 ">
    <div class="row g-4 justify-content-center" id="content">
        <?php

        if (isset($_GET["category"])) {

            $catId = $_GET["category"];

            if ($catId > $cat_data) {
                echo "invalid cat id";
            }

            if (!empty($catId)) {

                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `categories_cat_id`='$catId' ");
                $product_num = $product_rs->num_rows;

                for ($i = 0; $i < $product_num; $i++) {
                    $product_data = $product_rs->fetch_assoc();

        ?>
                    <div class="col-md-6 col-lg-6 col-xl-4 top">
                        <div class="rounded position-relative fruite-item ">
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
            } else {
                ?>
                <script>
                    window.location = "shop.php";
                </script>
            <?php
            }

            ?>

            <?php
        } else if (isset($_GET["search"])) {

            $search = $_GET["search"];

            if (!empty($search)) {

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
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $data["cat_name"]; ?></div>
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
            } else {
                echo "invalid search";
            }

            ?>

        <?php
        }
        ?>
        <!-- pagination -->
        <!-- <nav aria-label="..."> -->
            <!-- <ul class="pagination bottom justify-content-center">
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <span class="page-link">2</span>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav> -->
        <!-- pagination -->
    </div>
</div>