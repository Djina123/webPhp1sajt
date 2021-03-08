<?php
    session_start();
    include "../config/konekcija.php";
                         if(isset($_POST["komentarisi"])){
                              $post= $_POST["post"];
                              $komentar = $_POST["komentar"];
                              $idKor= $_SESSION["korisnik"]->idKorisnik;
                              echo $idKor;
                              $validno = true;
                              if(empty($komentar)){
                                   $validno = false;
                              }
                              if($validno){
                                   $upit = "INSERT INTO komentari (sadrzaj, korisnikId, postId)
                                   VALUES (:komentar, :idKor, :brPosta)";
                                   $priprema = $konekcija->prepare($upit);
                                   $priprema->bindParam(':komentar', $komentar);
                                   $priprema->bindParam(':brPosta', $post);
                                   $priprema->bindParam(':idKor', $idKor);
                                   $rezultat = $priprema->execute();
                              }
                              if($rezultat){
                                http_response_code(200);
                              }else{
                                http_response_code(500);
                              }
                         }else{
                              header("Location: ../index.php");
                          }
                          
                         

?>