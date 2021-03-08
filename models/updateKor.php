<?php
    if(isset($_POST['updateKor'])){ 
        $id = $_POST['id']; 
        $ime = $_POST['ime']; 
        $pre = $_POST['pre'];
        $email = $_POST['mejl']; 
        $lozinka = $_POST['sifra']; 
        $uloga = $_POST['uloga'];
        include "../config/konekcija.php";
        $upit = "UPDATE korisnici set ime = :ime, prezime = :prezime, email = :email, sifra = :lozinka where idKorisnik = :id"; 
        $prep = $konekcija->prepare($upit); 
        $prep->execute([ 
            ":ime" => $ime, 
            ":prezime" => $pre, 
            ":email" => $email, 
            ":lozinka" => $lozinka, 
            ":id" => $id ]); 
            if($prep){
                http_response_code(200);
              }else{
                http_response_code(500);
              }
    }else{
        header("Location: ../index.php");
    }
    