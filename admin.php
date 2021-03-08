<?php
session_start();
require_once "config/konekcija.php";
include "pages/head.php";
include "pages/header.php";
if(isset($_SESSION['korisnik'])):
    if($_SESSION['korisnik']->ulogaId == 2):
?>

<section id="home" class="main-about parallax-section">
     <div class="overlay"></div>
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <h1>Admin</h1>
               </div>

          </div>
     </div>
</section>

<section id="about">
     <div class="container">
          <div class="row">

               <div class="col-md-offset-1 col-md-10 col-sm-12">

                    <div class="col-md-6 col-sm-6">
                        <h2>Users</h2>
                        <form>      
                            <input name="name" id="name" type="text" class="feedback-input" placeholder="Name" />   
                            <input name="surname" id="surname" type="text" class="feedback-input" placeholder="Surname" /> 
                            <input name="pass" id="pass" type="text" class="feedback-input" placeholder="Password" />
                            <input name="email" id="email"type="text" class="feedback-input" placeholder="Email" />
                            <select class="ddl" id="ddli">
                            <?php
                                $upituloge = "SELECT * from uloge";
                                $rez = $konekcija->query($upituloge)->fetchAll();
                                foreach($rez as $uloga):
                            ?>
                                <option value="<?= $uloga->idUloge ?>"> <?= $uloga->naziv ?></option>
                                <?php endforeach;?>
                            </select>
                            <input type="button" id="addKor" name="addKor" value="ADD"/>
                        </form>
                        <p id="inserterror"></p> 
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <form>      
                            <select class="ddl" id="korisnici" nema="korisnici">
                            <?php
                                $upituloge = "SELECT idKorisnik, ime FROM korisnici ORDER BY idKorisnik";
                                $rez = $konekcija->query($upituloge)->fetchAll();
                                foreach($rez as $kor):
                            ?>
                                <option value="<?= $kor->idKorisnik ?>">  <?= $kor->idKorisnik ?>&nbsp;<?= $kor->ime ?></option>
                            <?php endforeach;?>
                            </select>
                            <input name="nameu" id="nameu" type="text" class="feedback-input" placeholder="Name" value="" />   
                            <input name="surnameu" id="surnameu" type="text" class="feedback-input" placeholder="Surname" /> 
                            <input name="passu" id="passu" type="text" class="feedback-input" placeholder="Password" />
                            <input name="emailu" id="emailu"type="text" class="feedback-input" placeholder="Email" />
                            <select class="ddl" id="ddlu" name="ddlu">
                            <?php
                                $upituloge = "SELECT * from uloge";
                                $rez = $konekcija->query($upituloge)->fetchAll();
                                foreach($rez as $uloga):
                            ?>
                                <option value="<?= $uloga->idUloge ?>"> <?= $uloga->naziv ?></option>
                            <?php endforeach;?>
                            </select>
                            <input type="button" value="UPDATE" id="updateKor" name="updateKor"/>
                        </form>  
                        <p id="upderror"></p> 
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>RoleId</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select = "SELECT * FROM korisnici k INNER JOIN uloge u ON k.ulogaId=u.idUloge";
                                    $kor = $konekcija->query($select)->fetchAll();
                                    foreach($kor as $k):
                                ?>
                                    <tr>
                                        <td><?= $k->idKorisnik ?></td>
                                        <td><?= $k->ime ?></td>
                                        <td><?= $k->prezime ?></td>
                                        <td><?= $k->sifra ?></td>
                                        <td><?= $k->email ?></td>
                                        <td><?= $k->naziv ?></td>
                                        <td><a href="models/obrisiKor.php?id=<?= $k->idKorisnik ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-md-6 col-sm-6">
                        <h2>Posts</h2>
                        <form action="models/insertPost.php" method="POST" enctype="multipart/form-data" onsubmit="return proveriIns();">      
                            <input name="naslovp" id="naslovp" type="text" class="feedback-input" placeholder="Title" />   
                            <textarea name="textp" id="textp" class="feedback-input" placeholder="Text"></textarea> 
                            <input name="imagesp" id="imagesp" type="file" class="feedback-input" />
                            <input name="altp" id="altp" type="text" class="feedback-input" placeholder="Alt" />
                            <input name="datump" id="datump" type="text" class="feedback-input" placeholder="YYYY-MM-DD" />
                            <select class="ddl" id="userPost" name="userPost">
                            <?php
                                $upit= "SELECT * FROM korisnici ORDER BY idKorisnik";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $kor):
                            ?>
                                <option value="<?= $kor->idKorisnik ?>">  <?= $kor->ime ?></option>
                            <?php endforeach;?>
                            </select>
                            <input type="submit" value="ADD" id="addPost" name="addPost"/>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <form action="models/updatePost.php" method="POST" enctype="multipart/form-data" onsubmit="return proveriUpd();">      
                            <select class="ddl" id="postovi" name="postovi">
                            <?php
                                $upit= "SELECT idPost FROM postovi ORDER BY idPost";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $post):
                            ?>
                                <option value="<?= $post->idPost ?>">  <?= $post->idPost ?></option>
                            <?php endforeach;?>
                            </select> 
                            <input name="naslov" id="naslov" type="text" class="feedback-input" placeholder="Title" />   
                            <textarea name="text" id="text" class="feedback-input" placeholder="Text"></textarea> 
                            <input name="images" id="images" type="file" class="feedback-input" />
                            <input name="alt" id="alt" type="text" class="feedback-input" placeholder="Alt" />
                            <input name="datum" id="datum" type="text" class="feedback-input" placeholder="YYYY-MM-DD" />
                            <select class="ddl" id="userPos" name="userPos">
                            <?php
                                $upit= "SELECT * FROM korisnici ORDER BY idKorisnik";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $kor):
                            ?>
                                <option value="<?= $kor->idKorisnik ?>">  <?= $kor->ime ?></option>
                            <?php endforeach;?>
                            </select>
                            <input type="submit" value="UPDATE"  id="updPost" name="updPost"/>
                        </form>   
                        <p id="updPostEr"> </p>
                    </div>
        
                    <div class="col-md-12 col-sm-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Text</th>
                                    <th>Images</th>
                                    <th>Alt</th>
                                    <th>Date</th>
                                    <th>User</th>>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike INNER JOIN korisnici k ON p.idKor=k.idKorisnik";
                                    $post = $konekcija->query($upit)->fetchAll();
                                    foreach($post as $p):
                                        $tekst=$p->tekst;
                                ?>
                                    <tr>
                                        <td><?= $p->idPost ?></td>
                                        <td class="tekstAdmin"><?= $p->naslov ?></td>
                                        <td class="tekstAdmin"><?php  substr("$tekst", 100)?></td>
                                        <td><img src='<?= $p->putanja ?>'/></td>
                                        <td><?= $p->alt ?></td>
                                        <td><?= $p->datum ?></td>
                                        <td><?= $p->ime ?></td>
                                        <td><a href="models/obrisiPost.php?id=<?= $p->idPost ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-6 col-sm-6">
                        <h2 id="commentsText">Comments</h2>
                        <form>      
                        <textarea name="text" id="textComment" class="feedback-input" placeholder="Comment"></textarea> 
                            <select class="ddl" id="ddlus">
                            <?php
                                $upit= "SELECT * FROM korisnici ORDER BY idKorisnik";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $kor):
                            ?>
                                <option value="<?= $kor->idKorisnik ?>">  <?= $kor->ime ?></option>
                            <?php endforeach;?>
                            </select>
                            <select class="ddl" id="ddlpos">
                            <?php
                                $upit= "SELECT * FROM postovi ORDER BY idPost";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $post):
                            ?>
                                <option value="<?= $post->idPost ?>">  <?= $post->naslov ?></option>
                            <?php endforeach;?>
                            </select>
                            <input type="button" value="ADD" id="insKom" name="insKom"/>
                        </form>
                        <p id="inscom"></p> 
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <form>      
                            <select class="ddl" id="komentari" nema="komentari">
                            <?php
                                $upit= "SELECT idKom FROM komentari ORDER BY idKom";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $kom):
                            ?>
                                <option value="<?= $kom->idKom ?>">  <?= $kom->idKom ?></option>
                            <?php endforeach;?>
                            </select> 
                            <textarea name="text" class="feedback-input" placeholder="Comment" id="com"></textarea> 
                            <select class="ddl" id="ddluser">
                            <?php
                                $upit= "SELECT * FROM korisnici ORDER BY idKorisnik";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $kor):
                            ?>
                                <option value="<?= $kor->idKorisnik ?>">  <?= $kor->ime ?></option>
                            <?php endforeach;?>
                            </select> 
                            <select class="ddl" id="ddlpost">
                            <?php
                                $upit= "SELECT * FROM postovi ORDER BY idPost";
                                $rez = $konekcija->query($upit)->fetchAll();
                                foreach($rez as $post):
                            ?>
                                <option value="<?= $post->idPost ?>">  <?= $post->naslov ?></option>
                            <?php endforeach;?>
                            </select> 
                            </select>
                            <input type="button" value="UPDATE" id="updKom" name="updKom"/>
                        </form>   
                        <p id="updcom"></p> 
                    </div>
                    
                    <div class="col-md-12 col-sm-12">
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Comment</th>
                                    <th>User</th>
                                    <th>Post</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $select = "SELECT * FROM komentari k INNER JOIN postovi p ON k.postId=p.idPost INNER JOIN korisnici ko ON k.korisnikId=ko.idKorisnik ORDER BY k.idKom";
                                    $kom = $konekcija->query($select)->fetchAll();
                                    foreach($kom as $k):
                                ?>
                                    <tr>
                                        <td><?= $k->idKom ?></td>
                                        <td><?= $k->sadrzaj ?></td>
                                        <td><?= $k->ime?></td>
                                        <td class="tekstAdmin"><?= $k->naslov ?></td>
                                        <td><a href="models/obrisiKom.php?id=<?= $k->idKom ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12">               
                    <h2>Contact</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Text</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $select = "SELECT * FROM kontakt";
                                    $kontakt = $konekcija->query($select)->fetchAll();
                                    foreach($kontakt as $item):
                                ?>
                                    <tr>
                                        <td><?= $item->idKontakt ?></td>
                                        <td><?= $item->ime ?></td>
                                        <td><?= $item->email?></td>
                                        <td class="tekstAdmin"><?= $item->tekst ?></td>
                                        <td><?= $item->vreme?></td>
                                        <td><a href="models/obrisiKontakt.php?id=<?= $item->idKontakt ?>">Delete</a></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12 col-sm-12">               
                    <h2>Pol</h2>
                    <p>Status: <?php $status=$konekcija->query("SELECT status from anketa")->fetch();  if($status->status==1){ echo "aktivna"; }else{ echo"Nije aktivna";}; ?></p>
                    <div id="pollStatusButton">
                        <a href="models/updatePollStatus.php?status=1"><button type="button">Aktivna</button></a><a href="models/updatePollStatus.php?status=2"><button type="button">Neaktivna</button></a>
                    </div>
                       <table>
                            <thead>
                                <tr>
                                    <th>Odgovor</th>
                                    <th>Broj odgovora</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $select = "SELECT * FROM kontakt";
                                    $kontakt = $konekcija->query("SELECT COUNT(o.odgovor) AS number, o.odgovor FROM korisnik_odgovor ko INNER JOIN odgovori o on ko.idOdgovor=o.idOdg GROUP BY o.odgovor");
                                    foreach($kontakt as $item):
                                ?>
                                    <tr>
                                        <td><?= $item->odgovor ?></td>
                                        <td><?= $item->number ?></td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>
               </div>

          </div>
     </div>
</section>

<!-- Footer Section -->

<?php 
     include "pages/footer.php";

endif;
endif;
?>
<script src="assets/js/admin.js"></script>