$(document).ready(function() {
 
  $("#reg").click(function(){ 
    var ime=$("#ime").val(); 
    var prezime=$("#pre").val();  
    var email=$("#mejl").val(); 
    var lozinka=$("#pass").val(); 
    
    var reimeprez=/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/; 
    var repass=/^\S{6,30}$/; 
    var reEmail = /^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/; 
    var greske=[]; 
    if(!reimeprez.test(ime)) {
    greske.push("Name is incorrect"); 
    } 
    if(!reimeprez.test(prezime)) { 
      greske.push("Last name is incorrect"); 
    } 
    if(!repass.test(lozinka)) { 
      greske.push("Password is incorrect"); 
    } 
    if(!reEmail.test(email)) { 
      greske.push("Email is incorrect"); 
    } 
    if(greske.length>0){ 
      let ispis=`<ul>`; 
      for(let greska of greske){ 
        ispis+=`<li>${greska}</li>` 
      } 
      ispis+=`</ul>`;
      $("#poruka").html(ispis);
    } else{ 
      var obj={ ime:$("#ime").val(),                
                pre:$("#pre").val(),  
                mejl:$("#mejl").val(), 
                pass:$("#pass").val(), 
                flag:true };
      $.ajax({
      url : "models/registracija.php", 
      method : "POST", 
      data:obj, 
      success : function(data) { 
        $("#poruka").html("You have successfully created account");
        window.location="index.php";
      }, 
      error : function(xhr, status, error) { 
        var poruka="An error has occurred"; 
        switch(xhr.status){ 
          case 404:poruka="The page not found";break; 
          case 409:poruka="Email already exists";break; 
          case 422:poruka="Data is not valid";;break; 
          case 500:poruka="Error";break; } 
        $("#poruka").html(poruka); 
      } 
    }); 
    } 
  });


  $("#login").click(function(){
    var mejl = $("#email").val();
    var sifra = $("#sifra").val();
    var reEmail = /^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/;
    var validno = true;
    if(!reEmail.test(mejl.trim())){
    validno = false;
    }
    if(sifra == ""){
    validno = false;
    }
    if(validno){
      $.ajax({
      url:"models/logovanje.php",
      method:"post",
      dataType:"json",
      data:{
        email:mejl,
        sifra:sifra,
        login:true
      },
      success: function(data){
        if(data.ulogaId=="2"){
            window.location.replace("admin.php");
        }else{
            window.location.replace("index.php");
        }
      },
      error: function(){
      alert("NEUSPESNO");
      }
    })
    }
    else{
    var greska = $("#greska");
    greska.innerHTML = "There is no user with the data! Register now."
    }
  })

  $("#posalji").click(function(){
    var validno = true;
    var gre=[];
    var ime = $("#name").val();
    var reIme = /^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/;
    if(!reIme.test(ime)){
      validno = false;
      gre.push("Name is incorrect"); 
    }
    var email = $("#email").val();
    var reEmail =  /^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/;
    if(!reEmail.test(email)){
      validno = false;
      gre.push("Email is incorrect"); 
    }
    var poruka=$("#message").val();
    if(poruka == ""){
      validno = false;
      gre.push("Message is empty"); 
      }
    if(!validno){
      let ispis=`<ul>`; 
      for(let g of gre){ 
        ispis+=`<li>${g}</li>`
      } 
      ispis+=`</ul>`;
      $("#gre").html(ispis);
    }
    else{
      $.ajax({
        url:"models/kontakt.php",
        method:"post",
        type:"json",
        data:{
          ime:ime,
          email:email,
          poruka:poruka,
          posalji: true
        },
        success: function(data){
          alert("Poslato");
          window.location.reload(true);
        },
        error: function(){
        alert("NEUSPESNO");
        }
      })
    }
  })
    
  $("#komentar").click(function(){
    var komentar = $("#message").val();
    var validno = true;
    var hidden= $("#hidden").val();
    console.log(hidden);
    
    if(komentar == ""){
      validno = false;
      $("#kom").html("Message is empty");
    }
    else{
      validno = true;
      console.log("ok");
    }
    if(validno){
      console.log("poslato");
      $.ajax({
      url:"models/kom.php",
      method:"POST",
      data:{
        komentar:komentar,
        post:hidden,
        komentarisi: true
      },
      success: function(data,status,code){
        console.log(data);
        if(code.status==200){
          window.location.reload(true);
        }
      },
      error: function(){
        alert("NEUSPESNO");
      }
      })
    }
  });
  

});


$("#ddl").change(function(){
  var value=$(this).val();
  sort(value);
  
});

function sort(value){
  console.log(value);
  $.ajax({
      url:"models/sort.php",
      method:"POST",
      dataType: "json",
      data:{
        value:value,
        sort:true
      },
      success:function(data){
        console.log(data);
        var ispisi="";
        for(let post of data){
          ispisi+=`<div class='col-md-offset-1 col-md-10 col-sm-12'>
          <div class='blog-post-thumb'>
              <div class='blog-post-image'>
                  <a href='single-post.php?post=${post.idPost}'>
                      <img src='${post.putanja}' class='img-responsive' alt='${post.alt}'>
                  </a>
              </div>
              <div class='blog-post-title'>
                  <h3><a href='single-post.php?post=${post.idPost}'>${post.naslov}</a></h3>
              </div>
              <div class='blog-post-format'>
                  <span>${post.ime} ${post.prezime}</span>
                  <span><i class='fa fa-date'></i> ${post.datum}</span>
                  <p class='tekst'>${post.tekst}</p>
              </div>
              <div class='blog-post-des'>
                  <a href='single-post.php?post=${post.idPost}' class='btn btn-default'>Continue Reading</a>
              </div>
          </div>
          </div>
          `;
          $("#postoviIspis").html(ispisi);
        }

      },
      error:function(xhr, error, status){
          console.log(status);
          console.log(xhr);
          console.log(error);
      }
  });
}

