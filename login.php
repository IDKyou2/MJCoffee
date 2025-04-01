<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstage Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="style/loginn.css">
</head>

<body>

    <?php include("navbar.php"); ?><br><br><br><br>

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
    <section class="h-100 d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black custom-card-width login_box">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <img src="image/spoon.svg" style="width: 50px; display: inline-block; vertical-align: middle;" alt="logo">
                                <p class="nav" style="display: inline-block; margin: 0; vertical-align: middle; font-size:28px;">Backstage Cafe</p>
                            </div>
                            <form action="customer_login.php" method="post">
                                <div class="outer">
                                    <input type="text" id="form2Example11" class="form-control" name="username" placeholder="Username" style="border: black 1px solid; " required />
                                </div>
                                <div class="outer">
                                    <input type="password" id="form2Example22" class="form-control" name="password" placeholder="Password" style="border: black 1px solid;" required />
                                </div>
                                <div>


                                    <p class="caccount" style="font-size:15px; margin-top:15px;">Don't have an account yet?&nbsp<a href="ddashboard.php#sec4">Create an Account </a></p>

                                </div>
                                <div class="text-center pt-1 mb-2 pb-1" style="margin-top: 30px;">
                                    <button class="login_btn" type="submit" value="Login" name="login">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br>

    <?php include("footer.php"); ?>


</body>

</html>