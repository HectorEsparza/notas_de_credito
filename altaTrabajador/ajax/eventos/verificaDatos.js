$(document).ready(function(){

  var solicitud = $("#solicitud"),
      acta = $("#acta"),
      ife = $("#ife"),
      domicilio = $("#domicilio"),
      seguro = $("#seguro"),
      curp = $("#curp"),
      rfc = $("#rfc"),
      penales = $("#penales"),
      fotos = $("#fotos"),
      estudios = $("#estudios"),
      infonavit = $("#infonavit"),
      adeudo = $("#adeudo");
      pdf = $("#pdf"),
      solicitudOculto = $(".solicitudOculto"),
      actaOculto = $(".actaOculto"),
      domicilioOculto = $(".domicilioOculto"),
      rfcOculto = $(".rfcOculto"),
      estudiosOculto = $(".estudiosOculto"),
      seguroOculto = $(".seguroOculto"),
      curpOculto = $(".curpOculto"),
      infonavitOculto = $(".infonavitOculto"),
      telefono = $("#telefono"),
      telefonoEmergencia = $("#telefonoEmergencia"),
      fechaNacimiento = $("#fechaNacimiento");

      solicitudOculto.hide();
      actaOculto.hide();
      domicilioOculto.hide();
      rfcOculto.hide();
      estudiosOculto.hide();
      seguroOculto.hide();
      curpOculto.hide();
      infonavitOculto.hide();

      // $("#salarioDiario").val(solicitud[4]);
      // $("#nombre").val(solicitud[5]);
      // $("#fechaNacimiento").val(solicitud[6]);
      // $("#seguridadSocial").val(solicitud[7]);
      // $("#rfcCaptura").val(solicitud[8]);
      // $("#curpCaptura").val(solicitud[9]);
      // $("#domicilioCaptura").val(solicitud[10]);
      // $("#colonia").val(solicitud[11]);
      // $("#cp").val(solicitud[12]);
      // $("#poblacion").val(solicitud[13]);
      // $("#correo").val(solicitud[14]);
      // $("#personaEmergencia").val(solicitud[15]);
      // $("#telefonoEmergencia").val(solicitud[16]);
      // if($("#infonavit").val()=="SI"){
      //   $("#prueba").text(solicitud[17]);
      // }

      if(solicitud.val()=="SI"){
        solicitudOculto.show();
        solicitud.prop("disabled", true);
      }
      else{
        solicitudOculto.hide();
      }

      if(acta.val()=="SI"&&ife.val()=="SI"){
        actaOculto.show();
        acta.attr("disabled", true);
        ife.attr("disabled", true);
      }
      else{
        actaOculto.hide();
      }

      if(domicilio.val()=="SI"){
         domicilioOculto.show();
         domicilio.attr("disabled", true);
      }
      else{
         domicilioOculto.hide();
      }

      if(seguro.val()=="SI"){
         seguroOculto.show();
         seguro.attr("disabled", true);
      }
      else{
         seguroOculto.hide();
      }

      if(curp.val()=="SI"){
        curpOculto.show();
        curp.attr("disabled", true);
      }
      else{
        curpOculto.hide();
      }

      if(rfc.val()=="SI"){
        rfcOculto.show();
        rfc.attr("disabled", true);
      }
      else{
        rfcOculto.hide();
      }

      // if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
      //   estudiosOculto.show();
      //   penales.attr("disabled", true);
      //   estudios.attr("disabled", true);
      //   fotos.attr("disabled", true);
      // }
      // else{
      //   estudiosOculto.hide();
      // }

      if(infonavit.val()=="SI"){
        infonavitOculto.show();
        infonavit.attr("disabled", true);
      }
      else{
        infonavitOculto.hide();
      }

      if(adeudo.val()=="SI"){
        adeudo.attr("disabled", true);
      }

      pdf.change(function(){
        console.log("estamos dentro!!!");
        var archivo = pdf.val();
        arreglo = archivo.split("\\");
        arreglo = arreglo[arreglo.length-1];
        //alert("Introduciste el archivo "+arreglo+" y el tamaño es de "+arreglo.length);
        arreglo = arreglo.split(".");
        arreglo = arreglo[1];
        if(arreglo!="pdf"){
          alert("Solamente se permiten archivos PDF");
          pdf.val("");
        }
      });
      solicitud.change(function(){
          if(solicitud.val()=="SI"){
            solicitudOculto.show();
          }
          else{
            solicitudOculto.hide();
          }
      });

      acta.change(function(){
          if(acta.val()=="SI"&&ife.val()=="SI"){
            actaOculto.show();
          }
          else{
            actaOculto.hide();
          }
      });

      ife.change(function(){
          if(acta.val()=="SI"&&ife.val()=="SI"){
            actaOculto.show();
          }
          else{
            actaOculto.hide();
          }
      });

      domicilio.change(function(){
          if(domicilio.val()=="SI"){
            domicilioOculto.show();
          }
          else{
            domicilioOculto.hide();
          }
      });

      seguro.change(function(){
          if(seguro.val()=="SI"){
            seguroOculto.show();
          }
          else{
            seguroOculto.hide();
          }
      });

      curp.change(function(){
          if(curp.val()=="SI"){
            curpOculto.show();
          }
          else{
            curpOculto.hide();
          }
      });

      rfc.change(function(){
          if(rfc.val()=="SI"){
            rfcOculto.show();
          }
          else{
            rfcOculto.hide();
          }
      });

      penales.change(function(){
          if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
            estudiosOculto.show();
          }
          else{
            estudiosOculto.hide();
          }
      });

      fotos.change(function(){
          if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
            estudiosOculto.show();
          }
          else{
            estudiosOculto.hide();
          }
      });

      estudios.change(function(){
          if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
            estudiosOculto.show();
          }
          else{
            estudiosOculto.hide();
          }
      });

      infonavit.change(function(){
        if(infonavit.val()=="SI"){
          infonavitOculto.show();
        }
        else{
          infonavitOculto.hide();
        }

      });

      telefono.change(function(){

        if(telefono.val()==telefonoEmergencia.val()){
          alert("Introduzca un número diferente al de Emergencia");
          telefono.val("");
        }
      });

      telefonoEmergencia.change(function(){

        if(telefonoEmergencia.val()==telefono.val()){
          alert("Introduzca un número diferente al Personal");
          telefonoEmergencia.val("");
        }
      });

      fechaNacimiento.change(function(){

        var fecha = fechaNacimiento.val();
        fecha = fecha.split("/");
        if(fecha.length==3&&(fecha[0]>0&&fecha[0]<32)&&(fecha[1]>0&&fecha[1]<13)&&(fecha[2]>1949)){
          console.log("OK, fecha valida");
        }
        else{
          alert("Captura una fecha valida, por favor");
          fechaNacimiento.val("");
        }

      });


});
