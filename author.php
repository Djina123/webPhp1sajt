<?php
session_start();
require_once "config/konekcija.php";
include "pages/head.php";
include "pages/header.php";
?>

<!-- Contact Section -->

<section id="contact">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">
                         <div class="col-md-6 col-sm-6" >
                            <img src="assets/images/autor.jpg" id="autorImg" alt="autor"/>
                         </div>
                         <div class="col-md-4 col-md-offset-1 col-sm-6">
                              <h3>Anđela Stanković</h3>
                              <p>Živim u Smederevskoj Palanci. Završila sam Planačku gimnazij. Rođena sam 12.5.1998. Broj indeksa: 86/17</p>
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
