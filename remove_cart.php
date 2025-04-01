<?php
session_start();
require_once('backend/dbconn.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['fooditemID'], $_GET['customerID'], $_GET['quantity'])) {
    $fooditemID = $_GET['fooditemID'];
    $customerID = $_GET['customerID'];
    $quantity = $_GET['quantity'];

    try {
        // Delete the specific item from the cart
        $deleteQuery = "DELETE FROM cart WHERE fooditemID = :fooditemID AND customerID = :customerID AND quantity = :quantity LIMIT 1";
        $deleteStmt = $conn->prepare($deleteQuery);
        $deleteStmt->bindParam(':fooditemID', $fooditemID);
        $deleteStmt->bindParam(':customerID', $customerID);
        $deleteStmt->bindParam(':quantity', $quantity);
        $deleteStmt->execute();

        if ($deleteStmt->rowCount() > 0) {
            $_SESSION['cart-message'] = "item_deleted";
        } else {
            $_SESSION['cart-message'] = "item_not_found";
        }

        header('Location: cart.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['cart_message'] = "database_error";
        header('Location: cart.php');
        exit();
    } finally {
        $conn = null;
    }
} else {
    header('Location: cart.php');
    exit();
}
