<?php
require "includes/header.php";
require "includes/db.php";

        $test = "line";


        $get_phone_info_sql = mysqli_query($connection, "SELECT * FROM smartphone_details WHERE id =" . (int)$_GET['id']);
        $get_phone_sql = mysqli_query($connection, "SELECT * FROM smartphone WHERE id =" . (int)$_GET['id']);
        if (mysqli_num_rows($get_phone_info_sql) == 0) {
            echo "Смартфон не был найден!!!";
        }
        else{
            $phone_info = mysqli_fetch_assoc($get_phone_info_sql);
            $phone = mysqli_fetch_assoc($get_phone_sql);
            mysqli_query($connection, 'UPDATE smartphone SET views = views+1 WHERE id = '. $_GET['id']);
?>


<div class="container-fluid p-2">
    <div class="container-xl d-flex justify-content-between">
        <div class="container-sm p-2 mt-5 ">
            <div class="row">
                <h1><?php echo $phone['model_name']; ?></h1>
                <p>Product id: <?php echo $_GET['id']; ?></p>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <img class="img-fluid" style="height: 60%" src="<?php echo $phone['photo']; ?>" alt="">
                </div>
                <div class="col">
                    <div class="row d-flex about_rating">
                        <div style="background: yellow">0.0</div>
                        <div>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <a href=""><span>0</span> <?php echo $phone['reviews']; ?></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="product_info">
                            <p class="about__text__title">Characteristics</p>
                            <div class="product_info__row">
                                <p>CPU</p>
                                <p><?php echo $phone_info['cpu']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Frequency</p>
                                <p><?php echo $phone_info['cpu_frequency']; ?> ГГц</p>
                            </div>
                            <div class="product_info__row">
                                <p>OS</p>
                                <p><?php echo $phone_info['operating_system']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Cores</p>
                                <p><?php echo $phone_info['number_of_cores']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Main cameras</p>
                                <p><?php echo $phone_info['back_camera']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Front cameras</p>
                                <p><?php echo $phone_info['front_camera']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Camera Features</p>
                                <p><?php echo $phone_info['camera_features']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Video Features</p>
                                <p><?php echo $phone_info['video_features']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Dimensions</p>
                                <p><?php echo $phone_info['dimensions']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Display Resolution</p>
                                <p><?php echo $phone_info['display_resolution']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Display Diagonal</p>
                                <p><?php echo $phone_info['display_diagonal']; ?></p>
                            </div>

                            <div class="product_info__row">
                                <p>Housing Materials</p>
                                <p><?php echo $phone_info['housing_material']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Peculiarities</p>
                                <p><?php echo $phone_info['peculiarities']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Sensors</p>
                                <p><?php echo $phone_info['sensors']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Protection</p>
                                <p><?php echo $phone_info['protection']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Model Year</p>
                                <p><?php echo $phone_info['model_year']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>SIM</p>
                                <p><?php echo $phone_info['sim']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Matrix Type</p>
                                <p><?php echo $phone_info['matrix_type']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>PPI</p>
                                <p><?php echo $phone_info['ppi']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Battery Capacity</p>
                                <p><?php echo $phone_info['battery_capacity']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Flash Card</p>
                                <p><?php echo $phone_info['flash_card']; ?></p>
                            </div>

                            <div class="product_info__row">
                                <p>Fast Charging</p>
                                <p><?php echo $phone_info['fast_charge']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Connectors</p>
                                <p><?php echo $phone_info['connectors']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>RAM</p>
                                <p><?php echo $phone_info['ram']; ?></p>
                            </div>
                            <div class="product_info__row">
                                <p>Memory</p>
                                <p><?php echo $phone_info['memory']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 p-2 sticky-sm-top">
            <div class="row">
                <h1>Price: <?php echo $phone['price']; ?> ₸</h1>
            </div>
            <div class="row">
                <div class="product_info__row">
                    <i class="fas fa-shipping-fast">Standard Shipping</i>
                    <p>5000 ₸</p>
                </div>
                <div class="product_info__row">
                    <i class="fas fa-store-alt">Pickup from store</i>
                    <p>Free</p>
                </div>
            </div>
            <div class="row">
                <div class="detail__offer__buy mt-5">
                    <button>Add to basket</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
</body>
</html>