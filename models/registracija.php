<?php 
session_start();
include "../config/konekcija.php"; 
if(isset($_POST['flag'])){ 
    $ime=$_POST['ime']; 
    $prezime=$_POST['pre'];  
    $email=$_POST['mejl']; 
    $lozinka=$_POST['pass']; 
    $greske=[]; 
    $code=404; 
    $data=null; 
    $reimeprez="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,20})*$/"; 
    $repass="/^\S{6,30}$/"; 
    $reEmail = "/^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/"; 
    if(!preg_match($reimeprez, $ime)){ 
        array_push($greske, "Name is incorrect");
    } 
    if(!preg_match($reimeprez, $prezime)){ 
        array_push($greske, "Last name is incorrect"); 
    } 
    if(!preg_match($repass, $lozinka)){ 
        array_push($greske, "Password is incorrect"); 
    } 
    if(!preg_match($reEmail, $email)){ 
        array_push($greske, "Email is incorrect"); 
    }
    if(count($greske)>0){ 
        $data=$greske; 
        $code=422; 
    } else{  
        $upit="INSERT INTO korisnici(ime,prezime,sifra,email,ulogaId) 
        VALUES(:ime,:prezime,:lozinka,:email,1)"; 
        $izvrsenje=$konekcija->prepare($upit); 
        $izvrsenje->bindParam(":ime",$ime); 
        $izvrsenje->bindParam(":prezime",$prezime);  
        $izvrsenje->bindParam(":lozinka",$lozinka); 
        $izvrsenje->bindParam(":email",$email);
        try {
            $code=$izvrsenje->execute()?201:500;
            if($code){
                $korisnik=$konekcija->query("SELECT * from korisnici where email='$email' and sifra='$lozinka' ")->fetch();
                $_SESSION['korisnik']=$korisnik;
    
            }else{
                header("Location: ../index.php");
            } 
        }catch (PDOException $e) { 
            $code=409; 
        } 
    } 
    http_response_code($code); 
    echo json_encode($data); 
}else{
    header("Location: ../index.php");
}

?>