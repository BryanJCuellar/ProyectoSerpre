$(document).ready(function(){
    document.getElementById("chk-Password").checked=false;
});
function CamposRequeridosRegistro(){
    var campos = [
        {campo:'Nombre',valido:false},
        {campo:'Apellido',valido:false},
        {campo:'FechaNacimiento',valido:false},
        {campo:'Username',valido:false},
        {campo:'Email',valido:false},
        {campo:'Password',valido:false}
    ];

    for (var i=0; i<campos.length;i++){
        campos[i].valido = validarCampoVacioRegistro(campos[i].campo);
    }

    if(document.getElementById("Male").checked || document.getElementById("Female").checked || 
    document.getElementById("None").checked){
        document.getElementById("div-error-Genero").style.display = 'none';
    }else{
        document.getElementById("div-error-Genero").style.display = 'block';
    }

    //Con uno que no este valido ya debe mostrar el div-error
    for (var i=0; i<campos.length;i++){
        if (!campos[i].valido)
            return;
    }
    if(!(document.getElementById("Male").checked || document.getElementById("Female").checked || 
    document.getElementById("None").checked)){
        return;
    }
    //En este punto significa que todo esta bien
    guardarRegistro();
}

function validarCampoVacioRegistro(id){
    if (document.getElementById(id).value == ''){
        document.getElementById('div-error-'+id).style.display = 'block';
        document.getElementById(id).classList.add('input-error');
        return false;
    }
    document.getElementById('div-error-'+id).style.display = 'none';
    document.getElementById(id).classList.remove('input-error');
    return true;
}

function guardarRegistro(){
    var valorGenero;
    if(document.getElementById("Male").checked){
        valorGenero=document.getElementById("Male").value;
    }else if(document.getElementById("Female").checked){
        valorGenero=document.getElementById("Female").value;
    }else if(document.getElementById("None").checked){
        valorGenero=document.getElementById("None").value;
    }
    var parametros="";
    parametros="nNombre="+$('#Nombre').val()+"&nApellido="+$('#Apellido').val()+"&nTelefono="+$('#Telefono').val()+
    "&nFechaNacimiento="+$('#FechaNacimiento').val()+"&nGenero="+valorGenero+"&nUsername="+$('#Username').val()+
    "&nEmail="+$('#Email').val()+"&nPassword="+$('#Password').val();
    /*if($('#Telefono').val() != ''){
        parametros="nNombre="+$('#Nombre').val()+"&nApellido="+$('#Apellido').val()+
        "&nTelefono="+$('#Telefono').val()+"&nFechaNacimiento="+$('#FechaNacimiento').val()+"&nGenero="+valorGenero+
        "&nUsername="+$('#Username').val()+"&nEmail="+$('#Email').val()+"&nPassword="+$('#Password').val();
    }*/
    //alert($('#FechaNacimiento').val());
    $.ajax({
        url:"ajax/registrar.php",
        method:"POST",
        data:parametros,
        dataType:"html",
        success:function(respuesta){
            //console.log(respuesta);
            alert(respuesta);
            if(respuesta=='Registro realizado con exito'){
                window.location.href="login.php#inicio-sesion";
            }
        },
        error:function(error){
            //console.log(error);
            alert(error);
        } 
    })
}

function mostrarContrasena(ID){
    var tipo = document.getElementById(ID);
    if (tipo.type == "password") {
        tipo.type = "text";
        document.getElementById("chk-Password").checked=true;
    } else if(tipo.type == "text"){
        tipo.type = "password";
        document.getElementById("chk-Password").checked=false;
    }
}