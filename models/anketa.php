<?php 
session_start();
if(isset($_POST['posaljiOdgovor'])){  
    $odgovor = $_POST['anketa']; 
    include "../config/konekcija.php";
    $upisikorisnika = "INSERT INTO korisnik_odgovor (idOdgovor)
    values(:idOdgovor)"; 
    $prep = $konekcija->prepare($upisikorisnika); 
    $prep->execute([ 
        ":idOdgovor" => $odgovor, ]); 
        if($prep){
            $update=$konekcija->query("UPDATE anketa SET ipaddress='".$_SERVER['REMOTE_ADDR']."'");
            if($update){
                header("Location: ../index.php");
            }  
            header("Location: ../index.php");
        }
          
}else{
    header("Location: ../index.php");
}