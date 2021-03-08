<?php
    if(isset($_POST["posalji"])){
        include "../config/konekcija.php";       
        $ime = $_POST["ime"];
        $email = $_POST["email"];
        $poruka = $_POST["poruka"];
        $reIme = "/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/";
        $reEmail = "/^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/";
        $vremeSlanja = date("Y-m-d H:i:s", time());
        $validno = true;
        if(!preg_match($reIme, $ime)){
        $validno = false;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $validno = false;
        }
        if(empty($poruka)){
        $validno = false;
        }
        if($validno){
            $upit="INSERT INTO kontakt(ime,email,tekst,vreme) VALUES(:ime,:email,:tekst,:datum)";
            $prep = $konekcija->prepare($upit); 
            $prep->execute([ 
                ":ime" => $ime,
                ":email" => $email, 
                ":tekst" => $poruka, 
                ":datum" => $vremeSlanja ]); 
        }
        if($prep){ 
            header("Location: ../admin.php"); 
        }else{ 
            echo "Doslo je do greske"; 
        } 
    }else{
        header("Location: ../index.php");
    }
    