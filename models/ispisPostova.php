<?php
    session_start();
    header("Content-type:application/json");
    include "../config/konekcija.php";
    if(isset($_POST["ok"]) && $_POST["ok"]=="true"){
        $upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike WHERE idPost=:id";
        $id=$_POST["id"];
        $res=$konekcija->prepare($upit);
        $res->bindParam(":id",$id);
        $res->execute();
        $rezultat=$res->fetch();
    }
    echo (json_encode($rezultat));