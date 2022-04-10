<?php
require "db.php";
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <title><?php echo $config['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/main.css">

</head>
<body>

<div class="container-fluid p-2">
    <div class="top-bar container-xl d-flex bd-highlight border-bottom">
        <div class="p-2 flex-grow-1 bd-highlight">
            <a href="">ENG
                <i class="fa fa-angle-down"></i>
            </a>
        </div>
        <div class="p-2 bd-highlight border-end">
            <i class="me-2 fas fa-phone-alt"></i>
            8 800 555 35 35
        </div>
        <div class="p-2 bd-highlight"><a href="login.php">Sign In</a></div>
    </div>
</div>
<div class="container-fluid">
    <div class="header container-xl d-flex bd-highlight align-items-center">
        <div class="p-2 flex-grow-1 bd-highlight">
            <a class="logo" href="index.php">mobile+</a>
        </div>
        <div class="p-2 bd-highlight d-flex">
            <input type="email" class="form-control shadow-none" id="exampleFormControlInput1" placeholder="Search our catalog">
            <button type="button" class="btn btn-outline-dark"><i class="fas fa-search"></i></button>
        </div>
        <div class="p-2 bd-highlight">
            <a href="">
                <i class="fas fa-shopping-basket"></i>
            </a>
        </div>
    </div>
</div>

<div class="nav container-fluid">
    <div class="nav-links container-xl d-flex bd-highlight align-items-center">
        <div class="p-2 flex-grow-1 bd-highlight">
            <a href="shop.php">Shop</a>
            <?php
                $sql="SELECT brand, count(*) FROM smartphone_details WHERE brand IS NOT NULL GROUP BY brand ORDER BY count(*) DESC LIMIT 5";
                $top_brands = mysqli_query($connection, $sql);

                while ($brand = mysqli_fetch_assoc($top_brands)){
            ?>
            <a href="shop.php?brand=<?php echo $brand['brand']; ?>"><?php echo $brand['brand']; ?></a>
            <?php } ?>
        </div>
    </div>
</div>