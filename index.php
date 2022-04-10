<?php
require "includes/header.php";
require "includes/db.php";
?>


<div class="banner container-fluid">
    <div>
        <h2 class="row">Apple products are 30% OFF</h2>
        <h1 class="row">Are you ready?</h1>
        <h2 class="btn-shop">Shop Now</h2>
    </div>
</div>
<div class="showcase container-fluid justify-content-center mt-5">
    <h1>New Products</h1>
        <div class="container py-5">
            <div class="row">
            <?php
                $sql="SELECT * FROM smartphone_details WHERE model_name IS NOT NULL ORDER BY model_year DESC LIMIT 3";
                $new_phones = mysqli_query($connection, $sql);

                while ($phone_info = mysqli_fetch_assoc($new_phones)){
                    $phone_info_array = mysqli_query($connection, "SELECT * FROM smartphone WHERE id='".$phone_info["id"]."'");
                    $phone = mysqli_fetch_assoc($phone_info_array);
            ?>
                <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="card text-black">
                        <img
                                src="<?php echo $phone['photo'] ?>"
                                class="card-img-top"
                                alt="iPhone"
                        />
                        <div class="card-body">
                            <div class="text-center mt-1">
                                <h4 class="card-title"><?php echo $phone['model_name'] ?></h4>
                                <h6 class="text-primary mb-1 pb-3"><?php echo $phone['price'] ?> <small>₸</small></h6>
                            </div>

                            <div class="text-center">
                                <div class="p-3 mx-n3 mb-4" style="background-color: #eff1f2;">
                                    <h5 class="mb-0">Quick Look</h5>
                                </div>

                                <div class="d-flex flex-column mb-4">
                                    <span class="h1 mb-0"><?php echo $phone_info['display_diagonal'] ?>″</span>
                                    <span><?php echo $phone_info['matrix_type'] ?></span>
                                </div>

                                <div class="d-flex flex-column mb-4">
                <span class="h1 mb-0">
                  <i class="fas fa-camera-retro"></i>
                </span>
                                    <ul class="list-unstyled mb-0">
                                        <li style="font-weight:bold;">Main Cameras:</li>
                                        <li><?php echo $phone_info['back_camera'] ?></li>
                                        <li style="font-weight:bold;">Front Camera:</li>
                                        <li><?php echo $phone_info['front_camera'] ?></li>
                                    </ul>
                                </div>

                                <span class="h2 mb-0">
                                  CPU
                                </span>
                                <div class="d-flex flex-column mb-4">
                                    <span><?php echo $phone_info['cpu'] ?></span>
                                </div>

                                <span class="h2 mb-0">
                                  Capacity
                                </span>

                                <div class="d-flex flex-column mb-4 lead">
                                    <span class="mb-2"><?php echo $phone_info['memory'] ?> GB</span>
                                    <span style="color: transparent;">0</span>
                                </div>
                            </div>

                            <div class="d-flex flex-row">
                                <button
                                        type="button"
                                        class="btn btn-primary flex-fill me-1"
                                        data-mdb-ripple-color="dark"
                                >
                                    Learn more
                                </button>
                                <button type="button" class="btn btn-danger flex-fill ms-1">Buy now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
            ?>
            </div>
        </div>
    <h1 class="mb-50">Best Sellers</h1>
</div>

    <script src="js/main.js"></script>
</body>
</html>