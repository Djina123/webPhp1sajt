<?php
    if(isset($_POST['updateKom'])){ 
        $id = $_POST['id']; 
        $kom = $_POST['kom']; 
        $korisnik = $_POST['korisnik'];
        $post = $_POST['post']; 
        include "../config/konekcija.php";
        $upit = "UPDATE komentari set sadrzaj = :kom, korisnikId = :kor, postId = :post where idKom = :id"; 
        $prep = $konekcija->prepare($upit); 
        $prep->execute([ 
            ":kom" => $kom, 
            ":kor" => $korisnik, 
            ":post" => $post, 
            ":id" => $id ]); 
            if($prep){
                http_response_code(200);
              }else{
                http_response_code(500);
              }
    }else{
        header("Location: ../index.php");
    }
    


