<?php
    session_start();
    header("Content-type:application/json");
    include "../config/konekcija.php";
    if(isset($_POST["ok"]) && $_POST["ok"]=="true"){
        $upit ="SELECT * FROM korisnici WHERE idKorisnik=:id";
        $id=$_POST["idKor"];
        $res=$konekcija->prepare($upit);
        $res->bindParam(":id",$id);
        $res->execute();
        $rezultat=$res->fetch();
    }
    echo (json_encode($rezultat));