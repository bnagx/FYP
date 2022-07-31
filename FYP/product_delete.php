<!--ID : 2020052_BSE -->
<!--Name : WAN HAO XIN   -->
<!--Topic : Final Year Project Codes-->





<?php
// include database connection
include 'config/database.php';
try {
    // get record ID
    // isset() is a PHP function used to verify if a value is there or not
    $qconfirm = 'SELECT products.product_id, order_details.product_id FROM products INNER JOIN order_details ON order_details.product_id = products.product_id WHERE products.product_id=?';
    $stmt = $con->prepare($qconfirm);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $num = $stmt->rowCount();
    echo $num;
    if ($num > 0) {
        header('Location: product_read.php?action=delErr');
    } else {
        // delete query
        $query = "DELETE FROM products WHERE product_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()) {
            // redirect to read records page and
            // tell the user record was deleted
            header('Location: product_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    }


    // $id = isset($_GET['id']) ? $_GET['id'] :  die('ERROR: Record ID not found.');

    // // delete query
    // $query = "DELETE FROM products WHERE product_id = ?";
    // $stmt = $con->prepare($query);
    // $stmt->bindParam(1, $id);

    // if ($stmt->execute()) {
    //     // redirect to read records page and
    //     // tell the user record was deleted
    //     header('Location: product_read.php?action=deleted');
    // } else {
    //     die('Unable to delete record.');
    // }
}





// show error
catch (PDOException $exception) {
    die('ERROR: ' . $exception->getMessage());
}
