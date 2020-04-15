$("document").ready(function(){
    $("#cargando").hide();
    //alert("pr");
    $("form").submit(function(event){
        event.preventDefault();
        //alert("pr");
        $.ajax({
            beforeSend:function(){
                $("#cargando").show("slow");
            
            },
    
            url:"correo.php",
            type:"POST",
            data:$("form").serialize(),
            
            success:function(resp){
                if(resp==1){
                    $("#cargando").hide("slow");
                    $('.modal').modal('show');
                    
                    
    
                }
                else if(resp==2){   
                    
                    $(".modal").show();
                    $("#mensajeMostrado").html("ERROR EN ENVIO REVISE SU CORREO")
                    //$("#icono").attr("src","icon/X.svg");
                    $("#cargando").hide("slow");
                }
                else{
                    alert("ERROR");
                }
    
            },
            error:function(error){
                $(".model").show();
                $("#mensajeMostrado").html("ERROR EN ENVIO REVISE SU CORREO");
                //$("#icono").attr("src","icon/X.svg");
                $("#cargando").hide("slow");
            },
            complete:function(){
                $("form")[0].reset();
            
            }
    
    
        })
    
    })

})


