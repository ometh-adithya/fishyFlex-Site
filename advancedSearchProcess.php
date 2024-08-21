<?php

include "connection.php";

$page = 1;
if (isset($_POST["page"]) && $_POST["page"] > 1) {
    $page = $_POST["page"];
}

$type = $_POST["type"];
$fishSize = $_POST["fishSize"];
$certificate = $_POST["certificate"];
$check = $_POST["check"];
$check1 = $_POST["check1"];
$tankvaritey = $_POST["tankvaritey"];
$tank_size = $_POST["tank_size"];
$search = $_POST["search"];
$pf = $_POST["pf"];
$pt = $_POST["pt"];

$query = "SELECT * FROM `product`";

$condition = [];

// if ($type != 0) {
//     $condition[] = "`type_id` = '$type'";
// }

if ($fishSize != 0) {
    $condition[] = "`fish_size_fs_id` = '$fishSize'";
}

if ($certificate != 0) {
    $condition[] = "`certificate_certificate_id` = '$certificate'";
}

if ($check == "true") {
    $condition[] = "`condition_con_id` = '1'";
}

if ($check1 == "true") {
    $condition[] = "`condition_con_id` = '2'";
}

if ($tankvaritey != 0) {
    $condition[] = "`tank_varitey_tv_id` = '$tankvaritey'";
}

if ($tank_size != 0) {
    $condition[] = "`tank_size_tz_id` = '$tank_size'";
}

if (!empty($search)) {
    $condition[] = "`pro_name` LIKE '%$search%' ";
}

if (!empty($pf) && empty($pt)) {
    $condition[] = "`price` >= '$pf'";
}

if (empty($pf) && !empty($pt)) {
    $condition[] = "`price` <= '$pt'";
}

if (!empty($pf) && !empty($pt)) {
    $condition[] = "`price` BETWEEN '$pf' AND '$pt'";
}

if (!empty($condition)) {
    $query .= " WHERE " . implode(" AND ", $condition);
}

$query .= " AND `status_status_id` = '1'";

$advanced_rs = Database::search($query);
$advanced_num = $advanced_rs->num_rows;

$resulsperpage = 4;
$noofpages = ceil($advanced_num / $resulsperpage);
$pageresults = ($page - 1) * $resulsperpage;

$query .= " LIMIT $resulsperpage OFFSET $pageresults";

$advanced_rs2 = Database::search($query);
$advanced_num2 = $advanced_rs2->num_rows;

?>
<div class="col-lg-9 ">
    <div class="row g-4 justify-content-center" id="content">
        <?php

        if ($advanced_num2 > 0) {

            for ($i = 0; $i < $advanced_num2; $i++) {
                $advanced_data = $advanced_rs2->fetch_assoc();
        ?>
                <?php
                $catid = $advanced_data["categories_cat_id"];
                $cat_rs = Database::search("SELECT * FROM `product` INNER JOIN `categories` ON product.categories_cat_id=categories.cat_id WHERE `categories_cat_id`='$catid'");
                $cat_num = $cat_rs->num_rows;
                $cat_data = $cat_rs->fetch_assoc();
                ?>
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="rounded position-relative fruite-item">
                        <a href="singleProductView.php?product=<?php echo $advanced_data["product_id"]; ?>&category=<?php echo $advanced_data["categories_cat_id"]; ?>" class="link-light">
                            <div class="fruite-img">
                                <img src="<?php echo $advanced_data["pro_img"]; ?>" class="img-fluid w-100 rounded-top" alt="">
                            </div>
                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $cat_data["cat_name"]; ?></div>
                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                <h4><?php echo $advanced_data["pro_name"]; ?></h4>
                                <p><?php echo $advanced_data["description"]; ?></p>
                                <div class="d-flex justify-content-between flex-lg-wrap">
                                    <p class="text-dark fs-5 fw-bold mb-0">Rs.<?php echo $advanced_data["price"]; ?>.00</p>
                                    <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                
        <?php
            }
        } else {
        }
        ?>
    </div>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" aria-label="Previous" <?php
                                                  if ($page > 1) {
                                                  ?> onclick="advanceSearch(<?php echo ($page - 1); ?>)" ; <?php
                                                        }
                                                          ?>>
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

    <?php

    for ($i = 1; $i <= $noofpages; $i++) {
      if ($i == $page) {
    ?>


        <li class="page-item active"><a class="page-link" onclick="advanceSearch(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>

      <?php
      } else {
      ?>

        <li class="page-item "><a class="page-link" onclick="advanceSearch(<?php echo ($i); ?>);"><?php echo ($i); ?></a></li>

    <?php
      }
    }

    ?>

    <li class="page-item">
      <a class="page-link" aria-label="Next" <?php

                                              if ($page < $noofpages) {
                                              ?> onclick="advancedSearch(<?php echo ($page + 1); ?>)" ; <?php
                                                        }
                                                          ?>>
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>