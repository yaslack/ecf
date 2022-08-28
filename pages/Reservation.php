<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/reservation.css">
    <link rel="stylesheet" href="../style/CalendarPicker.style.css" />
    <script src="../js/CalendarPicker.js"></script>

</head>
<body>

  <?php
  require_once('php/redirect.php');
  RedirectReservation();
  ?>


  <header>
    <!-- Just an image -->
  <nav id="navbar" class="navbar navbar-light fixed-top bg-doré" >
    
    <button id="btnCollapse" class="navbar-toggler m-md-5" type="button" data-bs-toggle="collapse" data-bs-target="#navbar2" aria-expanded="false" aria-controls="navbar2">
      <span class="navbar-toggler-icon"></span>
    </button>
  <div class="navbar-item mx-auto" href="#">
    <img src="../assets/Logo.PNG" width="100" height="100" alt="">
  </div>
  </nav

  <nav>
    <div id="navbar2" class="navbar-collapse collapse fixed-left text-center">
      <ul id="main-menu" class="navbar-nav">
        <li class="nav-item text-start">
          <a href="#" class="nav-link" type="button" data-bs-toggle="collapse" data-bs-target="#navbar2" aria-expanded="false" aria-controls="navbar2">
            <svg id ="crossCollapse" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </a>
        </li>
        <li class="nav-item">
          <a href="../index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="Contact.php" class="nav-link">Contact us</a>
        </li>
      </ul>
    </div>
  </nav>

  </header>

  <main>
    <div style="padding-top: 50px;">
      <h1 >
        Reservation
      </h1>
    </div>
    

    <div class="justify-content-center input-group mb-3">
      <select class="custom-select" id="inputSelectHotel">
          <option selected>Choose Hotel</option>
          <?php
            require_once('php/Controller.php');
            AdminHotelsChose();
          ?>
        </select>
    </div>

    <div class="justify-content-center input-group mb-3">
      <h3>Choose your room :</h3>
    </div>
    <div id="roomChoose" class="justify-content-center input-group mb-3">
    </div>

    <div class="justify-content-center input-group mb-3">
        <div id="firstCalendar">
        <h3>Begin</h3>
        </div>
        <div id="secondCalendar">
        <h3>End</h3>
        </div>
    </div>
    <div class="justify-content-center input-group mb-3">
      <a id="bookRoom" onclick="clickBook()" class="navbar-brand m-md-5" >Book Now</a>
    </div>


  </main>
  

      <!-- Footer -->
<footer class="text-center text-lg-start text-muted bg-dark-grey">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom m-md-5"
  >
    <!-- Left -->
    <div class="mx-auto" href="#">
      <img src="../assets/Logo.PNG" width="75" height="75" alt="">
    </div>

  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4" style="color: white;">
            Contact Us :
          </h6>
          <div>
            <a class="contact-links" target="_blank" href="https://maps.google.com/?q=New York, NY 10012, US">
              <p>
                New York, NY 10012, US
              </p>
            </a>
            <a class="contact-links" target="_blank" href="mailto: hypnos@gmail.com">
              <p>
                hypnos@gmail.com
              </p>
            </a>
            <a class="contact-links" target="_blank" href="tel: +0123456788">
              <p>
                + 01 234 567 88
              </p>
            </a>
          </div>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4" style="color: white;">
            Social Media :
          </h6>
          <div style="color: white">
            <a target="_blank" href="https://www.facebook.com">
              <svg class="m-3" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
              </svg>
            </a>
            <a target="_blank" href="https://www.instagram.com">
              <svg class="m-3" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
              </svg>
            </a>
          </div>
        </div>

      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgb(26, 26, 26);">
    © 2022 Copyright:
    <div class="text-reset fw-bold">Dridi Yassin</div>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->


<script src="../js/index.js"></script>
<script src="../js/reservation.js"></script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
 integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
 integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>