<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: index.php");
        exit;
    }

    $connection = mysqli_connect('localhost','root','','mobile+');
    if ($connection==false){
        echo "Ошибка! Не удалось соедениться с базой данных!";
        exit();
    }
    //require_once "../includes/db.php";

    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if username is empty
        if(empty(trim($_POST["email"]))){
            $username_err = "Please enter username.";
        } else{
            $username = trim($_POST["email"]);
        }

        // Check if password is empty
        if(empty(trim($_POST["passw1"]))){
            $password_err = "Please enter your password.";
        } else{
            $password = trim($_POST["passw1"]);
        }

        //
        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT * FROM user WHERE email = '$username'";
            $login_query = mysqli_query($connection, $sql);
            if (mysqli_num_rows($login_query) != 0) {
                $user = mysqli_fetch_assoc($login_query);
                if($password==$user["password"]){
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["email"] = $email;
                    // Redirect user to welcome page
                    header("location: index.php");
                }
                else{
                    $login_err = "Invalid username or password.";
                }
            }
            else{
                $login_err = "Invalid username or password.";
            }
        }
    }
    require "includes/header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Mobile Store</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://unpkg.com/swiper/swiper-bundle.min.css"/>

</head>
<body>
<div class="auth auth__login">
    <div class="auth__title">
        <h2>Login Form</h2>
    </div>
    <div class="auth__body">
        <form action = "<?php $_PHP_SELF ?>" method="POST">
            <?php
                if(!empty($login_err)){
                    echo '<p style="color:red; margin-left: 3px">' . $login_err . '</p>';
                }
            ?>
            <p style="color:red; margin-left: 3px"><?php echo $username_err; ?></p>
            <div class="auth__body__row ">
                <div class="auth__body__row__col">Email</div>
                <div class="auth__body__row__col">
                    <input class="input__md" placeholder="E-Mail" type="text" name="email" value="<?php echo $_POST["email"] ?>">
                </div>
            </div>
            <p style="color:red; margin-left: 3px"><?php echo $password_err; ?></p>
            <div class="auth__body__row">
                <div class="auth__body__row__col">Password</div>
                <div class="auth__body__row__col">
                    <input class="input__md" placeholder="Password" type="password" name="passw1">
                </div>
            </div>

            <div class="auth__body__row">
                <div class="auth__body__row__btn">
                    <button type="submit">Login</button>
                </div>
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</div>
</body>
</html>