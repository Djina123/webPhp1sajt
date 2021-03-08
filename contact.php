<?php
session_start();
require_once "config/konekcija.php";
include "pages/head.php";
include "pages/header.php";
?>

<!-- Home Section -->

<section id="home" class="main-contact parallax-section">
     <div class="overlay"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <h1>Contact Us</h1>
               </div>

          </div>
     </div>
</section>

<!-- Contact Section -->

<section id="contact">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <h2>Say hello..</h2>

                    <form action="#" method="post">
                         <div class="col-md-4 col-sm-4">
                              <input name="name" type="text" class="form-control" id="name" placeholder="Name">
                         </div>
                         <div class="col-md-4 col-sm-4">
                              <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                      	 </div>
                         <div class="col-md-12 col-sm-12">
                              <textarea name="message" rows="5" class="form-control" id="message" placeholder="Message"></textarea>
                         </div>
                         <div class="col-md-3 col-sm-6">
                              <input name="button" type="button" class="form-control" id="posalji" name="posalji" value="Send">
                         </div>
                         <div class="col-md-12 col-sm-12">
                              <p id="gre"></p>
                         </div>
                    </form>
               </div>

          </div>
     </div>
</section>

<!-- Footer Section -->

<?php 
     include "pages/footer.php";
?>
<script src="assets/js/main.js"></script>
