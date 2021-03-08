<?php

    $upit = "SELECT * FROM meni";
    $rezultat = $konekcija->query($upit);
    echo "<ul class='nav navbar-nav navbar-right'>";
    foreach($rezultat as $li) {
    echo "<li><a href='$li->link'>$li->naziv</a></li>";
    }
    if(isset($_SESSION['korisnik'])){
    echo "<li><a href='models/logout.php'>Log out</a></li>";
    if($_SESSION['korisnik']->ulogaId == 2){
    echo "<li><a href='admin.php'>Admin</a></li>";
    }
    }else{
    echo "<li><a href='login.php'>LogIn/SingUp</a></li>";
    }
    echo "</ul>";
?>
