<?php
    if(isset($_GET['id'])){
        $idKontakt = $_GET['id'];
        include "../config/konekcija.php";
        $obrisi = "DELETE FROM kontakt WHERE idKontakt = :id";
        $prep = $konekcija->prepare($obrisi);
        $prep->execute([
        ":id" => $idKontakt
        ]);
        if($prep){
        header("Location: ../admin.php");
        }else{
        echo "doslo je do greke prilikom brisanja kontakta";
        }
    }else{
        header("Location: ../index.php");
    }
    