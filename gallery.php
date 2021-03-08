<?php
session_start();
require_once "config/konekcija.php";
include "pages/head.php";
include "pages/header.php";
?>

<!-- Home Section -->

<section id="home" class="main-gallery parallax-section">
     <div class="overlay"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <h1>Image Gallery</h1>
               </div>

          </div>
     </div>
</section>

<!-- Gallery Section -->

<section id="gallery">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <h2>Beautiful Images..</h2>
                    <p>“To me, photography is an art of observation. It’s about finding something interesting in an ordinary place… I’ve found it has little to do with the things you see and everything to do with the way you see them.”</p>
                    <span>— Elliott Erwitt</span>
                    <p>“People spot a big black lens, and they worry about what they're doing, or how their hair looks. Nobody see the person holding the camera.” </p>
                    <span>― Erica O'Rourke</span>
                    <?php 
                    $str = 0;

                         if(isset($_GET['str'])){
                          $str = ($_GET['str']) * 2;
                          }

                         $select = "SELECT * FROM slike
                               WHERE galerija=1
                               LIMIT $str, 2";

                         $slike = $konekcija->query($select)->fetchAll();
                                
                         foreach($slike as $slika):
                    ?>
                         <div class="col-md-6 col-sm-6">
                         <div class="gallery-thumb">
                              <a href="<?= $slika->putanja ?>" class="image-popup">
                                   <img src="<?= $slika->putanja ?>" class="img-responsive" alt="<?= $slika->alt ?>">
                              </a>
                         </div>
                         </div>
                     <?php endforeach;?>

               </div>
          </div>
          <div id="str">
                    <ul class="nav nav-pills">
                    <li><a href="gallery.php?str=0"><b> 1 </b></a></li>
                    <li><a href="gallery.php?str=1"><b> 2 </b></a></li>
                    <li><a href="gallery.php?str=2"><b> 3 </b></a></li>
                    </ul>
               </div>
     </div>
</section>

<!-- Footer Section -->

<?php 
     include "pages/footer.php";
?>