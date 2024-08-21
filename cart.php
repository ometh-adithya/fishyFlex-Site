<?php
include "connection.php";
session_start();

if (isset($_SESSION["user"])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FishyFlex - cart</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    </head>

    <body onload="loadCart();">

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

        <!-- Cart Start -->
        <div class="container-fluid py-5" >
            <div class="container py-5">
                <div class="container-fluid py-5" >
                    <div class="container py-5" id="content">

                    </div>
                </div>
            </div>


        </div>

        <!-- Cart End -->

        <!-- footer -->
        <?php include "footer.php"; ?>
        <!-- footer -->

        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: signIn.php");
}
