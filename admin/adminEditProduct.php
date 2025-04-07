<?php
require_once('../backend/dbconn.php');

try {
    // Check if fooditemID is set in the URL
    if (isset($_GET['fooditemID'])) {
        $fooditemID = $_GET['fooditemID'];

        // Retrieve the existing food item data from the database
        $stmt = $conn->prepare("SELECT * FROM fooditem WHERE fooditemID = ?");
        $stmt->execute([$fooditemID]);
        $row = $stmt->fetch();

        // Check if the form was submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_title = $_POST['menuname'];
            $product_price = $_POST['menuprice'];
            $product_category = $_POST['menutype'];
            $product_avail = $_POST['availability'];
            $product_image = null;

            // Check if a new image has been uploaded
            if (!empty($_FILES['menuprofile']['name'])) {
                $product_image = file_get_contents($_FILES['menuprofile']['tmp_name']);
            } else {
                // Retrieve the existing product image from the database
                $stmt = $conn->prepare("SELECT menuprofile FROM fooditem WHERE fooditemID = ?");
                $stmt->execute([$fooditemID]);
                $row = $stmt->fetch();
                $product_image = $row['menuprofile'];
            }

            // Update the food item in the database
            $sql = "UPDATE fooditem SET menuname = :menuname, menuprice = :menuprice, menutype = :menutype, availability = :availability, menuprofile = :menuprofile WHERE fooditemID = :fooditemID";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fooditemID', $fooditemID, PDO::PARAM_STR);
            $stmt->bindParam(':menuname', $product_title, PDO::PARAM_STR);
            $stmt->bindParam(':menuprice', $product_price, PDO::PARAM_STR);
            $stmt->bindParam(':menutype', $product_category, PDO::PARAM_STR);
            $stmt->bindParam(':availability', $product_avail, PDO::PARAM_STR);
            $stmt->bindParam(':menuprofile', $product_image, PDO::PARAM_LOB);
            $stmt->execute();

            // Redirect to a success page or wherever you need to go after the update
            header('Location: adminManageProduct.php');
            exit; // Make sure to exit after redirection
        }
    } else {
        // Handle the case where fooditemID is missing in the URL
        echo "Food item ID is missing in the URL.";
    }   
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

$conn = null;
?>
