<?php
session_start();
require_once "config/konekcija.php";
include "pages/head.php";
include "pages/header.php";
?>




<!-- Home Section -->

<section id="home" class="main-home parallax-section">
     <div class="overlay"></div>
     <div id="particles-js"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <h1>Hello! This is Neuron.</h1>
                    <a href="login.php" class="smoothScroll btn btn-default">Discover More</a>
               </div>

          </div>
     </div>
</section>

<section id="blog">
     <div class="container">
          <div class="row">

          <?php if(isset($_SESSION['korisnik'])):
               
               $anketaStatus=$konekcija->query("SELECT status,pitanje FROM anketa")->fetch();
               if($anketaStatus->status==1):?>
          <div class="container anketa">
                    <h2>Poll</h2>
          <?php $ip=$konekcija->query("SELECT count(*) as number FROM anketa where ipaddress='".$_SERVER['REMOTE_ADDR']."' ")->fetch();
              if($ip->number!=1):?>
               <form method="POST" action="models/anketa.php">
               <ul id="anketaLista">
               <li><?php echo $anketaStatus->pitanje?></li>
               <?php   $upit="SELECT a.idAnketa, a.pitanje,a.status,a.ipaddress,o.odgovor,o.idOdg FROM anketa a INNER JOIN odgovori o ON a.idAnketa=o.idAnketa";
                    $anketa=$konekcija->query($upit)->fetchAll();
                    foreach($anketa as $item):
          ?>
               <li><input type="radio" name="anketa" class="anketaDugme" value="<?php echo $item->idOdg;?>"/><?php echo $item->odgovor;?></li>
               <?php endforeach; ?>
               <li><button type="submit" name="posaljiOdgovor">Submit</button></li>
               </ul>
               </form>
          <?php else: $brojOdgovor=$konekcija->query("SELECT COUNT(o.odgovor) AS number, o.odgovor FROM korisnik_odgovor ko INNER JOIN odgovori o on ko.idOdgovor=o.idOdg GROUP BY o.odgovor");
               foreach($brojOdgovor as $item):
          ?>
               <p><?php echo "Answer: ".$item->odgovor.", Answer number: ".$item->number;?></p>
          <?php endforeach; endif;?>

          </div>
          <?php endif; endif; ?>

          <div class="container">
  
               <div class="select">
                    <select name="ddl" id="ddl">
                         <option>Sort posts</option>
                         <option value="1">The latest</option>
                         <option value="2">The oldest</option>
                         <option value="3">Posts A-Z</option>
                    </select>
               </div>
               <div id="postoviIspis">
               <?php 
               include "postovi.php";
               ?>
               </div>
          </div>
     </div>
</section>
<?php 
     include "pages/footer.php";
?>
<script src="assets/js/main.js"></script>