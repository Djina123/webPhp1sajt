<?php
session_start();
require_once "config/konekcija.php";
include "pages/head.php";
include "pages/header.php";
?>

<!-- Home Section -->

<section id="home" class="main-single-post parallax-section">
     <div class="overlay"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <h1>Single Post</h1>
               </div>

          </div>
     </div>
</section>

<!-- Blog Single Post Section -->

<section id="blog-single-post">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="blog-single-post-thumb">
                         
                         <?php
                         if(isset($_GET['post'])){
                              $brPosta = ($_GET['post']);
                         }
                         $upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike INNER JOIN korisnici k ON p.idKor=k.idKorisnik WHERE idPost=:id";
                         $izvrsenje=$konekcija->prepare($upit); 
                         $izvrsenje->bindParam(":id",$brPosta);
                         $rezultat=$izvrsenje->execute();
                         $post=$izvrsenje->fetch();
                         $upit2 = "SELECT COUNT(k.idKom) as broj FROM komentari k INNER JOIN postovi p on p.idPost=k.postId where p.idPost=".$post->idPost;
                         $rezultat2 = $konekcija->query($upit2);
                         $brojKom= $rezultat2->fetch();

                            echo "<div class='blog-post-title'>
                                   <h2>$post->naslov</a></h2>
                              </div>
                              <div class='blog-post-format'>
                                   <span> $post->ime $post->prezime</span>
                                   <span><i class='fa fa-date'></i>$post->datum </span>
                                   <span><i class='fa fa-comment-o'></i> $brojKom->broj </span>
                              </div>
                              <div class='blog-post-des'>
                                   <blockquote>'Art is what we call...the thing an artist does. It's not the medium or the oil or the price or whether it hangs on a wall or you eat it. What matters, what makes it art, is that the person who made it overcame the resistance, ignored the voice of doubt and made something worth making. Something risky. Something human. Art is not in the ...eye of the beholder. It's in the soul of the artist.' </blockquote>
                              
                                   <div class='blog-post-image'>
                                   <img src=' $post->putanja' class='img-responsive' alt=' $post->alt'>
                                   </div>
                                   <p> $post->tekst </p>
                              </div>";
                         ?>

                         <div class="blog-comment">
                              <h3>Comments</h3>
                         <?php
                              if(isset($_GET["post"])){
                                   $id = $_GET["post"];
                                   $upit = "SELECT * FROM komentari k INNER JOIN korisnici ko ON k.korisnikId=ko.idKorisnik WHERE postId=:id LIMIT 3";
                                   $izvrsenje=$konekcija->prepare($upit); 
                                   $izvrsenje->bindParam(":id",$id); 
                                   $rezultat=$izvrsenje->execute();
                                   $kom=$izvrsenje->fetchAll();
                                   foreach($kom as $k){
                                        echo "<div class='media'>
                                             <div class='media-body'>
                                                  <h3 class='media-heading'>$k->ime $k->prezime</h3>
                                                  <p>$k->sadrzaj</p>
                                             </div>
                                        </div> ";
                                   }
                              }
                              ?>
                         </div>
                    
                     <?php
                         if(isset($_SESSION['korisnik'])){
                         
                         echo"<div class='blog-comment-form'>
                              <h3>Leave a Comment</h3>
                                   <form method='post'>
                                        <textarea name='message' rows='5' class='form-control' id='message' placeholder='Message' message='message'></textarea>
                                        <div class='col-md-3 col-sm-4'>
                                             <input name='komentar' type='button' class='form-control' id='komentar' value='Post Your Comment'>
                                             <input type='hidden' value=".$brPosta." id='hidden' name='hidden'>
                                        </div>
                                   </form>
                                   <p id='kom'>Message can't be emprty</p>
                                   
                         </div>";
                         }
                    ?>
                    
                    </div>
          </div>
     </div>
</section>

<?php 
     include "pages/footer.php";
?>
<script src="assets/js/main.js"></script>
</body>
</html>