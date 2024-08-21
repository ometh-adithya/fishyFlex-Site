<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - FishyFlex</title>
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

    <div class="container d-flex justify-content-center align-items-center min-vh-100 mb-1">
        <div class="row">
            <div class="modal" tabindex="-1" role="dialog" id="changebox">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-bg-info">
                            <h5 class="modal-title text-dark">Forget Password</h5>
                        </div>
                        <div class="modal-body text-bg-dark">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Verification Code" aria-label="Recipient's username" aria-describedby="button-addon2" id="vcode">
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="New Password" aria-label="Recipient's username" aria-describedby="button-addon2" id="newps">
                                <button class="btn btn-info btn-outline-secondary" type="button" id="shb" onclick="showPassword();">Show</button>
                            </div>
                        </div>
                        <div class="modal-footer text-bg-dark">
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image">
                    <img src="assets/signin.png" class="img-fluid" style="width: 250px;">
                </div>
                <p class="fs-2" style="font-weight: 600; color: #000000;">welcome</p>
                <small class="text-wrap text-center text-black">Sign In to FishyFlex to experienced better service</small>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-black">
                        <p>Welcome,Again</p>
                        <p>You Can Get What You Want</p>
                    </div>
                    <?php
                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }
                    ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="exsample@gmail.com" id="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="********" id="password" value="<?php echo $password; ?>">
                    </div>
                    <div class="input-group mb-5 d-flex justify-content-between">
                        <div class="form-check">
                            <label class="form-check-label text-secondary">
                                <div>Remember Me</div>
                            </label>
                            <input type="checkbox" id="rememberme" class="form-check-input">
                        </div>
                        <div class="forgot">
                            <a class="btn btn-info text-dark" onclick="forgetPassword();">Forgot Password</a>
                        </div>
                    </div>
                    <div class="forgot mb-3">
                        <div class="text-dark">Don't have an account ? <a href="signUp.php">Click here</a></div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-primary w-100 fs-6" onclick="signIn();">Sign In</button>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-light w-100 fs-6"><img src="assets/google.svg">Sign in with Google</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>