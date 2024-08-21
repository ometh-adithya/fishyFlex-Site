<?php

include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - FishyFlex</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: "Montserrat", sans-serif;
            background: #e1e1ea;
        }

        .box-area {
            width: 930px;
        }
    </style>
</head>

<body>

    <!-- navbar -->
    <?php echo include "header.php"; ?>
    <!-- navbar -->

    <div class="container d-flex justify-content-center align-items-center min-vh-100 mt-5">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image">
                    <img src="assets/signup.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="fs-2" style="font-weight: 600; color: #000000;">welcome</p>
                <small class="text-wrap text-center text-black">Sign up to FishyFlex to experienced better service</small>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-black">
                        <p>Welcome,Again</p>
                        <p>You Can Get What You Want</p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="First name" id="fname">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Last name" id="lname">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Mobile number" id="nb">
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" id="email">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="password" id="password">
                    </div>
                    <div class="input-group mb-3">
                        <label for="gender" class="form-control form-control-lg bg-light fs-6">gender</label>
                        <select class="form-control" id="gender">

                            <?php

                            $rs = Database::search("SELECT * FROM `gender`");
                            $num = $rs->num_rows;

                            for ($x = 0; $x < $num; $x++) {
                                $data = $rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $data["gender_id"]; ?>">
                                    <?php echo $data["name"]; ?>
                                </option>

                            <?php
                            }

                            ?>
                        </select>
                    </div>
                    <div class="input-group mb-5 d-flex ">
                        <div class="forgot">
                            <div>Already have an account ?<a href="signIn.php">Click here</a></div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6" onclick="signUp();">Sign Up</button>
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