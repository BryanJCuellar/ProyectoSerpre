/*$(document).ready(function(){
    
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

