<?php
require_once("backend/dbconn.php");
session_start();

$customerID = $_SESSION['customerID'];

$error_message = "";

// Check if passwords match
if ($_POST["newPassword"] !== $_POST["newCpassword"]) {
    $_SESSION['errorMessage'] = "Error: Password and Confirm Password do not match.";
    header("Location: account.php");
    exit();
}

// Check if the username already exists
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM customer WHERE username = :newUsername AND customerID != :customerID");
$stmt->bindParam(':newUsername', $_POST["newUsername"]);
$stmt->bindParam(':customerID', $customerID);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result['count'] > 0) {
    $_SESSION['errorMessage'] = "Error: Username already exists.";
    header("Location: account.php");
    exit();
}

// Handle profile image upload
$profile_image = null;

if (isset($_FILES['newProfile']) && $_FILES['newProfile']['error'] === 0) {
    $file_tmp = $_FILES['newProfile']['tmp_name'];
    $profile_image = file_get_contents($file_tmp);
}

$updateQuery = "UPDATE customer SET ";

if ($profile_image !== null) {
    $updateQuery .= "profile = :profile_image, ";
}

if (!empty($_POST["newUsername"])) {
    $updateQuery .= "username = :newUsername, ";
}

if (!empty($_POST["newName"])) {
    $updateQuery .= "name = :newName, ";
}

if (!empty($_POST["newAddress"])) {
    $updateQuery .= "address = :newAddress, ";
}

if (!empty($_POST["newPhoneNumber"])) {
    $updateQuery .= "phonenumber = :newPhoneNumber, ";
}

if (!empty($_POST["newPassword"])) {
    $updateQuery .= "password = :newPassword, ";
}

if (!empty($_POST["newCpassword"])) {
    $updateQuery .= "confirmpassword = :newCpassword, ";
}

// Trim the trailing comma and space and append the WHERE clause
$updateQuery = rtrim($updateQuery, ", ") . " WHERE customerID = :customerID";

$stmt = $conn->prepare($updateQuery);

if ($profile_image !== null) {
    $stmt->bindParam(':profile_image', $profile_image, PDO::PARAM_LOB);
}

if (!empty($_POST["newUsername"])) {
    $stmt->bindParam(':newUsername', $_POST["newUsername"], PDO::PARAM_STR);
}

if (!empty($_POST["newName"])) {
    $stmt->bindParam(':newName', $_POST["newName"], PDO::PARAM_STR);
}

if (!empty($_POST["newAddress"])) {
    $stmt->bindParam(':newAddress', $_POST["newAddress"], PDO::PARAM_STR);
}

if (!empty($_POST["newPhoneNumber"])) {
    $stmt->bindParam(':newPhoneNumber', $_POST["newPhoneNumber"], PDO::PARAM_STR);
}

if (!empty($_POST["newPassword"])) {
    $stmt->bindParam(':newPassword', $_POST["newPassword"], PDO::PARAM_STR);
}

if (!empty($_POST["newCpassword"])) {
    $stmt->bindParam(':newCpassword', $_POST["newCpassword"], PDO::PARAM_STR);
}

$stmt->bindParam(':customerID', $customerID, PDO::PARAM_INT);
if ($stmt->execute()) {
    $_SESSION['successMessage'] = "Changes saved successfully!";
    header("Location: account.php");
    exit();
} else {
    $_SESSION['errorMessage'] = "Error updating customer information: " . $stmt->errorInfo()[2];
    header("Location: account.php");
    exit();
}
?>