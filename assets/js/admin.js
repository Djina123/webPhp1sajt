$(document).ready(function() {

    $("#korisnici").change(function(){
        var id=$(this).val();
        //console.log(id);
        $.ajax({
            url:"models/ispisKor.php",
            method:"POST",
            data:{
                idKor:id,
                ok: true
            },
            success: function(data){
                console.log(data['ime']);
                document.getElementById("nameu").value=data['ime'];
                $("#surnameu").val(data['prezime']);
                $("#passu").val(data['sifra']);
                $("#emailu").val(data['email']);
                $("#ddlu").val(data['ulogaId']);
            },
            error: function(xhr, ajaxOptions, thrownError){
               console.log(xhr);
               console.log(ajaxOptions);
               console.log(thrownError);
            }
        })
    });

    $("#updateKor").click(function(){
            console.log("usao");
             let id= $("#korisnici").val();
             let ime = $("#nameu").val();
             let pre = $("#surnameu").val();
             let sifra = $("#passu").val();
             let mejl = $("#emailu").val();
             let uloga= $("#ddlu").val();
             var validno = true;
             let reimeprezime = /^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/; 
             let resifra = /^\S{6,30}$/; 
             let remejl = /^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/; 
            if(!reimeprezime.test(ime)){ 
                document.getElementById("upderror").innerHTML += "Name field is not in right format"; 
                validno = false;
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(ime == ""){ 
                document.getElementById("upderror").innerHTML += "Name field is empty"; 
                validno = false;
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(!reimeprezime.test(pre)){ 
                document.getElementById("upderror").innerHTML += "Surname field is not in right format"; 
                validno = false;
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(pre == ""){ 
                document.getElementById("upderror").innerHTML += "Surname field is empty"; 
                validno = false;
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            }
            if(!remejl.test(mejl)){ 
                document.getElementById("upderror").innerHTML += "Email isn't in right format"; 
                validno = false;
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(mejl == ""){ 
                document.getElementById("upderror").innerHTML += "Email field is empty"; 
                validno = false;
            }else{
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(!resifra.test(sifra)){ 
                document.getElementById("upderror").innerHTML += "Password is not in right format"; 
                validno = false; 
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(sifra == ""){ 
                document.getElementById("upderror").innerHTML += "Password is empty"; 
                validno = false;
            }else{ 
                document.getElementById("upderror").innerHTML += ""; 
            } 
            if(validno){
                console.log("usao u ajax");
                $.ajax({
                    url:"models/updateKor.php",
                    method:"POST",
                    data:{
                        id:id,
                        ime,ime,
                        pre:pre,
                        sifra:sifra,
                        mejl:mejl,
                        uloga:uloga,
                        updateKor:true
                    },
                    success: function(status,code){
                        console.log("success");
                        window.location.reload(true);
                    },
                    error: function(){
                        alert("NEUSPESNO");
                    }
                })
            }
    })
    
    $("#addKor").click(function(){
        console.log("usao");
         let ime = $("#name").val();
         let pre = $("#surname").val();
         let sifra = $("#pass").val();
         let mejl = $("#email").val();
         let uloga= $("#ddli").val();
         var validno = true;
         let reimeprezime = /^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/; 
         let resifra = /^\S{6,30}$/; 
         let remejl = /^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/; 
        if(!reimeprezime.test(ime)){ 
            document.getElementById("inserterror").innerHTML += "Name field is not in right format"; 
            validno = false;
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(ime == ""){ 
            document.getElementById("inserterror").innerHTML += "Name field is empty"; 
            validno = false;
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(!reimeprezime.test(pre)){ 
            document.getElementById("inserterror").innerHTML += "Surname field is not in right format"; 
            validno = false;
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(pre == ""){ 
            document.getElementById("inserterror").innerHTML += "Surname field is empty"; 
            validno = false;
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        }
        if(!remejl.test(mejl)){ 
            document.getElementById("inserterror").innerHTML += "Email isn't in right format"; 
            validno = false;
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(mejl == ""){ 
            document.getElementById("inserterror").innerHTML += "Email field is empty"; 
            validno = false;
        }else{
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(!resifra.test(sifra)){ 
            document.getElementById("inserterror").innerHTML += "Password is not in right format"; 
            validno = false; 
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(sifra == ""){ 
            document.getElementById("inserterror").innerHTML += "Password is empty"; 
            validno = false;
        }else{ 
            document.getElementById("inserterror").innerHTML += ""; 
        } 
        if(validno){
            console.log("usao u ajax");
            $.ajax({
                url:"models/insertKor.php",
                method:"POST",
                data:{
                    ime,ime,
                    pre:pre,
                    sifra:sifra,
                    mejl:mejl,
                    uloga:uloga,
                    insertKor:true
                },
                success: function(status,code){
                    console.log("success");
                    window.location.reload(true);
                },
                error: function(){
                    alert("NEUSPESNO");
                }
            })
        }
    })

    $("#komentari").change(function(){
        var id=$(this).val();
        console.log(id);
        $.ajax({
            url:"models/ispisKom.php",
            method:"POST",
            data:{
                id:id,
                ok: true
            },
            success: function(data){
                console.log(data);
                document.getElementById("com").value=data['sadrzaj'];
                $("#ddluser").val(data['korisnikId']);
                $("#ddlpost").val(data['postId']);
            },
            error: function(){
                alert("NEUSPESNO");
            }
        })
    })

    $("#updKom").click(function(){
         let id= $("#komentari").val();
         let kom = $("#com").val();
         let korisnik = $("#ddluser").val();
         let post = $("#ddlpost").val();
         var validno = true;
        if(kom == ""){ 
            document.getElementById("updcom").innerHTML = "Comment is empty"; 
            validno = false;
        }else{ 
            document.getElementById("updcom").innerHTML = ""; 
        } 
        if(validno){
            console.log("usao u ajax");
            $.ajax({
                url:"models/updateKom.php",
                method:"POST",
                data:{
                    id:id,
                    kom:kom,
                    korisnik:korisnik,
                    post:post,
                    updateKom:true
                },
                success: function(status,code){
                    console.log("success");
                    window.location.reload(true);
                },
                error: function(){
                    alert("NEUSPESNO");
                }
            })
        }
    })    

    $("#insKom").click(function(){
        let kom = $("#textComment").val();
        let korisnik = $("#ddlus").val();
        let post = $("#ddlpos").val();
        var validno = true;
       if(kom.lenght < 1){ 
           document.getElementById("inscom").innerHTML = "Comment is empty"; 
           validno = false;
       }else{ 
           document.getElementById("inscom").innerHTML = ""; 
       } 
       if(validno){
           console.log("usao u ajax");
           $.ajax({
               url:"models/insertKom.php",
               method:"POST",
               data:{
                   kom:kom,
                   korisnik:korisnik,
                   post:post,
                   insertKom:true
               },
               success: function(status,code){
                   console.log("success");
                   window.location.reload(true);
               },
               error: function(){
                   alert("NEUSPESNO");
               }
           })
       }
   }) 

   $("#postovi").change(function(){
    var id=$(this).val();
    //console.log(id);
        $.ajax({
            url:"models/ispisPostova.php",
            method:"POST",
            data:{
                id:id,
                ok: true
            },
            success: function(data){
                console.log(data);
                document.getElementById("naslov").value=data['naslov'];
                $("#text").val(data['tekst']);
                $("#alt").val(data['alt']);
                $("#datum").val(data['datum']);
                $("#userPos").val(data['idKor']);
            },
            error: function(xhr, ajaxOptions, thrownError){
            console.log(xhr);
            console.log(ajaxOptions);
            console.log(thrownError);
            }
        })
    });

   



})

function proveriIns(){
    return true;
        let naslov = $("#naslov").val();
        let text = $("#text").val();
        let alt = $("#alt").val();
        let datum= $("#datum").val();
        let redatum = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/; 
        if(!redatum.test(datum)){ 
            document.getElementById("updPostEr").innerHTML += "Date is not in right format"; 
            return false;
        }else{ 
            document.getElementById("updPostEr").innerHTML += ""; 
        } 
        if(naslov == ""){ 
            document.getElementById("updPostEr").innerHTML += "Title field is empty"; 
            return false;
        }else{ 
            document.getElementById("updPostEr").innerHTML += ""; 
        }
        if(text == ""){ 
            document.getElementById("updPostEr").innerHTML += "Text is empty"; 
            return false;
        }else{
            document.getElementById("updPostEr").innerHTML += ""; 
        } 
        if(alt == ""){ 
            document.getElementById("updPostEr").innerHTML += "Alt is empty"; 
            return false;
        }else{ 
            document.getElementById("updPostEr").innerHTML += ""; 
        } 
        return true;
    
}

function proveriUpd() {
    console.log("usao");
    let id= $("#postovi").val();
    let naslov = $("#naslov").val();
    let text = $("#text").val();
    let alt = $("#alt").val();
    let datum= $("#datum").val();
    let user = $("#usePos").val();
    let img = $("#images");
    console.log(img);
    let redatum = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/; 
    if(!redatum.test(datum)){ 
        document.getElementById("updPostEr").innerHTML += "Date is not in right format"; 
        return false;
    }else{ 
        document.getElementById("updPostEr").innerHTML += ""; 
    } 
    if(datum == ""){ 
        document.getElementById("updPostEr").innerHTML += "Date is empty"; 
        return false;
    }else{ 
        document.getElementById("updPostEr").innerHTML += ""; 
    } 
    if(naslov == ""){ 
        document.getElementById("updPostEr").innerHTML += "Title field is empty"; 
        return false;
    }else{ 
        document.getElementById("updPostEr").innerHTML += ""; 
    }
    if(text == ""){ 
        document.getElementById("updPostEr").innerHTML += "Text is empty"; 
        return false;
    }else{
        document.getElementById("updPostEr").innerHTML += ""; 
    } 
    if(alt == ""){ 
        document.getElementById("updPostEr").innerHTML += "Alt is empty"; 
        return false;
    }else{ 
        document.getElementById("updPostEr").innerHTML += ""; 
    } 
    return true;
}