<nav class="navbar navbar-expand-lg top">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="#">FishyFlex</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <div class="navbar-nav mx-auto">
                <a href="index.php" class="nav-item nav-link active text-light">Home</a>
                <a href="shop.php" class="nav-item nav-link text-light">Shop</a>
                <a href="shop-detail.html" class="nav-item nav-link text-light">Shop Detail</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-light" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu m-0 bg-secondary rounded-0">
                        <a href="cart.php" class="dropdown-item text-light">Cart</a>
                        <a href="checkout.php" class="dropdown-item text-light">Checkout</a>
                        <a href="testimonial.php" class="dropdown-item text-light">Testimonial</a>
                        <a href="404.php" class="dropdown-item text-light">404 Page</a>
                    </div>
                </div>
                <a href="contact.php" class="nav-item nav-link text-light">Contact</a>
            </div>
            <div class="d-flex">
                <div>
                    <?php
                    session_start();
                    if (isset($_SESSION["user"])) {
                    ?>
                        <button class="btn btn-info" onclick="signout();">SignOut</button>
                    <?php
                    } else {
                    ?>
                        <a class="btn border border-secondary btn-md-square rounded-circle me-4 bg-info" href="signIn.php"><i class="fa-solid fa-user"></i></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>