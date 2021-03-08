<?php
    if(isset($_GET['status'])){ 
        $status = $_GET['status']; 
        include "../config/konekcija.php";
        $upit = "UPDATE anketa set status = :status"; 
        $prep = $konekcija->prepare($upit); 
        $prep->execute([ 
            ":status" => $status]); 
        if($prep){
            header("Location: ../admin.php#pollStatusButton");
        }
    }else{
        header("Location: ../index.php");
    }