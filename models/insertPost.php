<?php
    include "../config/konekcija.php";
    if(!isset($_POST['addPost'])){ 
        header("Location: ../admin.php"); 
    }else{ 
        echo"tu sam";
        $naslov = $_POST['naslovp']; 
        $text = $_POST['textp']; 
        $alt = $_POST['altp']; 
        $datum = $_POST['datump']; 
        $user = $_POST['userPost'];
        $fajl = $_FILES['imagesp']; 
        $validno= true;
        if(!$fajl['name']){ 
            echo "You didn't chose pictures"; 
        }else{ 
             
        }
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
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']; 
            $fajlSlikaTip = $fajl['type']; 
          
            if(!in_array($fajlSlikaTip, $allowedTypes)){ 
                echo "Fail isn't allow"; 
            }else{ $fajlSlikaName = time() . "_". $fajl['name']; 
                if(move_uploaded_file($fajl['tmp_name'], "../assets/images/".$fajlSlikaName)){ 
                    $inserSlike = "INSERT INTO slike (putanja, alt, galerija) 
                    VALUES (:slika, :alt, 0 )";
                    $stmt = $konekcija->prepare($inserSlike); 
                    $stmt->execute([ 
                        ":slika" => "assets/images/".$fajlSlikaName, 
                        ":alt" => $alt]);
                        $idSlike=$konekcija->lastInsertId();
                        var_dump($idSlike);
                        $upit = "INSERT INTO postovi (naslov, tekst,slikaId, datum, idKor) 
                        VALUES (:naslov, :tekst, :idSlike, :datum, :idKor )"; 
                        $prep = $konekcija->prepare($upit); 
                        $prep->execute([ 
                            ":idSlike" => $idSlike,
                            ":naslov" => $naslov, 
                            ":tekst" => $text, 
                            ":datum" => $datum,
                            ":idKor" => $user ]); 
                        if($prep){ 
                            header("Location: ../admin.php"); 
                        }else{ 
                            echo "Doslo je do greske"; 
                        } 
                } 
            }
          
        }
    }