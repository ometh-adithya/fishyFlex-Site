<?php

include "connection.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - adminReporsts</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

    <?php include "adminHeader.php"; ?>

    <main class="px-3 py-4">
        <div class="container-fluid">
            <section>
                <div class="row justify-content-center">
                    <h1 class="text-info fw-bold text-uppercase">Admin Reports</h1>
                </div>
                <div class="col-lg-4 py-3">
                    <a href="productReports.php">
                        <div class="card bg-warning sales-card">
                            <div class="card-body">
                                <h2 class="text-bg-info rounded-pill ">Product Reports</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 py-3">
                    <a href="userReports.php">
                        <div class="card bg-warning sales-card">
                            <div class="card-body">
                                <h2 class="text-bg-info rounded-pill ">User Reports</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 py-3">
                    <a href="salesReports.php">
                        <div class="card bg-warning sales-card">
                            <div class="card-body">
                                <h2 class="text-bg-info rounded-pill ">Sales Reports</h2>
                            </div>
                        </div>
                    </a>
                </div>

            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>