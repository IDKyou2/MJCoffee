<?php
require_once('../backend/dbconn.php');
try {
  $sql = "SELECT * FROM customer WHERE customerID = :ad_customerID";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':ad_customerID', $_GET['customerID'], PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "ERROR: " . $e->getMessage();
}
$conn = null;
?>

<!DOCTYPE html>
<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="login/adminlogin.css">
  <title>Admin User Edit</title>
</head>

<body><br>

  <?php
  include("../loader.php");
  ?>


  <div class="container">
    <!--------------------------------------------------- Back button --------------------------------------------------------->
    <div class="row mx-auto">
      <a href="adminManageCustomer.php">
        <button type="button" class="btn" style="width: 200px; background-color: #9A4444; color:white;"><i
            class="bi bi-backspace-fill" style="padding-right: 10px;"></i>Back to Menu</button>
      </a>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 p-4" style="border: 2px solid #9A4444; width: 600px;">
        <h2 style="text-align: center; font-weight: bold; font-size: 25px;">UPDATE USER'S INFORMATION</h2><br>
        <p style="font-size: 25px; font-family: Times New Roman;"><strong>UserName:</strong>
          <?php echo $row['username'] ?>
        </p>
        <form action="adminUpdateCustomer.php" method="get">
          <div class="mb-3">
            <input style="width: 95%; background: white; margin-bottom: 20px;" type="hidden" name="customerID" size="20"
              value="<?php echo $row['customerID']; ?>" readonly>
          </div>


          <div class="mb-3">
            <label for="newlastname">New Name:</label>
            <input style="width: 95%; background: white; margin-bottom: 20px;" type="text" name="newname" size="20"
              value="<?php echo $row['name']; ?>">
          </div>

          <div class="mb-3">
            <label for="newusername">New Username:</label>
            <input onInput="checkUsername()" style="width: 95%; background: white; margin-bottom: 20px;" type="text"
              name="newusername" size="20" id="username" value="<?php echo $row['username']; ?>">
            <p id="check-username"></p>
          </div>

          <div class="mb-3">
            <label for="newaddress">Adress:</label>
            <input style="width: 95%; background: white; margin-bottom: 20px;" type="text" name="newaddress" size="20"
              value="<?php echo $row['address']; ?>">
          </div>

          <div class="mb-3">
            <label for="newrole" class="form-label">Role:</label>
            <select id="newrole" name="newrole" class="form-control">
              <option value="customer" <?php if ($row['role'] == 'customer')
                echo 'selected'; ?>>Customer</option>
              <option value="admin" <?php if ($row['role'] == 'admin')
                echo 'selected'; ?>>Admin</option>
            </select>
          </div>


          <div class="mb-3">
            <label for="newmobilenumber">Phone Number:</label>
            <input style="width: 95%; background: white; margin-bottom: 20px;" type="text" name="newphonenumber"
              size="20" id="newphonenumber" value="<?php echo $row['phonenumber']; ?>" pattern="09\d{9}" maxlength="11"
              required oninput="checkPhoneNumber()">
            <p id="check-mobile-number"></p>
          </div>

          <script>
            function checkPhoneNumber() {
              const input = document.getElementById("newphonenumber");
              const message = document.getElementById("check-Phone-Number");
              const valid = input.checkValidity();
              if (valid) {
                const xhr = new XMLHttpRequest();
                const url = "adminCustomerAvailability.php?PhoneNumber=" + input.value;
                xhr.open("GET", url, true);
                xhr.onload = function () {
                  if (xhr.readyState === 4 && xhr.status === 200) {
                    if (xhr.responseText === "already_used") {
                      message.innerHTML = "<span style='color:red'>Mobile number already in use.</span>";
                    } else {
                      message.innerHTML = "<span style='color:green'>Valid mobile number.</span>";
                    }
                  }
                };
                xhr.send();
              } else {
                message.innerHTML = "<span style='color:red'>Mobile number must start with 09 and have 11 digits.</span>";
              }
            }
          </script>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn" style="background-color: #9A4444; color:white;">Save Changes</button>
          </div>

        </form>
      </div>
    </div><br><br>
  </div>
  <?php
  include('admininsert.php')
    ?>
</body>

</html>