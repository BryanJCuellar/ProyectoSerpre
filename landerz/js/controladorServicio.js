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
            console.log(error);
            //alert(error);
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
            console.log(error);
            //alert(error);
        } 
    })
}

//Funcion para abrir el modal de editar servicios
function abrirModalEditar(IdServicio){
    var parametros = "";
    parametros="idServicio="+IdServicio;
    /*console.log(parametros)*/
    //Peticion AJAX para obtener datos de servicio
    $.ajax({
        url:"../ajax/modificarServicio.php?accion=listar",
        method:"POST",
        data:parametros,
        dataType:"json",
        success:function(data){
            //console.log("datos: "+data);
            //alert(data);
            //ID_Servicio
            $("input[name='IDservicio']").val(data.result.ID_Servicio);
            //Categoria
            $("select[name='modal-categoria'] option").each(function(){
                if($(this).val() != data.result.ID_Categoria_Servicio){
                    $(this).attr("selected",false);;
                }
            });
            $("select[name='modal-categoria'] option[value="+data.result.ID_Categoria_Servicio+"]").attr("selected",true);
            //Nombre Servicio
            $("input[name='modal-servicio']").val(data.result.Nombre_Servicio);
            //Descripcion
            $("textarea[name='modal-descripcion']").val(data.result.Detalle_Descripcion);
            //Precio
            $("input[name='modal-precio']").val(data.result.Precio);
            //Moneda
            $("select[name='modal-moneda'] option").each(function(){
                if($(this).val() != data.result.Moneda){
                    $(this).attr("selected",false);
                }
            });
            $("select[name='modal-moneda'] option[value='"+data.result.Moneda+"']").attr("selected",true);
            //Disponibilidad
            if(data.result.Disponibilidad == "Disponible"){
                $("input[name='chk-disponible']").prop('checked',true);

            }else{
                $("input[name='chk-disponible']").prop('checked',false);
            }
        },
        error:function(error){
            console.log(error);
            //alert(error);
        } 
    })
    $("#editarServicio").modal("show");
}

//Funcion para eliminar servicios
function eliminarServicio(IdServicio){
    var parametros = "";
    //Confirm Box
    if(confirm("Seguro que desea eliminar el servicio?\nAviso: Esta acción es irreversible")){
        parametros="idServicio="+IdServicio;
        //Peticion AJAX para obtener datos de servicio
        $.ajax({
            url:"../ajax/modificarServicio.php?accion=eliminar",
            method:"POST",
            data:parametros,
            dataType:"html",
            success:function(respuesta){
                if(respuesta == "Servicio Eliminado con Exito"){
                    alert(respuesta);
                    window.location.href="../servicios/index.php";
                }
            },
            error:function(error){
                console.log(error);
                //alert(error);
            } 
        })
    }else{
        return;
    }
}

//No disponible
function unavailable(){
    alert("No implementado aún");
}

$(document).ready(function(){
    /*var form = $("#id-form-edit");
    form.submit(function(e){
        // prevent form submission
        e.preventDefault();
        // submit the form via Ajax
        var fd = new FormData();
        fd.append('file',)
        var parametro = "";
        parametro = "&id_Servicio="+ID_Servicio;
        $.ajax({
            url:form.attr('action'),
            method:form.attr('method'),
            contentType: 'multipart/form-data',
            processData:false,
            //dataType:"html",
            data:new FormData(this)+parametro,
            success:function(respuesta){
                //console.log(respuesta);
                alert(respuesta);
                
            },
            error:function(error){
                console.log(error);
                //alert(error);
            } 
        })

    });*/
    $("input[name='chk-modal']").click(function(){
        for(var i=0;i<=6;i++){
            if($("#chk-modal-"+i).is(':checked')){
                $("#fila-modal-"+i).show(500);
            }else{
                $("#fila-modal-"+i).hide(500);
            }
        }
    });
});