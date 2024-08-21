<?php include "connection.php";

if (isset($_GET["category"])) {
    $catId = $_GET["category"];
}else{

    $search = $_GET["search"];

    $search_rs = Database::search("SELECT * FROM `product` WHERE `pro_name` LIKE '%$search%' ");
    $search_num = $search_rs->num_rows;
    $search_data = $search_rs->fetch_assoc();

    if(empty($search_num)){
        header("Location : shop.php");
    }else{
        $catId = $search_data["categories_cat_id"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - CategoryResultSet</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <!-- shop start -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <h1 class="mb-4 left">FishyFlex shop</h1>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <!-- search -->
                        <form action="catResultProcess.php" method="GET" class="col-xl-3 right">
                            <div class="input-group w-100 mx-auto d-flex">
                                <input type="search" class="form-control p-3 border-2 border-secondary" placeholder="Search" name="search" id="search">
                                <button type="submit" class="input-group-text p-3 btn btn-primary border-2 border-secondary">search</button>
                            </div>
                        </form>
                        <!-- search -->
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3 left">
                                            <h4>Categories</h4>
                                            <ul class="list-unstyled fruite-categorie">

                                                <?php

                                                $cat_rs = Database::search("SELECT * FROM `categories`");
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
                            <!-- filetrs -->
                            <?php include "filterForm.php"; ?>
                            <!-- filetrs -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Shop End-->



        <!-- footer -->
        <?php include "footer.php"; ?>
        <!-- footer -->

        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>
</body>

</html>

<?php

?>