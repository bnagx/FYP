<!--ID : 2020052_BSE -->
<!--Name : WAN HAO XIN   -->
<!--Topic : Final Year Project Codes-->






<?php
include 'config/session.php';
include 'config/navbar.php';
include 'config/database.php';
?>

<head>
    <title>Home</title>
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

        .container {
            padding: 50px;
        }

        .twotable {
            display: flex;
            flex-direction: column;
        }

        .table {
            background-color: blue;
        }
    </style>






</head>



<div class="container">
    <?php

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $query = 'SELECT first_name, last_name from customer WHERE email= ?';
    } else {
        $query = 'SELECT first_name, last_name  FROM customer WHERE username=?';
    }

    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $_SESSION['username']);
    $stmt->execute();
    $numCustomer = $stmt->rowCount();
    if ($numCustomer > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
    }

    $qOrder = 'SELECT * FROM order_summary';
    $stmtOrder = $con->prepare($qOrder);
    $stmtOrder->execute();
    $totalOrder = $stmtOrder->rowCount();

    $qCustomer = 'SELECT * FROM customer';
    $stmtOrder = $con->prepare($qCustomer);
    $stmtOrder->execute();
    $totalCustomer = $stmtOrder->rowCount();

    $qProducts = 'SELECT * FROM products';
    $stmtOrder = $con->prepare($qProducts);
    $stmtOrder->execute();
    $totalProduct = $stmtOrder->rowCount();

    $qLastOrder = 'SELECT * FROM order_summary ORDER BY order_id DESC LIMIT 1';
    $stmtLastOrder = $con->prepare($qLastOrder);
    $stmtLastOrder->execute();
    $lastOrder = $stmtLastOrder->rowCount();



    ?>

    <div class="page-header">
        <h2>Welcome! <?php echo $first_name, $last_name; ?> to the Inventory System</h2>
    </div>

    <div class="twotable">


        <div>
            <table class="table table-responsive">
                <tr>
                    <td class="table-light">Current Total Order:</td>
                    <td class="table-light"><?php echo $totalOrder ?></td>
                </tr>
                <tr>
                    <td class="table-light">Current Total Customer:</td>
                    <td class="table-light "><?php echo $totalCustomer ?></td>
                </tr>
                <tr>
                    <td class="table-light">Current Total Products:</td>
                    <td class="table-light "><?php echo $totalProduct ?></td>
                </tr>
            </table>
        </div>
        <!-- <div>
            <h3>Last Order</h3>
            <?php
            if ($lastOrder > 0) {
                while ($rowLast = $stmtLastOrder->fetch(PDO::FETCH_ASSOC)) {
                    extract($rowLast);
                    $order_id = $rowLast['order_id'];
                    $ordercreate = $rowLast['order_date'];


                    echo "<table class='table table-responsive table-info'>";
                    echo "<tr>";
                    echo "<td>Order ID</td><td class='text-center '>" . $order_id . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>Order Create Date</td><td class='text-center'>" . $ordercreate . "</td>";
                    echo "</tr>";
                    echo "</table>";
                }
            }
            ?>
        </div> -->

        <div>




        </div>



    </div>



</div>








<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>