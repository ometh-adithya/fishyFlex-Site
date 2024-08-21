<?php

include "connection.php";
session_start();

if (isset($_SESSION["admin"])) {

?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishyFlex - adminDashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  </head>

  <body>

    <?php include "adminHeader.php"; ?>

    <main class="px-3 py-4">
      <div class="container-fluid">
        <section class="section dashboard">
          <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
              <div class="row">
                <div>
                  <h1>Dashboard</h1>
                  <nav>
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                  </nav>
                </div>
                <!-- Sales Card -->
                <div class="col-lg-6">
                  <?php
                  $d = new DateTime();
                  $tz = new DateTimeZone("Asia/Colombo");
                  $d->setTimezone($tz);
                  $date = $d->format("Y-m-d");

                  $sales_rs = Database::search("SELECT COUNT(`oh_id`) FROM `order_history` WHERE `order_date`='$date' ");
                  $sales_data = $sales_rs->fetch_assoc();

                  $today_sales = implode(" ", $sales_data);

                  $sales_rs1 = Database::search("SELECT COUNT(`oh_id`) FROM `order_history`");
                  $sales_data1 = $sales_rs1->fetch_assoc();

                  $total_sales = implode(" ", $sales_data1);

                  $sales_avg = $total_sales / $today_sales * 100;

                  ?>
                  <div class="card info-card sales-card">
                    <div class="card-body">
                      <h5 class="card-title">Sales <span>| Today</span></h5>
                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                          <h6><?php echo $today_sales; ?></h6>
                          <span class="text-success small pt-1 fw-bold"><?php echo $sales_avg; ?>%</span> <span class="text-muted small pt-2 ps-1">increase</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Customers Card -->
                <div class="col-lg-6">
                  <?php

                  $customers_rs = Database::search("SELECT COUNT(`users_id`) FROM `order_history`");
                  $customers_data = $customers_rs->fetch_assoc();

                  $customers = implode(" ", $customers_data);

                  $customers_rs1 = Database::search("SELECT COUNT(`id`) FROM `users`");
                  $customers_data1 = $customers_rs1->fetch_assoc();

                  $total_users = implode(" ", $customers_data1);

                  $customers_avg = $total_users / $customers * 100;

                  ?>
                  <div class="card info-card customers-card">
                    <div class="card-body">
                      <h5 class="card-title">Customers </h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                          <h6><?php echo $customers; ?></h6>
                          <span class="text-success small pt-1 fw-bold"><?php echo $customers_avg; ?>%</span> <span class="text-muted small pt-2 ps-1">Increase</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Top Selling -->
                <div class="col-lg-12 mt-3">
                  <div class="card overflow-auto">
                    <div class="card-body pb-0">
                      <h5 class="card-title">Top Selling <span>| Today</span></h5>
                      <table class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Preview</th>
                            <th scope="col">Product</th>
                            <th scope="col">Sold</th>
                            <th scope="col">Price</th>
                            <th scope="col">Revenue</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $d = new DateTime();
                          $tz = new DateTimeZone("Asia/Colombo");
                          $d->setTimezone($tz);
                          $date = $d->format("Y-m-d");

                          $sale_rs = Database::search("SELECT * FROM `order_history` INNER JOIN `order_items` ON order_history.oh_id=order_items.order_history_oh_id WHERE `order_date`='$date' AND `qty` > '10' LIMIT 5 ");
                          $sale_num = $sale_rs->num_rows;

                          for ($i = 0; $i < $sale_num; $i++) {
                            $sale_data = $sale_rs->fetch_assoc();

                            $sale_id = $sale_data["product_product_id"];

                            $produt_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='$sale_id' ");
                            $produt_num = $produt_rs->num_rows;
                            $produt_data = $produt_rs->fetch_assoc();
                          ?>
                            <tr>
                              <th scope="row"><img style="min-width: 96px; height: 96px;" class="img-fluid " src="<?php echo $produt_data["pro_img"]; ?>"></th>
                              <td><a href="#" class="text-primary fw-bold"><?php echo $produt_data["pro_name"]; ?></a></td>
                              <td><?php echo $sale_data["qty"]; ?></td>
                              <td class="fw-bold">Rs.<?php echo $produt_data["price"]; ?>.00</td>
                              <?php
                              $total = $sale_data["qty"] * $produt_data["price"];
                              ?>
                              <td>Rs.<?php echo $total; ?>.00</td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- Recent Sales -->
                <div class="col-lg-12 mt-3">
                  <div class="card overflow-auto">
                    <div class="card-body">
                      <h5 class="card-title">Recent Customer <span>| Today</span></h5>
                      <table class="table table-borderless datatable">
                        <thead>
                          <tr>
                            <th scope="col">Customer</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Total Buy</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $d = new DateTime();
                          $tz = new DateTimeZone("Asia/Colombo");
                          $d->setTimezone($tz);
                          $date = $d->format("Y-m-d");

                          $customer_rs = Database::search("SELECT * FROM `order_history` INNER JOIN `users` ON order_history.users_id=users.id WHERE `order_date`='$date' LIMIT 5 OFFSET 1 ");
                          $customer_num = $customer_rs->num_rows;

                          for ($i = 0; $i < $customer_num; $i++) {
                            $customer_data = $customer_rs->fetch_assoc();

                          ?>
                            <tr>
                              <th scope="row"><img style="min-width: 96px; height: 96px;" class="img-fluid " src="<?php echo $customer_data["profileimg_img"]; ?>"></th>
                              <td><?php echo $customer_data["fname"] . " " . $customer_data["lname"] ;?></td>
                              <td><a href="#" class="text-primary"><?php echo $customer_data["email"]; ?></a></td>
                              <td><?php echo $customer_data["amount"]; ?></td>
                              <td><span class="badge bg-success">Approved</span></td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>

                    </div>

                  </div>
                </div>

              </div>
            </div>
            <!-- right side-->
            <div class="col-lg-4 mt-5">
              <!-- feedback -->
              <form action="#">
                <h4 class="mb-5 fw-bold top">Contact User</h4>
                <div class="row g-4 mb-5 bg-transparent">
                  <div class="col-lg-6">
                    <div class="border-bottom rounded">
                      <?php
                      $fname = $_SESSION["admin"]["fname"];
                      $lname = $_SESSION["admin"]["lname"]
                      ?>
                      <input type="text" class="form-control border-0 me-4 text-bg-info left " disabled placeholder="Your Name " id="name" value="<?php echo $fname." ".$lname;?>">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="border-bottom rounded">
                      <select type="email" class="form-control border-0 text-bg-info right" id="email">
                        <option value="0">Customers Email</option>
                        <?php 
                        $email_rs = Database::search("SELECT * FROM `users` WHERE `user_type_id`='2' AND `status_status_id`='1'");
                        $email_num = $email_rs->num_rows;

                        for($i = 0; $i < $email_num; $i++){
                          $email_data = $email_rs->fetch_assoc();
                          ?>
                          <option value="<?php echo $email_data["email"];?>"><?php echo $email_data["email"];?></option>
                          <?php
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="border-bottom rounded my-4">
                      <textarea id="msg" class="form-control border-0 text-bg-info bottom" cols="30" rows="8" placeholder="Your Review *"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class=" justify-align-content-center py-3 mb-5">
                      <a class="btn fw-bold text-primary rounded-pill px-4 py-3 top" style="background-color: #ff1a75;" onclick="sendEmail();"> Post Comment</a>
                    </div>
                  </div>
                </div>
              </form>
              <!-- feedback -->
            </div>
          </div>
        </section>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
  </body>

  </html>

<?php
} else {
  header("Location: adminSignin.php");
}
?>