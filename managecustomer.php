<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Backstage Cafe: Admin Operation</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="navardesign/admindesignn.css">
  <link rel="stylesheet" href="navardesign/tabledesignn.css">
  <script defer src="active_link.js"></script>


</head>

<body>

  <?php
  include('navar/adminnavar.php')
  ?>
  <br><br><br><br><br><br>

  <div class="container">
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
                        <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">
                          <table class="table table-striped mb-0">
                            <thead style="background-color: #9A4444;">
                              <tr>
                                <th class="text-center" scope="col">Username</th>
                                <th class="text-center" scope="col">Phone Number</th>
                                <th class="text-center" scope="col">Address</th>
                                <th class="text-center" scope="col">Role</th>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              require_once('dbconn.php');
                              try {
                                $stmt = $conn->prepare("SELECT * FROM customer");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                                  <tr>
                                    <td class="text-center"> <?php echo $row['name']; ?></td>
                                    <td class="text-center"> <?php echo $row['username']; ?></td>
                                    <td class="text-center"> <?php echo $row['phonenumber']; ?></td>
                                    <td class="text-center"> <?php echo $row['role']; ?></td>
                                    <td class="text-center"> <?php echo $row['address']; ?></td>
                                    <td class="text-center">
                                      <a href="customeredit.php?customerID=<?php echo $row['customerID']; ?>">
                                        <i class="bi bi-pencil-square" style="font-size: 24px; color:#701198;"></i>
                                      </a>
                                    </td>
                                  </tr>
                              <?php
                                }
                              } catch (PDOException $e) {
                                echo "ERROR: " . $e->getMessage();
                              }

                              $conn = null;
                              ?>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
</body>

</html>