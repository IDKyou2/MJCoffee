<?php
require_once 'backend/dbconn.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM customer WHERE username=:username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $get_user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($get_user) {
        if ($password == $get_user['password']) {
            $_SESSION['username'] = $get_user['username'];
            $_SESSION['customerID'] = $get_user['customerID'];
            $_SESSION['alertMessage'] = "Login successful";
            $_SESSION['alertType'] = "success";

            // Check the role of the user and set the redirect session variable
            if ($get_user['role'] == 'admin') {
                $_SESSION['redirect'] = "admin/adminHome.php";
            } else if ($get_user['role'] == 'customer') {
                $_SESSION['redirect'] = "index.php";
            } else {
                $_SESSION['redirect'] = "login.php";
            }

            // Redirect to login.php to display the alert
            header("Location: login.php");
            exit();

        } else {
            $_SESSION['alertMessage'] = "Incorrect password";
            $_SESSION['alertType'] = "error";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['alertMessage'] = "Account does not exist.";
        $_SESSION['alertType'] = "error";
        header("Location: login.php");
        exit();
    }
}
?>
