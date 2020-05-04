/*$(document).ready(function(){
    linkCategoria();
});*/

// Funcion para mostrar el formulario de publicar servicio
function mostrarFormularioPublicarServicio(){
    $("#div-link-publish").empty();
    $("#div-link-publish").append(`
    <a class="anchor-custom font-s-20" onclick="javascript:ocultarFormularioPublicarServicio();" ><i class="fas fa-sort-down"></i>&nbsp;&nbsp;Publicar un nuevo servicio</a>
    `);
    $("#id-form-publish").show(500);
}

// Funcion para ocultar el formulario de publicar servicio
function ocultarFormularioPublicarServicio(){
    $("#div-link-publish").empty();
    $("#div-link-publish").append(`
    <a class="anchor-custom font-s-20" onclick="javascript:mostrarFormularioPublicarServicio();" ><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Publicar un nuevo servicio</a>
    `);
    $("#id-form-publish").hide(500);
}

//Funciones para ocultar y mostrar categorias
//Cursos
function mostrarCursos(){
    $("#div-link-cursos").empty();
    $("#div-link-cursos").append(`
        <a onclick="ocultarCursos();" class="anchor-custom font-s-24"><i class="fas fa-sort-down"></i>&nbsp;&nbsp;Cursos</a>
    `);
    $("#div-cursos").show(500);
}
function ocultarCursos(){
    $("#div-link-cursos").empty();
    $("#div-link-cursos").append(`
        <a onclick="mostrarCursos();"  class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Cursos</a>
    `);
    $("#div-cursos").hide(500);
}
//Tutorias
function mostrarTutorias(){
    $("#div-link-tutorias").empty();
    $("#div-link-tutorias").append(`
        <a onclick="ocultarTutorias();" class="anchor-custom font-s-24"><i class="fas fa-sort-down"></i>&nbsp;&nbsp;Tutorias</a>
    `);
    $("#div-tutorias").show(500);
}
function ocultarTutorias(){
    $("#div-link-tutorias").empty();
    $("#div-link-tutorias").append(`
        <a onclick="mostrarTutorias();"  class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Tutorias</a>
    `);
    $("#div-tutorias").hide(500);
}
//Articulos
function mostrarArticulos(){
    $("#div-link-articulos").empty();
    $("#div-link-articulos").append(`
        <a onclick="ocultarArticulos();" class="anchor-custom font-s-24"><i class="fas fa-sort-down"></i>&nbsp;&nbsp;Articulos de segunda mano</a>
    `);
    $("#div-articulos").show(500);
}
function ocultarArticulos(){
    $("#div-link-articulos").empty();
    $("#div-link-articulos").append(`
        <a onclick="mostrarArticulos();"  class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Articulos de segunda mano</a>
    `);
    $("#div-articulos").hide(500);
}
//Eventos
function mostrarEventos(){
    $("#div-link-eventos").empty();
    $("#div-link-eventos").append(`
        <a onclick="ocultarEventos();" class="anchor-custom font-s-24"><i class="fas fa-sort-down"></i>&nbsp;&nbsp;Eventos</a>
    `);
    $("#div-eventos").show(500);
}
function ocultarEventos(){
    $("#div-link-eventos").empty();
    $("#div-link-eventos").append(`
        <a onclick="mostrarEventos();"  class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Eventos</a>
    `);
    $("#div-eventos").hide(500);
}
//Reparaciones
function mostrarReparaciones(){
    $("#div-link-reparaciones").empty();
    $("#div-link-reparaciones").append(`
        <a onclick="ocultarReparaciones();" class="anchor-custom font-s-24"><i class="fas fa-sort-down"></i>&nbsp;&nbsp;Reparaciones</a>
    `);
    $("#div-reparaciones").show(500);
}
function ocultarReparaciones(){
    $("#div-link-reparaciones").empty();
    $("#div-link-reparaciones").append(`
        <a onclick="mostrarReparaciones();"  class="anchor-custom font-s-24"><i class="fas fa-caret-right"></i>&nbsp;&nbsp;Reparaciones</a>
    `);
    $("#div-reparaciones").hide(500);
}
//Funcion para ver mas detalle de la descripcion
function verMas(IdServicio){
    var parametros = "";
    parametros="nIdServicio="+IdServicio+"&nEstado="+"verMas";
    //Peticion AJAX
    $.ajax({
        url:"../ajax/descripcionServicio.php",
        method:"POST",
        data:parametros,
        dataType:"html",
        success:function(respuesta){
            //console.log(respuesta);
            //alert(respuesta);
            $("#desc"+IdServicio).empty();
            $("#desc"+IdServicio).append(`
                <div class="descripcion-servicio">`+respuesta+`</div>
                <div class="ver-mas"><a onclick="verMenos('`+IdServicio+`');">Ver menos</a></div>
            `);
        },
        error:function(error){
            //console.log(error);
            alert(error);
        } 
    })
}
//Funcion para ver menos detalle de la descripcion
function verMenos(IdServicio){
    var parametros = "";
    parametros="nIdServicio="+IdServicio+"&nEstado="+"verMenos";
    //Peticion AJAX
    $.ajax({
        url:"../ajax/descripcionServicio.php",
        method:"POST",
        data:parametros,
        dataType:"html",
        success:function(respuesta){
            //console.log(respuesta);
            //alert(respuesta);
            $("#desc"+IdServicio).empty();
            $("#desc"+IdServicio).append(`
                <div class="descripcion-servicio">`+respuesta+`</div>
                <div class="ver-mas"><a onclick="verMas('`+IdServicio+`');">Ver más</a></div>
            `);
        },
        error:function(error){
            //console.log(error);
            alert(error);
        } 
    })
}
//No disponible
function unavailable(){
    alert("No implementado aún");
}