$(function(){
    
    var producto = {        
        init : function() {
           this.ComboDependiente("#categoria", "#subcategoria", "--- Seleccionar ---", "/admin/categoria/get-categorias-ajax", "idcategoria", "descripcion");           
        },        
        ComboDependiente : function (c, cd, def, url, fieldv, fields) {            
            
            $(c).live("change blur", function(){
                
                var actual = $(this);
                
                if (actual.val() != 0) {                    
                    
                    $(cd).removeAttr("disabled");
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {
                           id : actual.val()
                        },
                        dataType: 'json',                        
                        success: function(data){
                                $(cd).html("<option value='0'> --Seleccionar-- </option>");
                                $.each(data, function(index, value){                                    
                                    $(cd).append("<option value='"+value[fieldv]+"'>"+value[fields]+"</option>");
                                });
                        }
                    });                    
                } else {
                    $(cd).html("");
                    $(cd).append("<option value='0'>-- Seleccionar--</option>");
                    $(cd).attr("disabled", "disabled");
                    
                    
                }
            });
       }
    };
    
    producto.init();
    
    
    
});

$("#fotoPrincipal").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':  case 'jpeg':   
            break;
        default:
            $(this).val('');
            // error message here
            alert("Archivos válidos gif | jpg | png");
            break;
    }
});

$("#foto1").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':  case 'jpeg':   
            break;
        default:
            $(this).val('');
            // error message here
            alert("Archivos válidos gif | jpg | png");
            break;
    }
});

$("#foto2").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':  case 'jpeg':   
            break;
        default:
            $(this).val('');
            // error message here
            alert("Archivos válidos gif | jpg | png");
            break;
    }
});

$("#foto3").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':  case 'jpeg':   
            break;
        default:
            $(this).val('');
            // error message here
            alert("Archivos válidos gif | jpg | png");
            break;
    }
});

$("#foto4").change(function() {

    var val = $(this).val();

    switch(val.substring(val.lastIndexOf('.') + 1).toLowerCase()){
        case 'gif': case 'jpg': case 'png':  case 'jpeg':   
            break;
        default:
            $(this).val('');
            // error message here
            alert("Archivos válidos gif | jpg | png");
            break;
    }
});
