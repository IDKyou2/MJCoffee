<?php
session_start();
require_once('backend/dbconn.php');

if (!isset($_SESSION['username'])) {
    echo "Error: Not logged in.";
    exit();
}

try {
    $username = $_SESSION['username'];

    $stmt1 = $conn->prepare("SELECT customerID FROM customer WHERE username = :username");
    $stmt1->bindParam(':username', $username);
    $stmt1->execute();
    $customer = $stmt1->fetch(PDO::FETCH_ASSOC);

    if (!$customer) {
        echo "Error: Could not find user.";
        exit();
    }

    $customerID = $customer['customerID'];

    $stmtCheck = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE customerID = :customerID");
    $stmtCheck->bindParam(':customerID', $customerID);
    $stmtCheck->execute();
    $count = $stmtCheck->fetch(PDO::FETCH_ASSOC)['count'];

    if ($count == 0) {
        $_SESSION['cart_message'] = "empty";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $sql = "DELETE FROM cart WHERE customerID = :customerID";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bindParam(':customerID', $customerID);
        $stmt2->execute();
        $_SESSION['cart_message'] = "items_deleted";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
} finally {
    $conn = null;
}
