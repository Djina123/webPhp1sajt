<?php
    if(isset($_GET['id'])){
        $idKom = $_GET['id'];
        include "../config/konekcija.php";
        $obrisi = "DELETE FROM komentari WHERE idKom = :id";
        $prep = $konekcija->prepare($obrisi);
        $prep->execute([
        ":id" => $idKom
        ]);
        if($prep){
        header("Location: ../admin.php");
        }else{
        echo "doslo je do greke prilikom brisanja komenatra";
        }
    }else{
        header("Location: ../index.php");
    }
    