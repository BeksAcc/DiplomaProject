<?php

    // Define variables and initialize with empty values
    $name = $surname = $phone_num = $username = $password = $confirm_password = "";
    $name_err = $surname_err = $phone_num_err = $username_err = $password_err = $confirm_password_err = "";


    $connection = mysqli_connect('localhost','root','','mobile+');
    if ($connection==false){
        echo "Ошибка! Не удалось соедениться с базой данных!";
        exit();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        // Name Validate
        if(empty(trim($_POST["first_name"]))){
            $name_err = "Please enter a name.";
        } else{
            $name = trim($_POST["first_name"]);
        }

        // Surname validate
        if(empty(trim($_POST["last_name"]))){
            $surname_err = "Please enter a surname.";
        } else{
            $surname = trim($_POST["last_name"]);
        }

        // Phone number validate
        if(empty(trim($_POST["phone"]))){
            $phone_num_err = "Please enter a Phone number.";
        } else{
            $phone_num = trim($_POST["phone"]);
        }

        // Validate email
        if(empty(trim($_POST["email"]))){
            $username_err = "Please enter a email.";
        } else{
            // Prepare a select statement
            $sql = "SELECT * FROM user WHERE email = '". $_POST["email"] ."'";
            $email_check = mysqli_query($connection, $sql);
            if (mysqli_num_rows($email_check) != 0) {
                $username_err = "This email is already used.";
            }
            else{
                $username = trim($_POST["email"]);
            }
        }

        // Validate password
        if(empty(trim($_POST["passw1"]))){
            $password_err = "Please enter a password.";
        } elseif(strlen(trim($_POST["passw1"])) < 8){
            $password_err = "Password must have at least 8 characters.";
        } else{
            $password = trim($_POST["passw1"]);
        }

        // Validate confirm password
        if(empty(trim($_POST["passw2"]))){
            $confirm_password_err = "Please confirm password.";
        } else{
            if(trim($_POST["passw1"]) != trim($_POST["passw2"])){
                $confirm_password_err = "Password did not match.";
            }
            else{
                $confirm_password = trim($_POST["passw2"]);
            }
        }

        // Register process
        if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($surname_err) && empty($phone_num_err)){
            // Prepare an insert statement
            $sql = "INSERT INTO user (email, password, status) VALUES ('$username', '$password', 'User')";
            $sql2 = "INSERT INTO customer (email, first_name, last_name, phone) VALUES ('$username', '$name', '$surname','$phone_num')";
            if(mysqli_query($connection,$sql) && mysqli_query($connection,$sql2)){
                session_start();
                $_SESSION["loggedin"] = true;
                $_SESSION["email"] = $username;
                // Redirect user to welcome page
                header("location: index.php");
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
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

<div class="auth">
    <div class="auth__title">
        <h2>Registration Form</h2>
    </div>
    <div class="auth__body">
        <form action = "<?php $_PHP_SELF ?>" method="POST">
            <div class="auth__body__row">
                <div class="auth__body__row__col">Name</div>
                <div class="auth__body__row__col">
                    <input class="input__md" placeholder="First Name" type="text" name="first_name">
                </div>
                <div class="auth__body__row__col">
                    <input class="input__md" placeholder="Last Name" type="text" name="last_name">
                </div>
            </div>
            <div class="auth__body__row">
                <div class="auth__body__row__col">Password</div>
                <div class="auth__body__row__col">
                    <input class="input__md" placeholder="Password" type="password" name="passw1">
                </div>
                <div class="auth__body__row__col">
                    <input class="input__md" placeholder="Re-enter password" type="password" name="passw2">
                </div>
            </div>
            <div class="auth__body__row">
                <div class="auth__body__row__col">Email</div>
                <div class="auth__body__row__col">
                    <input type="text" placeholder="E-Mail" name="email">
                </div>
            </div>
            <div class="auth__body__row">
                <div class="auth__body__row__col">Phone</div>
                <div class="auth__body__row__col">
                    <input class="" type="text" placeholder="Phone Number" name="phone">
                </div>
            </div>
            <div class="auth__body__row">
                <div class="auth__body__row__btn">
                    <button type="submit">Register</button>
                </div>
            </div>
            <p>Already registered? <a href="login.php">Login now</a>.</p>
        </form>
    </div>
</div>
</body>
</html>