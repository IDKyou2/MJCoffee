<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MJCoffee</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
      <section class="sec1" id="sec1">
        <!-- Carousel wrapper -->
        <div id="carouselBasicExample" class="carousel slide carousel-fade carousel-width-adjust" data-mdb-ride="carousel">
          <!-- Indicators -->
          <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2" aria-label="Slide 3"></button>
          </div>

          <!-- Inner -->
          <div class="carousel-inner">
            <!-- Single item -->
            <div class="carousel-item active">
              <img src="image/carousel1.jpg" class="d-block w-100 carousel-img" alt="" />
              <div class="carousel-caption d-none d-md-block">
                <h4 style="color:white; width:auto; height: 400px;">We offer the most tasty<strong style="color:#664229;"> coffees</strong> here.</h4>
              </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
              <img src="image/carousel1.jpg" class="d-block w-100 carousel-img" alt="Canyon at Nigh" />
              <div class="carousel-caption d-none d-md-block">
                <h4 style="height: 420px;">Mt. Apo</h4>
                <p style="color:white; margin-bottom:50px;">• a delicious and versatile cut of fish that can be enjoyed in many different dishes.</p>
              </div>
            </div>

            <!-- Single item -->
            <div class="carousel-item">
              <img src="image/carousel1.jpg" class="d-block w-900 carousel-img" alt="Caldereta image" />
              <div class="carousel-caption d-none d-md-block">
                <h4 style="height: 110px;">Brazil</h4>
                <p style="color:white">• a vibrant fusion of grilled pork or fish paired with zesty, marinated raw seafood, offering a delicious blend of smoky flavors with a tangy, refreshing twist.</p>
              </div>
            </div>
          </div>
          <!-- Inner -->
        </div>
      </section>
    </div>
    <hr>
    
  </div><br>

  <section class="sec2" id="sec2">
    <div class="container">
      <div class="row">
        <div class="menu_header">
          <p>Menu</p>
          <div class="end_menu_header d-flex align-items-center">
            <p class="right">See more</p>
            <a href="menu.php">
              <img class="menu_header img" src="image/arrow.svg" alt="right arrow">
            </a>
          </div>
        </div>
      </div>
    </div><br>

    <div class="container">
      <div class="row">
        <?php
        include('backend/display_food.php')
        ?>
      </div>

      <div class="container">
        <div class="row">
          <div class="menu_header">
            <p>Shop Our Drinks</p>
            <div class="end_menu_header d-flex align-items-center">
              <p class="right">See more</p>
              <a href="menu.php">
                <img class="menu_header img" src="image/arrow.svg" alt="right arrow">
              </a>
            </div>
          </div>
  </section>
  </div>
  </div><br>

  <div class="container">
    <div class="row">
      <?php
      include('backend/display_drinks.php')
      ?>
    </div>

  </div>
  </div>
  </section>

  <section class="sec3" id="sec3" style="padding-top: 20px;">
    <div class="container">
      <hr style=" border:1px solid black; margin-bottom: 50px;" ;>

      <div class="row">
        <div class="col-md-6 abt_img">
          <img src="image/Rectangle 7.png" alt="about" class="img-fluid">
        </div>
        <div class="col-md-6">
          <div class="about_details">

            <p class="about_header">About</p>

            <p> Backstage’s Carinderia is not just a dining spot it's a voyage into the heart of Filipino culinary traditions.
              Each dish served on our menu carries with it the weight and wisdom of generations-old recipes,
              meticulously prepared to bring the genuine essence of Filipino cuisine to the table. Our relentless
              commitment to sourcing fresh, local ingredients ensures that every bite is a testament to the country's
              rich agricultural heritage. But beyond the food, it's the timeless warmth of Filipino hospitality that defines our space.
              Here at Backstage’s Carinderia, guests are not just customers, but part of a larger family.
              Every visit is a delightful reminder of the country's values where flavors don't just tantalize the taste buds but also evoke cherished memories and emotions.</p>
            <center>
              <a href="menu.php"><button class="btn btn-primary cart_btn" style="background-color: #9A4444; color: white;">Shop Now</button></a>
            </center>
          </div>
        </div>
      </div>
    </div>
  </section>



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
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black custom-card-width" style="border: black 1px solid; min-width: 300px;">
                <div class="row g-0">
                  <div class="card-body p-md-5 mx-md-4">

                    <div class="text-center">
                      <img src="image/spoon.svg" style="width: 50px; display: inline-block; vertical-align: middle;" alt="logo">
                      <p class="nav" style="display: inline-block; margin: 0; vertical-align: middle; font-size:28px;">MJCoffee</p>
                    </div>
                    <br>

                    <form action="registration.php" method="post">
                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="username" placeholder="Username" required style="border: black 1px solid; " />
                      </div>

                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="name" placeholder="Name" style="border: black 1px solid; " required />
                      </div>

                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="address" placeholder="Your Permanent Address" style="border: black 1px solid;" required />
                      </div>

                      <div class="outer_input">
                        <input type="text" id="form2Example11" class="form-control" name="phonenumber" maxlength="11" placeholder="Phone Number Ex. 09254789621" style="border: black 1px solid;" required />
                      </div>

                      <div class="outer_input">
                        <input type="password" id="form2Example22" name="password" placeholder="Password" class="form-control" style="border: black 1px solid;" required />
                      </div>

                      <div class="outer_input">
                        <input type="password" id="form2Example22" name="confirmpassword" placeholder="Confirm Password" class="form-control" style="border: black 1px solid;" required />
                      </div>
                      <br>

                      <div class="text-center pt-1 mb-2 pb-1" style="margin-top: 20px;">
                        <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" style="background-color: #9A4444; color: white; width: 250px;" id="submit" type="submit">Sign Up</button>
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

  </div>
  </div>
  </section><br>

  <?php
  include("footer.php")
  ?>

</body>

</html>