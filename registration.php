<?php
require_once('backend/dbconn.php');

$username = $_POST['username'];
$address = $_POST['address'];
$phonenumber = $_POST['phonenumber'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
$name = $_POST['name'];
$role = "customer";

$errors = array();

if (strlen($password) < 8) {
    $errors[] = "Password must be at least 9 characters long.";
}

if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "Password must contain at least 1 uppercase letter.";
}

if (!preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
    $errors[] = "Password must contain at least 1 alphanumeric character and 1 special character.";
}

if ($password !== $confirmpassword) {
    $errors[] = "Password and confirm password fields do not match.";
}
if (!preg_match('/^09[0-9]{9}$/', $phonenumber)) {
    $errors[] = "Invalid Mobile Number Format";
}

// Check if username already exists
$sql = "SELECT * FROM customer WHERE username=:username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $errors[] = "Username already exists. Please choose a different one.";
}

$default_profile_picture_path = 'image/Pfp.jpg';
$profile = file_get_contents($default_profile_picture_path);

if (empty($errors)) {
    try {
        $sql = "INSERT INTO customer(username, phonenumber, address, role, password, confirmpassword, profile, name) 
        VALUES (:username, :phonenumber, :address, :role, :password, :confirmpassword, :profile, :name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':phonenumber', $phonenumber, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':confirmpassword', $password, PDO::PARAM_STR);
        $stmt->bindParam(':profile', $profile, PDO::PARAM_LOB);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        echo "<script>alert('Sign Up Successful!');window.location.href='login.php'</script>";
    } catch (PDOException $e) {
        $errors[] = "ERROR: " . $e->getMessage();
    }
}

$conn = null;
?>
<?php if (!empty($errors)) : ?>
    <div class="error">
        <?php foreach ($errors as $error) : ?>
            <script>
                alert('<?php echo $error; ?>');
                window.location.href = 'ddashboard.php#sec4'
            </script>
        <?php endforeach; ?>
    </div>
<?php endif; ?>