<?php

$serverBaze = "localhost";
$username = "root";
$password = "";
$bazaPodataka = "neuron";


try {
    $konekcija = new PDO("mysql:host=$serverBaze;dbname=$bazaPodataka;charset=utf8", $username, $password);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
    echo "Greska sa konekcijom: " . $e->getMessage();
    }

?>