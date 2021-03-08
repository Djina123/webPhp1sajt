<footer>
     <div class="container">
          <div class="row">

               <div class="col-md-5 col-md-offset-1 col-sm-6">
                    <h3>Neuron Studio</h3>
                    <p>This site is where you can come and enjoy. Creativity and freedom are just what matters.</p>
                    <div class="footer-copyright">
                         <p>Copyright &copy;Andjela Stankovic</p>
                    </div>
               </div>

               <div class="col-md-4 col-md-offset-1 col-sm-6">
                    <h3>Talk to us</h3>
                    <p><i class="fa fa-globe"></i> 512 Delicious Street, San Francisco, CA 10880</p>
                    <p><i class="fa fa-phone"></i> 010-020-0990</p>
                    <p><i class="fa fa-save"></i>andjela.stankovic.86.17@ict.edu.rs</p>
                    <p><a class="dokumentacija" href="dokumentacija.pdf">Dokumentacija</a></p>
               </div>

               <div class="clearfix col-md-12 col-sm-12">
                    <hr>
               </div>

               <div class="col-md-12 col-sm-12">
               <?php
                    $upit = "SELECT *
                    FROM footer";
                    $rezultat = $konekcija->query($upit);
                    echo "<ul class='social-icon'>";
                    foreach($rezultat as $li) {
                    echo "<li><a href='$li->link' class='$li->class'></a></li>";
                    }
                    echo "</ul>";
                ?>
               </div>
               
          </div>
     </div>
</footer>

<!-- Back top -->
<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>


<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- <script src="assets/js/particles.min.js"></script>
<script src="assets/js/app.js"></script> -->
<script src="assets/js/jquery.parallax.js"></script>
<script src="assets/js/smoothscroll.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>