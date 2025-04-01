<?php
session_start();
require_once('backend/dbconn.php');

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['fooditemID'], $_POST['customerID'], $_POST['quantity'])) {

    try {
        $fooditemID = $_POST['fooditemID'];
        $customerID = $_SESSION['customerID'];
        $quantity = $_POST['quantity'];

        if ($quantity < 1 || $quantity > 50) {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=Invalid quantity');
            exit();
        }

        $sql = "UPDATE cart SET quantity = :quantity WHERE fooditemID = :fooditemID AND customerID = :customerID";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':fooditemID', $fooditemID, PDO::PARAM_INT);
        $stmt->bindParam(':customerID', $customerID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['update_success'] = true;
        } else {
            $_SESSION['update_success'] = false;
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();

    } catch(PDOException $e) {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=Database error: ' . $e->getMessage());
    } finally {
        $conn = null; 
    }

} else {
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?error=Required data not provided.');
    exit();
}
?>
