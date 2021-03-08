<?php
session_start();
include "../config/konekcija.php"; 
if(isset($_POST["login"])){
     $email = $_POST["email"];
     $sifra = $_POST["sifra"];
     $validno = true;
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
     $validno = false;
     }
     if(empty($sifra)){
     $validno = false;
     }
     if($validno){
          $upit="SELECT * from korisnici where email=:email and sifra=:sifra";
          $priprema = $konekcija->prepare($upit);
          $priprema->bindParam(":email", $email);
          $priprema->bindParam(":sifra", $sifra);
          $rezultat = $priprema->execute();
          if($rezultat){
               if($priprema->rowCount()==1){
               $korisnik=$priprema->fetch();
               $_SESSION['korisnik']=$korisnik;
               echo json_encode($korisnik);
          }else{
               $_SESSION['greske']=" Incorrect email or password"; 
          }
          }
     }
}else{
     header("Location: ../index.php");
} 
?>