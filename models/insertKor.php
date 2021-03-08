<?php 
if(isset($_POST['insertKor'])){  
    $ime = $_POST['ime']; 
    $prezime = $_POST['pre']; 
    $email = $_POST['mejl']; 
    $lozinka = $_POST['sifra']; 
    $ulogakorisnika = $_POST['uloga']; 
    include "../config/konekcija.php";
    $upisikorisnika = "INSERT INTO korisnici (ime,prezime,sifra,email,ulogaId)
    values(:ime, :pre , :lozinka, :email , :ulogakorisnika)"; 
    $prep = $konekcija->prepare($upisikorisnika); 
    $prep->execute([ 
        ":ime" => $ime,
        ":pre" => $prezime,
        ":email" => $email, 
        ":lozinka" => $lozinka, 
        ":ulogakorisnika" => $ulogakorisnika ]); 
        if($prep){
            http_response_code(200);
          }else{
            http_response_code(500);
          }
}else{
    header("Location: ../index.php");
}