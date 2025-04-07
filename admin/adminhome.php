<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MJCoffee: Admin Operation</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="../style/adminDesign.css">
  <link rel="stylesheet" href="../style/adminTableDesign.css">
  <script defer src="active_link.js"></script>

</head>

<body>
  <?php
  include('adminNavbar.php')

  ?>
  <br><br><br><br><br>
  <center>
    <h1 style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 35px; color: #9A4444;">DASHBOARD </h1>
  </center>
  <br>


  <?php 
  require('../backend/dbconn.php');  

  $stmt = $conn->prepare("SELECT COUNT(*) as count FROM customer");
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  $count = $result['count'];
  ?>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-person" style="color: #9A4444; font-size: 30px;"></i>USERS</h6>
            <?php echo $count; ?>
          </div>
        </div>
      </div>

      <?php
      require('../backend/dbconn.php');

      $stmt = $conn->prepare("SELECT COUNT(*) as count FROM fooditem");
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $result['count'];
      ?>

      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-archive-fill" style="color: #9A4444; font-size: 30px;"></i> PRODUCTS</h6>
            <?php echo $count; ?>
          </div>
        </div>
      </div>

      <?php
      require('../backend/dbconn.php');

      $stmt = $conn->prepare("SELECT COUNT(*) as count FROM ordersummary");
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $count = $result['count'];

      ?>

      <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
        <div class="card">
          <div class="card-body text-center">
            <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-basket" style="color: #9A4444; font-size: 30px;"></i> ORDERS</h6>
            <?php echo $count;  ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <br><br>

  <div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 30px; color: #9A4444; margin-bottom: 20px;">USERS </h1>
    <div class="row">
      <section class="intro">
        <div class="bg-image h-100" style="background-color: transparent;">
          <div class="mask d-flex align-items-center h-100">
            <div class="container">
              <div class="row justify-content-center">
                <div class="table-responsive">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 490px">
                          <a href="managecustomer.php" style="text-decoration: none; color: black;font-weight:normal;">
                            <table class="table table-striped mb-0">
                              <thead style="background-color: #9A4444;">
                                <tr>
                                  <center>
                                    <th class="text-center" scope="col">Username</th>
                                    <th class="text-center" scope="col">Phone Number</th>
                                    <th class="text-center" scope="col">Address</th>
                                    <th class="text-center" scope="col">Role</th>
                                    <th class="text-center" scope="col">Name</th>
                                  </center>
                                  </th>
                              </thead>
                              <tbody>
                                <?php
                                require_once('../backend/dbconn.php');
                                try {
                                  $stmt = $conn->prepare("SELECT * FROM customer");
                                  $stmt->execute();
                                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                      <td class="text-center"> <?php echo $row['username']; ?></td>
                                      <td class="text-center"> <?php echo $row['phonenumber']; ?></td>
                                      <td class="text-center"> <?php echo $row['address']; ?></td>
                                      <td class="text-center"> <?php echo $row['role']; ?></td>
                                      <td class="text-center"> <?php echo $row['name']; ?></td>
                                    </tr>
                                <?php
                                  }
                                } catch (PDOException $e) {
                                  echo "ERROR: " . $e->getMessage();
                                }

                                $conn = null;
                                ?>
                            </table>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <br><br>

  <div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 30px; color: #9A4444; margin-bottom: 20px;">MENU & DRINKS </h1>
    <div class="row">
      <section class="intro">
        <div class="bg-image h-100" style="background-color: transparent;">
          <div class="mask d-flex align-items-center h-100">
            <div class="container">
              <div class="row justify-content-center">
                <div class="table-responsive">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 490px">
                          <a href="manageproduct.php" style="text-decoration: none; color: black;font-weight:normal;">
                            <table class="table table-striped mb-0">
                              <thead style="background-color: #9A4444;">
                                <tr>
                                  <center>
                                    <th class="text-center" scope="col">Menu</th>
                                    <th class="text-center" scope="col">Food Name</th>
                                    <th class="text-center" scope="col">Price</th>
                                    <th class="text-center" scope="col">Category</th>
                                    <th class="text-center" scope="col">Availability</th>
                                  </center>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                require('../backend/dbconn.php');
                                try {
                                  $stmt = $conn->prepare("SELECT * FROM fooditem");
                                  $stmt->execute();
                                  foreach ($stmt->fetchAll() as $row) {
                                ?>
                                    <tr>
                                      <td>

                                        <?php
                                        // output the image as data URI
                                        $img_data = base64_encode($row['menuprofile']);
                                        $img_type = 'image/jpeg'; // replace with the appropriate image type
                                        ?>

                                        <img src="data:<?php echo $img_type; ?>;base64,<?php echo $img_data; ?>" width="200" height="200">

                                      </td>
                                      <td class="text-center"><?php echo $row['menuname']; ?></td>
                                      <td class="text-center"><?php echo $row['menuprice']; ?></td>
                                      <td class="text-center"><?php echo $row['menutype']; ?></td>
                                      <td class="text-center"><?php echo $row['availability']; ?></td>
                                    </tr>
                              </tbody>
                          <?php
                                  }
                                } catch (PDOException $e) {
                                  echo "ERROR: " . $e->getMessage();
                                }
                                $conn = null;
                          ?>
                            </table>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
  <br><br>

  <div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-weight: bold; font-size: 30px; color:#9A4444; margin-bottom: 20px;">ORDER HISTORY </h1>
    <div class="row">
      <section class="intro">
        <div class="bg-image h-100" style="background-color: transparent">
          <div class="mask d-flex align-items-center h-100">
            <div class="container">
              <div class="row justify-content-center">
                <div class="table-responsive">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body p-0">
                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 490px">
                          <a href="admincustomerorder.php" style="text-decoration: none; color: black;font-weight:normal;">
                            <table class="table table-striped mb-0">
                              <thead style="background-color:  #9A4444;">
                                <tr>
                                  <center>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Order ID</th>
                                    <th class="text-center">Total Price</th>
                                    <th class="text-center">Status</th>
                                  </center>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                require('../backend/dbconn.php');
                                try {
                                  $stmt = $conn->prepare("SELECT * FROM ordersummary");
                                  $stmt->execute();
                                  foreach ($stmt->fetchAll() as $row) {

                                    $status_color = '';
                                    if ($row['status'] == 'On Progress') {
                                      $status_color = 'orange';
                                    } elseif ($row['status'] == 'cancelled') {
                                      $status_color = 'red';
                                    } elseif ($row['status'] == 'Delivered') {
                                      $status_color = 'Blue';
                                    } elseif ($row['status'] == 'Pending') {
                                      $status_color = 'Green';
                                    }

                                ?>
                                    <tr>
                                      <td class="text-center"><?php echo $row['orderdate']; ?></td>
                                      <td class="text-center"><?php echo $row['orderID']; ?></td>
                                      <td class="text-center"><?php echo $row['totalprice']; ?></td>
                                      <td class="text-center">
                                        <span style="color: <?php echo $status_color; ?>; font-weight: bold;"><?php echo $row['status']; ?></span>
                                      </td>
                                    </tr>
                              </tbody>
                          <?php
                                  }
                                } catch (PDOException $e) {
                                  echo "ERROR: " . $e->getMessage();
                                }
                                $conn = null;
                          ?>
                            </table>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div><br><br><br>
</body>

</html>