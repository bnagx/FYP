<!--ID : 2020052_BSE -->
<!--Name : WAN HAO XIN   -->
<!--Topic : Final Year Project Codes-->




<?php

session_start();

?>

<!DOCTYPE HTML>
<html>


<head>
    <title>Login</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">




    <style>
        body {
            font-family: 'Mochiy Pop One', sans-serif;
        }

        .indexpg {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loginbg {
            background-color: #D3D3D3;
            display: flex;
            align-items: center;
        }

        .title {
            color: purple;
            font-family: verdana;
        }

        .loginbg {
            color: blue;
        }
    </style>


</head>

<body>

    <!-- container -->
    <div class="indexpg container vh-100">

        <?php


        if ($_POST) {

            // include database connection
            include 'config/database.php';


            $flag = 0;
            $message = '';


            if (empty($_POST['username'])) {
                $flag = 1;
                $message = "Please insert your username. <br>";
            }
            if (empty($_POST['password'])) {
                $flag = 1;
                $message = $message . "Please insert password";
            }

            if ($flag == 0) {
                $username = $_POST['username'];
                if (filter_var("$username", FILTER_VALIDATE_EMAIL)) {
                    $query = 'SELECT username, email, password, accountstatus from admin WHERE email=?';
                } else {
                    $query = 'SELECT username, email, password, accountstatus from admin WHERE username=?';
                }


                $stmt = $con->prepare($query);
                $stmt->bindParam(1, $username);
                $stmt->execute();
                $num = $stmt->rowCount();

                if ($num > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (md5($_POST['password']) == $row['password']) {
                        if ($row['accountstatus'] == 'Active') {
                            $_SESSION['username'] = $username;
                            header("Location:home.php");
                        } else {
                            $flag = 1;
                            $message = 'Please tell admin to activate your account.';
                        }
                    } else {
                        $flag = 1;
                        $message = 'Your password is incorrect';
                    }
                } else {
                    $flag = 1;
                    $message = 'Username is not exists.';
                }
            }
        }

        ?>
        <div class="wrapper">

        </div>

        <div class="loginbg text-center  ">

            <div class="col-lg-6 mb-5 mb-lg-0">
                <h2 class=" fw-bold ls-tight">
                    Inventory System for Online Small Business
                </h2>
                <p style="color: hsl(217, 10%, 50.8%)">
                    This is an Inventory System for everyone who want to start a online business
                </p>
            </div>
            <div class="container w-50 w-md-25">
                <?php
                if (isset($_GET['msg']) && $_GET['msg'] == 'logout') {
                    echo "<div class='alert alert-success'>Logout Successful</div>";
                }
                if (isset($_GET['msg']) && $_GET['msg'] == 'loginerr') {
                    echo "<div class='alert alert-danger'>Unable to access. Please Login.</div>";
                }
                if (isset($flag) && $flag == 1) {
                    echo "<div class='alert alert-danger'>$message</div>";
                }
                if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
                    echo "<div class='alert alert-success'>Account Created Successfully. Please Log In.</div>";
                }
                ?>


                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control ">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Login">
                    </div>

                    <a href="customer_create.php">Sign up now</a>

                </form>

            </div>

        </div>


    </div> <!-- end .container -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>