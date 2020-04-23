$(document).ready(function(){
    document.getElementById("chk-password").checked=false;
});

// Funcion para activar evento onclick del boton Iniciar Sesion cuando se pulsa la tecla Enter
function pulsar(e){
    //Activar cuando se pulse la tecla enter y que no se active con la tecla Shift
    if (e.keyCode == 13 && !e.shiftKey) {
        e.preventDefault();
        var boton = document.getElementById("btn-login");
        angular.element(boton).triggerHandler('click');
    }
}

// Funcion a la que se llama cuando damos click al boton Iniciar Sesion para verificar si se ingresaron todos los campos requeridos
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

// Funcion para verificar si el campo esta vacio o no
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

//Funcion para verificar si el inicio de sesion es correcto, haciendo una peticion AJAX a loguear.php
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

// Funcion para mostrar contrasena dependiendo si se pulsa o no el input de tipo checkbox
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

