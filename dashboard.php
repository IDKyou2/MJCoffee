<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MJCoffee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
  <link rel="Icon" href="image/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="style/dashboard.css">
  <link rel="stylesheet" href="style/not-availablee.css">
</head>

<body style="background-color: #D2B48C;">

  <?php
  require_once("navbar.php");
  ?>
  <br>

  <div class="container" style="margin-top: 30px;">
    <div class="row">
      <!------------------------------------------------------------------- Carousel display Section ------------------------------------------------------------>
      <section class="sec1" id="sec1">
        <!-- Carousel wrapper -->
        <div id="carouselBasicExample" class="carousel slide carousel-fade carousel-width-adjust"
          data-mdb-ride="carousel">
          <!-- Indicators -->
          <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active"
              aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1"
              aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2"
              aria-label="Slide 3"></button>
          </div>

          <!-- Inner -->
          <div class="carousel-inner">
            <!-- Single item -->
            <div class=" carousel-item active">
              <img src="image/bg1.jpg" class="d-block carousel-img" alt="" />
              <div class="carousel-caption d-none d-md-block">

              </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
              <img src="image/bg1.jpg" class="d-block w-100 carousel-img" alt="" />
              <div class="carousel-caption d-none d-md-block">
                <h4 style="height: 420px;"></h4>
                <p style="color:white; margin-bottom:50px;"></p>
              </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
              <img src="image/bg1.jpg" class="d-block w-900 carousel-img" alt="" />
              <div class="carousel-caption d-none d-md-block">
                <h4 style="height: 110px;"></h4>
                <p style="color:white"></p>
              </div>
            </div>
          </div>
          <!-- Inner -->
        </div>
      </section>
    </div>
    <hr>

  </div><br>

  <!------------------------------------------------------------------- Menu Section ------------------------------------------------------------>
  <section class="sec2" id="sec2">
    <div class="container">
      <div class="row">
        <div class="menu_header">
          <p>Order menu</p>
          <div class="end_menu_header d-flex align-items-center">
            <p class="right">See more</p>
            <a href="index.php">
              <img class="menu_header img" src="image/arrow.svg" alt="right arrow">
            </a>
          </div>
        </div>
      </div>
    </div><br>

    <div class="container">
      <div class="row">
        <?php
        include('backend\display_food.php')
          ?>
      </div>
    </div>
    <!------------------------------------------------------------------- Smoothies ------------------------------------------------------------>
    <div class="container">
      <div class="row">
        <div class="menu_header">
          <p>Smoothies</p>
          <div class="end_menu_header d-flex align-items-center">
            <p class="right">See more</p>
            <a href="menu.php">
              <img class="menu_header img" src="image/arrow.svg" alt="right arrow">
            </a>
          </div>
        </div>
      </div>
    </div>
    <br>

    <div class="container">
      <div class="row">
        <?php
        include('backend/displaySmoothies.php')
          ?>
      </div>
    </div>
  </section>

  <!------------------------------------------------------------------- About Section ------------------------------------------------------------>
  <section class="sec3" id="sec3" style="padding-top: 20px;">
    <div class="container">
      <hr style=" border:1px solid black; margin-bottom: 50px;" ;>

      <div class="row">
        <div class="col-md-6 aboutUsImage">
          <img src="image/3.webp" alt="About-Us-image" class="img-fluid">
        </div>
        <div class="col-md-6">
          <div class="about_details">
            <p class="about_header">About</p>
            <p> Welcome to MJCoffee, where every cup tells a story. Founded with a passion for great
              coffee and a love for community, we set out to create a cozy space where people can gather, connect, and
              enjoy the perfect brew.

              We believe that coffee is more than just a drink—it’s an experience. That’s why we carefully source our
              beans, craft our blends with precision, and serve every cup with warmth and dedication. Whether you're
              here for your morning boost, a relaxing afternoon, or a productive work session, we’ve got the perfect
              blend for you.

              Join us for a sip, stay for the atmosphere, and become part of our growing coffee-loving community.

              <strong>☕ Brewed with passion. Served with love.</strong>
            </p>

            <a href="index.php"><button class="btn cart-btn">Order now</button></a>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!------------------------------------------------------------------- Registration Section ------------------------------------------------------------>
  <section class="sec4" id="sec4">
    <br>
    <div class="container 
    <?php if (!isset($_SESSION['username'])) {
      echo 'd-block';
    } else {
      echo 'd-none';
    } ?>">
      <hr style=" border:1px solid black;" ;>
      <div class="row">
        <div class="container py-5">
          <div class="row d-flex justify-content-center align-items-center">
            <div class="col-xl-10">
              <div class="card rounded-3 custom-card-width">
                <!-- Sets the gap between columns and rows to 0  -->
                <div class="row g-0">
                  <!-- On medium (md) screens and larger, the padding increases to 5, and horizontal margins increase to 4.-->
                  <div class="card-body p-md-5">
                    <div class="text-center">
                      <img src="image/logo-nobg.png" style="width: 50px; display: inline-block; vertical-align: middle;"
                        alt="logo">
                      <p class="nav" style="display: inline-block; margin: 0; vertical-align: middle; font-size:28px;">
                        Register Account</p>
                    </div>
                    <br>

                    <form action="registration.php" method="post">
                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="username"
                          placeholder="Username" required style="border: black 1px solid;" />
            
                        <style>
                          /* Custom CSS for smooth transitions */
                          .hover-opacity-100:hover {
                            opacity: 1 !important;
                          }

                          .focus-opacity-100:focus-within {
                            opacity: 1 !important;
                          }

                          .transition {
                            transition: opacity 0.2s ease;
                          }
                        </style>
                      </div>

                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="name" placeholder="Name"
                          style="border: black 1px solid; " required />
                      </div>

                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="address"
                          placeholder="Your Permanent Address" style="border: black 1px solid;" required />
                      </div>

                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="phonenumber" maxlength="11"
                          oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                          placeholder="Phone Number Ex. 09254789621" style="border: black 1px solid;" required />
                      </div>

                      <div class="outer_input">
                        <input type="password" id="form2Example22" name="password" placeholder="Password"
                          class="form-control" style="border: black 1px solid;" required />
                      </div>

                      <div class="outer_input">
                        <input type="password" id="form2Example22" name="confirmpassword" placeholder="Confirm Password"
                          class="form-control" style="border: black 1px solid;" required />
                      </div>
                      <br>

                      <div class="text-center pt-1 mb-2 pb-1" style="margin-top: 20px;">
                        <button class="btn formBtn" id="submit" type="submit">Sign
                          Up</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <br>

  <?php
  include("footer.php");
  ?>

</body>

</html>