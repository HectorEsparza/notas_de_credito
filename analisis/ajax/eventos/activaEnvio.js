$(document).ready(function(){

  // alert("Estamos dentro!!!");
  var idApa = $("#idApa"), descripcion = $("#descripcion"),
      precio = $("#precio"), linea = $("#linea"),
      sublinea = $("#sublinea"), idVazlo = $("#idVazlo"),
      idVazlo = $("#idVazlo"), precioVazlo = $("#precioVazlo"),
      boton = $("#envio");

      idApa.change(function(){
        if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
           linea.val()!=""&&sublinea.val()!=""){
             boton.prop("disabled", false);
        }
        else{
            boton.prop("disabled", true);
        }
       });
       descripcion.change(function(){
         if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
            linea.val()!=""&&sublinea.val()!=""){
              boton.prop("disabled", false);
         }
         else{
             boton.prop("disabled", true);
         }
        });
        precio.change(function(){
          if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
             linea.val()!=""&&sublinea.val()!=""){
               boton.prop("disabled", false);
          }
          else{
              boton.prop("disabled", true);
          }
         });
         linea.change(function(){
           if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
              linea.val()!=""&&sublinea.val()!=""){
                boton.prop("disabled", false);
           }
           else{
               boton.prop("disabled", true);
           }
          });
          sublinea.change(function(){
            if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
               linea.val()!=""&&sublinea.val()!=""){
                 boton.prop("disabled", false);
            }
            else{
                boton.prop("disabled", true);
            }
           });
           idVazlo.change(function(){

             if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
                linea.val()!=""&&sublinea.val()!=""&&idVazlo.val()==""){
                  boton.prop("disabled", false);
                  precioVazlo.val("");
                  precioVazlo.prop("readonly", true);
             }
             else{
                 boton.prop("disabled", true);
                 precioVazlo.prop("readonly", false);
             }

           });
           precioVazlo.change(function(){

             if(idApa.val()!=""&&descripcion.val()!=""&&precio.val()!=""&&
                linea.val()!=""&&sublinea.val()!=""&&idVazlo.val()!=""&&precioVazlo.val()!=""){
                  boton.prop("disabled", false);
             }
             else{
                 boton.prop("disabled", true);
             }

           });



});
