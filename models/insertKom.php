<?php 
if(isset($_POST['insertKom'])){  
    $kom = $_POST['kom']; 
    $korisnik = $_POST['korisnik'];
    $post = $_POST['post'];  
    include "../config/konekcija.php";
    $upis = "INSERT INTO komentari (sadrzaj,korisnikId,postId)
    VALUES(:text, :kor , :post)"; 
    $prep = $konekcija->prepare($upis); 
    $prep->execute([ 
        ":text" => $kom, 
        ":kor" => $korisnik, 
        ":post" => $post, ]); 
        if($prep){
            http_response_code(200);
          }else{
            http_response_code(500);
          }
}else{
    header("Location: ../index.php");
}