<?php include "connection.php";
session_start();

if (isset($admin)) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>FishyFlex - manageUser</title>
            <link rel="stylesheet" href="css/bootstrap.css">
            <link rel="stylesheet" href="css/style.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        </head>
    </head>

    <body>
        <?php include "adminHeader.php"; ?>

        <div class="container-fluid">
            <div class="row col-12 justify-content-center py-5">
                <h1 class="fw-bold text-info">Manage Users</h1>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-auto">
                            <div class="card-body pb-0" id="page">
                                <h5 class="card-title">Manage your users</h5>
                                <hr>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">user Id</th>
                                            <th scope="col">User Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Contact Number</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Registerd Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $users_rs = Database::search("SELECT * FROM `users` WHERE `user_type_id`='2'");
                                        $users_num = $users_rs->num_rows;

                                        for ($i = 0; $i < $users_num; $i++) {
                                            $users_data = $users_rs->fetch_assoc();
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $users_data["id"]; ?></th>
                                                <td><a href="#" class="text-primary fw-bold"><?php echo $users_data["fname"] . " " . $users_data["lname"]; ?></a></td>
                                                <td><?php echo $users_data["email"]; ?></td>
                                                <td class="fw-bold"><?php echo $users_data["mobile_nb"]; ?></td>
                                                <?php
                                                $sId = $users_data["status_status_id"];
                                                $srs = Database::search("SELECT * FROM `status` WHERE `status_id`='$sId'");
                                                $snum = $srs->num_rows;
                                                $sdata = $srs->fetch_assoc();
                                                ?>
                                                <td id="status"><button class="fw-bold btn btn-info rounded-pill" onclick="blockUser('<?php echo $users_data['id']; ?>');"><?php echo $sdata["status_name"]; ?></button></td>
                                                <td><?php echo $users_data["reg_date"]; ?></td>
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
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>
    </body>

    </html>

<?php

}else{
    header("Location: adminsignin.php");
}

?>