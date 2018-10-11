$(document).ready(function(){

  var fechaAlta = $("#fechaAlta"),
      salarioDiario = $("#salarioDiario"),
      nombre = $("#nombre"),
      fechaNacimiento = $("#fechaNacimiento"),
      seguridadSocial = $("#seguridadSocial"),
      rfcCaptura = $("#rfcCaptura"),
      curpCaptura = $("#curpCaptura"),
      domicilioCaptura = $("#domicilioCaptura"),
      colonia = $("#colonia"),
      cp = $("#cp"),
      poblacion = $("#poblacion"),
      correo = $("#correo"),
      personaEmergencia = $("#personaEmergencia"),
      telefonoEmergencia = $("#telefonoEmergencia"),
      pdf = $("#pdf");

   $("#boton").hide();

   fechaAlta.change(function(){

     var fecha = fechaAlta.val();
     fecha = fecha.split("/");
     if(fecha.length==3&&(fecha[0]>0&&fecha[0]<32)&&(fecha[1]>0&&fecha[1]<13)&&(fecha[2]>2017)){
       console.log("OK, fecha valida");
     }
     else{
       alert("Captura una fecha valida, por favor");
       fechaAlta.val("");
     }
     if(fechaAlta.val()!=""&&salarioDiario.val()!=""&&nombre.val()!=""&&fechaNacimiento.val()!=""&&seguridadSocial.val()!=""&&rfcCaptura.val()!=""&&
        curpCaptura.val()!=""&&domicilioCaptura.val()!=""&&colonia.val()!=""&&cp.val()!=""&&poblacion.val()!=""&&correo.val()!=""&&
        personaEmergencia.val()!=""&&telefonoEmergencia.val()!=""){
          $("#boton").show();
        }

   });
   $("#boton").click(function(){


  });


});
