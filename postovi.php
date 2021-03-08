<?php 

$upit ="SELECT * FROM postovi p INNER JOIN slike s ON p.slikaId=s.idSlike INNER JOIN korisnici k ON p.idKor=k.idKorisnik";
$rezultat = $konekcija->query($upit);
foreach($rezultat as $post){
$upit2 = "SELECT COUNT(k.idKom) as broj FROM komentari k INNER JOIN postovi p on p.idPost=k.postId where p.idPost=".$post->idPost;
$rezultat2 = $konekcija->query($upit2);
foreach($rezultat2 as $brojKom){
    echo "<div class='col-md-offset-1 col-md-10 col-sm-12'>
    <div class='blog-post-thumb'>
        <div class='blog-post-image'>
            <a href='single-post.php?post=$post->idPost'>
                <img src='$post->putanja' class='img-responsive' alt='$post->alt'>
            </a>
        </div>
        <div class='blog-post-title'>
            <h3><a href='single-post.php?post=$post->idPost'>$post->naslov</a></h3>
        </div>
        <div class='blog-post-format'>
            <span>$post->ime $post->prezime</span>
            <span><i class='fa fa-date'></i> $post->datum</span>
            <span><i class='fa fa-comment-o'></i> $brojKom->broj</span>
            <p class='tekst'>$post->tekst</p>
        </div>
        <div class='blog-post-des'>
            <a href='single-post.php?post=$post->idPost' class='btn btn-default'>Continue Reading</a>
        </div>
    </div>
    </div>";
}
}