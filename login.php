<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJCoffee - Welcome customer!</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <script type="text/javascript"
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link rel="Icon" href="image/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="style/login.css">
</head>

<body>
    <?php require("navbar.php"); ?>
    <br><br><br><br>
    <?php
    if (isset($_SESSION['alertMessage'])) {
        $message = $_SESSION['alertMessage'];
        $type = $_SESSION['alertType'];

        $redirect = isset($_SESSION['redirect']) ? $_SESSION['redirect'] : "login.php";

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '$type',
                    title: '<strong>$message</strong>',
                    showCloseButton: true, 
                    focusConfirm: false, 
                    confirmButtonText: 'Continue', 
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    timer: 2000
                }).then(function() {
                    window.location.href = '$redirect';
                });
            });
          </script>";

        // Unset the session variables
        unset($_SESSION['alertMessage']);
        unset($_SESSION['alertType']);
        unset($_SESSION['redirect']);
    }
    ?>

    <section class="loginSection" id="loginSection">
        <div class="container loginContainer">
            <div class="row">
                <div class="col-xl-10">
                    <div class="card-body p-md-5 mx-md-4 custom-card-width loginCard">
                        <div class="text-center">
                            <p class="nav"
                                style="display: inline-block; margin: 0; vertical-align: middle; font-size:28px;">
                                Login your account</p>
                        </div>
                        <form action="customer_login.php" method="post">
                            <div class="outer">
                                <input type="text" id="form2Example11" class="form-control" name="username"
                                    placeholder="Username" required />
                            </div>
                            <div class="outer">
                                <input type="password" id="form2Example22" class="form-control" name="password"
                                    placeholder="Password" required />
                            </div>
                            <div class="text-center pt-1 mb-2 mt-2 pb-1">
                                <button class="loginBtn" type="submit" value="Login" name="login">Login</button>
                            </div>
                            <div class="createAccount">
                                <p class="text-center" style="font-size:15px; margin-top:15px;">Don't have an account
                                    yet?&nbsp<a href="dashboard.php#sec4">Create an Account </a></p>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section><br>




</body>

</html>