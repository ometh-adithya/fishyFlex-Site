<?php
include "connection.php";
session_start();

if (isset($_SESSION["user"])) {

    $userid = $_SESSION["user"]["id"];
    $user_rs = Database::search("SELECT * FROM `users` WHERE `id`='$userid'");

    if ($user_rs->num_rows > 1) {
        header("Location: signIn.php");
    }

    $user_data = $user_rs->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FishyFlex - userProfile</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    </head>

    <body>

        <div class="container rounded-5 border border-3 border-primary bg-dark mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right border-5 border-danger">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5 ">
                        <?php
                        if (isset($user_data["profileimg_img"])) {
                        ?>
                            <img class="rounded-circle mt-5 border border-5 border-danger" width="200px" id="img" src="<?php echo $user_data["profileimg_img"]; ?>">
                            <span class="font-weight-bold text-uppercase"><?php echo $user_data["fname"]; ?></span>
                            <input type="file" class="d-none" id="profileimage" />
                            <label for="profileimage" class="btn btn-primary rounded-pill mt-5" onclick="updateImage();">Change Image</label>
                        <?php
                        } else {
                        ?>
                            <img class="rounded-circle mt-5 border border-5 border-danger" width="200px" id="img" src="#">
                            <span class="font-weight-bold text-uppercase"><?php echo $user_data["fname"]; ?></span>
                            <input type="file" class="d-none" id="profileimage" />
                            <label for="profileimage" class="btn btn-primary rounded-pill mt-5" onclick="updateImage();">Add Image</label>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="col-9 ">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-center mb-3">
                            <h4 class="text-right fw-bolder">Your Profile</h4>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">First name</label>
                                <input type="text" class="form-control" placeholder="first name" value="<?php echo $user_data["fname"]; ?>" id="fname">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Last name</label>
                                <input type="text" class="form-control" value="<?php echo $user_data["lname"]; ?>" placeholder="Last name" id="lname">
                            </div>
                        </div>
                        <div class="row mt-3 ">
                            <div class="col-md-12">
                                <label class="form-label">Mobile number</label>
                                <input type="number" class="form-control" placeholder="enter phone number" value="<?php echo $user_data["mobile_nb"]; ?>" id="number">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" placeholder="enter email " value="<?php echo $user_data["email"]; ?>" disabled>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-label">Registerd Date</label>
                                <input type="text" class="form-control" placeholder="enter email " value="<?php echo $user_data["reg_date"]; ?>" disabled>
                            </div>

                            <?php
                            
                            $userAddres_rs = Database::search("SELECT * FROM `user_addres` INNER JOIN `distric` ON 
                            user_addres.distric_distric_id=distric.distric_id INNER JOIN `province` ON 
                            distric.province_province_id=province.province_id WHERE `users_id`='$userid'");

                            $line1 = "";
                            $line2 = "";
                            $pcode = "";
                            $city = "";
                            $province = "";
                            $distric = "";

                            if($userAddres_rs->num_rows > 0){
                                $userAddres_data = $userAddres_rs->fetch_assoc();

                                $line1 = $userAddres_data["line_1"];
                                $line2 = $userAddres_data["line_2"];
                                $pcode = $userAddres_data["postalcode"];
                                $city = $userAddres_data["city"];
                                $province = $userAddres_data["province_name"];
                                $distric = $userAddres_data["distric_name"];

                            }

                            ?>

                            <div class="col-md-12 mt-2">
                                <label class="form-label">Address Line 1</label>
                                <input type="text" class="form-control" placeholder="enter address line 1" value="<?php echo ($line1);?>" id="line1">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" placeholder="enter address line 2" value="<?php echo ($line2);?>" id="line2">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label">Postcode</label>
                                <input type="text" class="form-control" placeholder="enter postalcode" value="<?php echo ($pcode);?>" id="pcode">
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" placeholder="enter city" value="<?php echo ($city);?>" id="city">
                            </div>
                            <div class="col-md-6 mt-2">
                                <?php
                                
                                $gid = $user_data["gender_gender_id"];

                                $g_rs = Database::search("SELECT * FROM `gender` WHERE `gender_id` = '$gid' ");
                                $g_data = $g_rs->fetch_assoc();
                                
                                ?>
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" placeholder="enter city" value="<?php echo $g_data["name"]; ?>" readonly>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" placeholder="enter city" value="<?php echo $user_data["password"]; ?>" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="form-label">Province</label>
                                <select class="form-control" id="province">
                                    <option value="0"><?php echo ($province);?></option>
                                    <?php

                                    $province_rs = Database::search("SELECT * FROM `province`");
                                    $province_num = $province_rs->num_rows;

                                    for ($i = 0; $i < $province_num; $i++) {
                                        $province_data = $province_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $province_data["province_id"]; ?>"> <?php echo $province_data["province_name"];?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" >Distric</label>
                                <select class="form-control" id="distric">
                                    <option value="0"><?php echo ($distric);?></option>
                                    <?php

                                    $distric_rs = Database::search("SELECT * FROM `distric`");
                                    $distric_num = $distric_rs->num_rows;

                                    for ($i = 0; $i < $distric_num; $i++) {
                                        $distric_data = $distric_rs->fetch_assoc();
                                    ?>
                                         <option value="<?php echo $distric_data["distric_id"]; ?>"><?php echo $distric_data["distric_name"];?></option>
                                    <?php
                                    }

                                    ?>

                                </select>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary rounded-pill col-4" type="button" onclick="updateProfile();">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- footer -->
        <?php include "footer.php"; ?>
        <!-- footer -->

        <script src="js/bootstrap.js"></script>
        <script src="js/script.js"></script>

    </body>

    </html>

<?php

} 
else {
    header("Location: signIn.php");
}

?>