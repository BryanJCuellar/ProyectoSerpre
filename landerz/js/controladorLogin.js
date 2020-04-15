$(document).ready(function(){
    document.getElementById("chk-password").checked=false;
});

function CamposRequeridosLogin(){
    var campos = [
        {campo:'email-username',valido:false},
        {campo:'password',valido:false}
    ];

    for(var i=0;i<campos.length;i++){
        campos[i].valido = validarCampoVacioLogin(campos[i].campo);
    }

    //Con uno que no este valido ya debe mostrar el Error-Login
    for (var i=0; i<campos.length;i++){
        if (!campos[i].valido)
            return;
    }
    //En este punto significa que todo esta bien
    guardarSesion();
}

function validarCampoVacioLogin(id){
    if (document.getElementById(id).value == ''){
        document.getElementById('Error-Login-'+id).style.display = 'block';
        document.getElementById(id).classList.add('input-error');
        return false;
    }
    document.getElementById('Error-Login-'+id).style.display = 'none';
    document.getElementById(id).classList.remove('input-error');
    return true;
}

function guardarSesion(){
    var parametros = "";
    parametros = "nEmailUsername="+$('#email-username').val()+"&nPassword="+$('#password').val();
    $.ajax({
        url:"sesion/loguear.php",
        method:"POST",
        data:parametros,
        dataType:"html",
        success:function(respuesta){
            //console.log(respuesta);
            if(respuesta == "Registro encontrado"){
                window.location.href="MenuPrincipal.php";  
            }else if(respuesta == "Acceso Denegado: Usuario/Email incorrecto u Contraseña incorrecta"){
                alert(respuesta);
            }else{
                console.log(respuesta);
            }
        },
        error:function(error){
            console.log(error);
        } 
    })
}

function mostrarContrasena(ID){
    var tipo = document.getElementById(ID);
    if (tipo.type == "password") {
        tipo.type = "text";
        document.getElementById("chk-password").checked=true;
    } else if(tipo.type == "text"){
        tipo.type = "password";
        document.getElementById("chk-password").checked=false;
    }
}

