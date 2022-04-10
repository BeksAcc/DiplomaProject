<?php
require "includes/header.php";
require "includes/db.php";
$counte_phones = mysqli_query($connection, "SELECT count(*) as counter FROM smartphone_details WHERE brand LIKE '%" . $_GET['brand'] . "%'");
$phones_number = mysqli_fetch_assoc($counte_phones);

$pages_number = ceil($phones_number["counter"]/10);
$page = isset($_GET['on_page']) ? (int)$_GET['on_page'] : 1;

?>

<div class="container-xl d-flex justify-content-center mt-50">
    <div class="row">
        <div class="product_header d-flex justify-content-between mb-50">
            <h3>All smartphones<span> - found <?php echo $phones_number["counter"] ?> results</span></h3>
            <button class="btn btn-outline-dark">Filters</button>
        </div>
        <div class="col">

            <?php
                $sql="SELECT * FROM smartphone WHERE model_name LIKE '%" . $_GET['brand'] . "%'";
                $new_phones = mysqli_query($connection, $sql);

                while ($phone_info = mysqli_fetch_assoc($new_phones)){
            ?>
            <div class="card card-body">
                <div class="media d-flex align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
                    <div class="mr-2 mb-3 mb-lg-0"> <img style="img-fluid" src="<?php echo $phone_info['photo']; ?>" width="150" height="150" alt=""> </div>
                    <div class="media-body d-flex align-items-start" style="flex-direction: column">
                        <h6 class="media-title font-weight-semibold"> <a href="detail.php?id=<?php echo $phone_info['id']; ?>" data-abc="true"><?php echo $phone_info['model_name']; ?></a> </h6>

                        <p class="mb-3 align-items-start" style="text-align: left"><?php echo $phone_info['description']; ?> </p>
                        <ul class="list-inline list-inline-dotted mb-0">
                            <li class="list-inline-item">In Stock</li>
                            <li class="list-inline-item">Add to <a href="#" data-abc="true">wishlist</a></li>
                        </ul>
                    </div>
                    <div class="mt-3 mt-lg-0 ml-lg-3 text-center" style="width: 250px">
                        <h3 class="mb-0 font-weight-semibold"><?php echo $phone_info['price']; ?> <small>₸</small></h3>
                        <div> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>  </div>
                        <div class="text-muted"><?php echo $phone_info['views']; ?></div> <button type="button" class="btn btn-warning mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>

        <div class = "pagination">
            <?php
            //Pagination
                if($pages_number<=10){
                    for ($i=1; $i < $pages_number+1; $i++) {
                        ?>
                            <a href='shop.php?on_page=<?php echo $i; ?>' style='<?php if($i==$page) echo "font-weight: bold; color: red;" ?> text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> <?php echo $i; ?></a>
                    <?php
                    }
                }
                else{ ?>
                    <a href='shop.php?on_page=1' style='<?php if(1==$page) echo "font-weight: bold; color: red;" ?> text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> 1</a>
                    <?php
                    //if page on center
                    if($page > 6 && $pages_number - $page > 6){
                        print("<a style='text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> ... </a>");
                        for ($i=$page-4; $i < $page+4; $i++) {?>
                            <a href='shop.php?on_page=<?php echo $i; ?>' style='<?php if($i==$page) echo "font-weight: bold; color: red;" ?> text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> <?php echo $i; ?></a>
                        <?php
                        }
                        print("<a style='text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> ... </a>");
                    }

                    //if page at the beginning
                    if($page <= 6){
                        for ($i=2; $i <= 7; $i++) {
                            ?>
                            <a href='shop.php?on_page=<?php echo $i; ?>' style='<?php if($i==$page) echo "font-weight: bold; color: red;" ?> text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> <?php echo $i; ?></a>
                        <?php
                        }
                        print("<a style='text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> ... </a>");
                    }

                    //if page at the end
                    if($pages_number - $page <= 6){
                        print("<a style='text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> ... </a>");
                        for ($i=$pages_number-6; $i < $pages_number; $i++) {
                            ?>
                            <a href='shop.php?on_page=<?php echo $i; ?>' style='<?php if($i==$page) echo "font-weight: bold; color: red;" ?> text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> <?php echo $i; ?></a>
                            <?php
                        }
                    }
                    ?>
                    <a href='shop.php?on_page=<?php echo $pages_number; ?>' style='<?php if($pages_number==$page) echo "font-weight: bold; color: red;" ?> text-align:center; margin-top: 20px; margin-bottom: 20px; margin-right: 5px;'> <?php echo $pages_number; ?></a>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

</body>
</html>