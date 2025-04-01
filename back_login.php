<?php
   session_start();

   require_once 'dbconn.php';

   // Check if the login form was submitted
    if(isset($_POST['login'])) {
    
    // Get the username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare and execute the SQL query to check if the username and password match
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=:username AND password=:password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    // Check if a row was returned from the query
    if($stmt->rowCount() > 0) {
        // Username and password match, redirect to adminhome.php
        header("Location: adminhome.php");
        exit();
    } else {
        // Username and password do not match, show an error message
        echo "<script>alert('Invalid username or password')</script>
        <script>window.location = 'index.php'</script>";
    }
}
?>

