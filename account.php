<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstage Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
    <link rel="stylesheet" href="style/accountt.css">

</head>

<body>

    <?php
    include("navbar.php");
    require_once("backend/dbconn.php");

    // Ensure you are using the correct session variable name without the '$'
    $customerID = $_SESSION['customerID'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM customer WHERE customerID=:customerID");
    $stmt->bindParam(':customerID', $customerID, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch a single row, assuming customerID is unique
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $username = $user['username'];
        $name = $user['name'];
        $address = $user['address'];
        $phoneNumber = $user['phonenumber'];
        // You can retrieve the profile image as a BLOB from the $user as well.
        // Assuming your database column for the image is named 'profile'.
        $profileImage = $user['profile'];
    } else {
        echo "No customer found with the given ID.";
    }
    ?>


    <section class="h-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black custom-card-width">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <p class="alt"><i class="bi bi-person"></i> Profile</p>
                            </div>
                            <center style="margin-top: 5px; margin-bottom: 20px;">
                                <!-- Display the profile image -->
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($profileImage); ?>" alt="profile" class="profile_img">
                            </center>
                            <form>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example11">Username</label>
                                    <input type="text" id="form2Example11" class="form-control" value="<?php echo $username; ?>" style="border: black 1px solid;" readonly />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example11">Name</label>
                                    <input type="text" id="form2Example11" class="form-control" value="<?php echo $name; ?>" style="border: black 1px solid;" readonly />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example22">Address</label>
                                    <input type="text" id="form2Example22" class="form-control" value="<?php echo $address; ?>" style="border: black 1px solid;" readonly />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form2Example22">Contact Number</label>
                                    <input type="text" id="form2Example22" class="form-control" value="<?php echo $phoneNumber; ?>" style="border: black 1px solid;" readonly />
                                </div>

                                <center>
                                    <button class="edit_btn" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit <i class="bi bi-pen" style="font-size: 15px; margin-right: 5px;"></i></button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>

    <?php
    include("footer.php")
    ?>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_profile.php" method="post" enctype="multipart/form-data">
                        <!-- Add enctype="multipart/form-data" for file upload -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="newProfile">New Profile</label>
                            <input type="file" id="newProfile" name="newProfile" class="form-control" style="border: black 1px solid;" accept="image/*" />
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="newUsername">New Username</label>
                            <input type="text" id="newUsername" name="newUsername" class="form-control" placeholder="New Username" style="border: black 1px solid;" />
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="newUsername">New Name</label>
                            <input type="text" id="newName" name="newName" class="form-control" placeholder="New Username" style="border: black 1px solid;" />
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="form2Example11">New Address</label>
                            <input type="text" name="newAddress" id="form2Example11" class="form-control" placeholder="Legit Address" style="border: black 1px solid;" />
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="form2Example11">New contact Number</label>
                            <input type="text" name="newPhoneNumber" id="form2Example11" class="form-control" placeholder="Ex 0945211778" style="border: black 1px solid;" />
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="form2Example11">New Password</label>
                            <input type="text" name="newPassword" id="form2Example11" class="form-control" style="border: black 1px solid;" />
                        </div>

                        <div class="form-outline mb-3">
                            <label class="form-label" for="form2Example11">Confirm Password</label>
                            <input type="text" name="newCpassword" id="form2Example11" class="form-control" style="border: black 1px solid;" />
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="approved_btn">Save Changes</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Start the session if it hasn't been started yet
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if an error message exists and display it via SweetAlert
    if (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage']) {
        $errorMessage = $_SESSION['errorMessage'];
        unset($_SESSION['errorMessage']);
    ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '<?php echo $errorMessage; ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            });
        </script>

    <?php
    }

    if (isset($_SESSION['successMessage']) && $_SESSION['successMessage']) {
        $successMessage = $_SESSION['successMessage'];
        unset($_SESSION['successMessage']);
    ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?php echo $successMessage; ?>',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                });
            });
        </script>

    <?php
    }
    ?>


</body>

</html>