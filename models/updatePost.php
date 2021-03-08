<?php
     
    if(!isset($_POST['updPost'])){ 
        header("Location: ../admin.php"); 
    }else{ 
        $id = $_POST['postovi'];
        $naslov = $_POST['naslov']; 
        $text = $_POST['text']; 
        $alt = $_POST['alt']; 
        $datum = $_POST['datum']; 
        $user = $_POST['userPos'];
        $fajl = $_FILES['images']; 
        $validno= true;
        if(empty($naslov)){
            $validno = false;
        }
        if(empty($text)){
            $validno = false;
        }
        if(empty($alt)){
            $validno = false;
        }
        if(empty($datum)){
            $datum=gmdate("Y-m-d");
        }
        if($validno){
            if(!$fajl['name']){ 
                include "../config/konekcija.php";
                $upit=" UPDATE postovi SET naslov= :naslov, tekst = :tekst , datum = :datum, idKor = :user
                WHERE idPost = :id";
                $priprema = $konekcija->prepare($upit);
                $priprema->execute([ 
                    ":id" => $id,
                    ":naslov" => $naslov, 
                    ":tekst" => $text, 
                    ":datum" => $datum,
                    ":user" => $user ]);    
                if($priprema){ 
                    header("Location: ../admin.php"); 
                }else{ 
                    echo "Doslo je do greske"; 
                } 
            }else{
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']; 
            $fajlSlikaTip = $fajl['type']; 
          
            if(!in_array($fajlSlikaTip, $allowedTypes)){ 
                echo "Fail isn't allow"; 
            }else{ $fajlSlikaName = time() . "_". $fajl['name']; 
                if(move_uploaded_file($fajl['tmp_name'], "../assets/images/".$fajlSlikaName)){ 
                    include "../config/konekcija.php";
                    $updateSlike = "UPDATE slike SET putanja = :slika, alt = :alt, galerija=0 WHERE idSlike=(SELECT slikaId FROM postovi WHERE idPost= :id)";
                    $stmt = $konekcija->prepare($updateSlike); 
                    $stmt->execute([ 
                        ":id" => $id,
                        ":slika" => "assets/images/".$fajlSlikaName, 
                        ":alt" => $alt]);
                        $upit = "UPDATE postovi SET naslov= :naslov, tekst = :tekst , datum = :datum, idKor = :user
                        WHERE idPost = :id"; 
                        $prep = $konekcija->prepare($upit); 
                        $prep->execute([ 
                            ":id" => $id,
                            ":naslov" => $naslov, 
                            ":tekst" => $text, 
                            ":datum" => $datum,
                            ":user" => $user ]); 
                        if($prep){ 
                            header("Location: ../admin.php"); 
                        }else{ 
                            echo "Doslo je do greske"; 
                        } 
                } 
            }
            }
          
        }
    }