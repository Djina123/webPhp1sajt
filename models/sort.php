<?php
    header("Content-type:application/json");
    include "../config/konekcija.php";
    if(isset($_POST["sort"])){
         $value = $_POST["value"];
         $postovi=[];
         if($value==1){
            $upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike INNER JOIN korisnici k ON p.idKor=k.idKorisnik ORDER BY p.datum DESC";
            $rez = $konekcija->query($upit);
            $postovi=$rez->fetchAll();
         }else if($value==2){
            $upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike INNER JOIN korisnici k ON p.idKor=k.idKorisnik ORDER BY p.datum";
            $rez = $konekcija->query($upit);
            $postovi=$rez->fetchAll();
         }else{
            $upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike INNER JOIN korisnici k ON p.idKor=k.idKorisnik ORDER BY p.naslov";
            $rez = $konekcija->query($upit);
            $postovi=$rez->fetchAll();
         }
         echo (json_encode($postovi));
    }