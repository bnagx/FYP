<!--ID : 2020052_BSE -->
<!--Name : WAN HAO XIN   -->
<!--Topic : Final Year Project Codes-->

<?php
// this is to show navbar if the user have login, else no navbar
session_start();
if (isset($_SESSION['username'])) {
    include 'config/navbar.php';
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Create Customer</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+One&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Mochiy Pop One', sans-serif;
        }

        .table2 {
            padding: 80px;
        }
    </style>


</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <h1>Create Customer</h1>
        </div>

        <?php


        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // insert query
                $query = "INSERT INTO customer 
                SET username=:username, email=:email, first_name=:first_name, last_name=:last_name";
                // prepare query for execution
                $stmt = $con->prepare($query);
                $username = $_POST['username'];
                $email = $_POST['email'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);


                // this is to validate if user enter the message or not, if not pop out error message
                $flag = 0;

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    if (empty($_POST["username"])) {
                        $flag = 1;
                        $usernameErr = "Name is required";
                    }

                    if (empty($_POST["email"])) {
                        $flag = 1;
                        $emailErr = "Email is required";
                    }

                    if (empty($_POST["first_name"])) {
                        $flag = 1;
                        $first_nameErr = "First Name is required";
                    }

                    if (empty($_POST["last_name"])) {
                        $flag = 1;
                        $last_nameErr = "Last Name is required";
                    }
                }
                if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["first_name"]) || empty($_POST["last_name"])) {
                    $flag = 1;
                    $message = "Please fill in every field";
                } elseif (!preg_match("/[a-zA-Z0-9]{3,}/", $username)) {
                    $flag = 1;
                    $message = "Username must be at least 6 characters";
                }

                if ($flag == 0) {

                    $select_query_username = 'SELECT username, email FROM customer WHERE username=?';
                    $select_stmt_username = $con->prepare($select_query_username);
                    $select_stmt_username->bindParam(1, $username);
                    $select_stmt_username->execute();
                    $row_username = $select_stmt_username->fetch(PDO::FETCH_ASSOC);
                    if ($row_username) {
                        if ($_POST['username'] == $row_username['username']) {
                            $flag = 1;
                            $message = "This username is already used by another user";
                        }
                    }

                    $select_query_email = 'SELECT username, email FROM customer WHERE email=?';
                    $select_stmt_email = $con->prepare($select_query_email);
                    $select_stmt_email->bindParam(1, $email);
                    $select_stmt_email->execute();
                    $row_email = $select_stmt_email->fetch(PDO::FETCH_ASSOC);
                    if ($row_email) {
                        if ($_POST['email'] == $row_email['email']) {
                            $flag = 1;
                            $message = "This email is already used by another user";
                        }
                    }
                }

                if ($flag !== 0) {
                    echo "<div class='alert alert-danger'>";
                    echo $message;
                    echo "</div>";
                } else {
                    if ($stmt->execute()) {
                        if (isset($_SESSION['username'])) {
                            echo "<script>location.replace('customer_read_one.php?id=" . $username . "&msg=cus_createSuccess')</script>";
                        } else {
                            echo "<script>location.replace('index.php?msg=success')</script>";
                        }
                    } else {
                        echo "Unable to save record.";
                    }
                }
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }

        ?>

        <!-- html form here where the customer information will be entered -->
        <div class="table2">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
                <table class='table table-hover table-responsive table-bordered'>

                    <tr>
                        <td>Username<span class="text-danger">*</span></td>
                        <td><input type='text' name='username' class='form-control' value="<?php echo $_POST ? $_POST['username'] : ''; ?>" />
                            <!-- Span is use to show error message when it is empty(refer to error on top) -->
                            <span>
                                <?php if (isset($usernameErr)) echo "<div class='text-danger'>*$usernameErr</div>  "; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Email<span class="text-danger">*</span></td>
                        <td><input type='email' name='email' class='form-control' value="<?php echo $_POST ? $_POST['email'] : ''; ?>" />
                            <span>
                                <?php if (isset($emailErr)) echo "<div class='text-danger'>*$emailErr</div>  "; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>First Name<span class="text-danger">*</span></td>
                        <td><input type="text" name='first_name' class='form-control' value="<?php echo $_POST ? $_POST['first_name'] : ''; ?>" />
                            <span>
                                <?php if (isset($first_nameErr)) echo "<div class='text-danger'>*$first_nameErr</div>  "; ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Last Name<span class="text-danger">*</span></td>
                        <td><input type="text" name='last_name' class='form-control' value="<?php echo $_POST ? $_POST['last_name'] : ''; ?>" />
                            <span>
                                <?php if (isset($last_nameErr)) echo "<div class='text-danger'>*$last_nameErr</div>  "; ?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type='submit' value='Sign Up' class='btn btn-primary' />
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo "<a href='customer_read.php' class='btn btn-danger'>Back to Customer List</a>";
                            } else {
                                echo "<a href='index.php' class='btn btn-danger'>Back to Login Page</a>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>