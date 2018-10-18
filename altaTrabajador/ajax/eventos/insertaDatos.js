$(document).ready(function(){
    var contadorDocumentos = 11,
        contadorSolicitud = 19,
        documentos = [],
        solicitud = [];

        for (var i = 1; i <= contadorDocumentos; i++){
          documentos[i] = $("#documentos"+i).val();
          console.log(documentos[i]);
        }

        for (var i = 1; i <= contadorSolicitud; i++){
          solicitud[i] = $("#solicitud"+i).val();
          console.log(solicitud[i]);
        }
    //Insertamos datos de la tabla Documentos
    $("#solicitud").val(documentos[1]);
    $("#acta").val(documentos[2]);
    $("#ife").val(documentos[3]);
    $("#domicilio").val(documentos[4]);
    $("#seguro").val(documentos[5]);
    $("#curp").val(documentos[6]);
    $("#rfc").val(documentos[7]);
    $("#penales").val(documentos[8]);
    $("#fotos").val(documentos[9]);
    $("#estudios").val(documentos[10]);
    $("#infonavit").val(documentos[11]);

    //Insertamos datos de la tabla Solicitud
    if(solicitud[1]!=""){




      $("#fechaAlta").val(solicitud[1]);
      $("#fechaAlta").attr("readonly", true);
    }
    if(solicitud[2]!=""){
      $("#vistaDepartamento").val(solicitud[2]);
      $("#vistaDepartamento").attr("readonly", true);
    }
    if(solicitud[3]!=""){
      $("#vistaPuesto").val(solicitud[3]);
      $("#vistaPuesto").attr("disabled", true);
    }
    if(solicitud[4]!=""){
      $("#salarioDiario").val(solicitud[4]);
      $("#salarioDiario").attr("readonly", true);
    }
    if(solicitud[5]!=""){
      $("#nombre").val(solicitud[5]);
      $("#nombre").attr("readonly", true);
    }
    if(solicitud[6]!=""){
      $("#fechaNacimiento").val(solicitud[6]);
      $("#fechaNacimiento").attr("readonly", true);
    }
    if(solicitud[7]!=""){
      $("#telefono").val(solicitud[7]);
      $("#telefono").attr("readonly", true);
    }
    if(solicitud[8]!=""){
      $("#seguridadSocial").val(solicitud[8]);
      $("#seguridadSocial").attr("readonly", true);
    }
    if(solicitud[9]!=""){
      $("#rfcCaptura").val(solicitud[9]);
      $("#rfcCaptura").attr("readonly", true);
    }
    if(solicitud[10]!=""){
      $("#curpCaptura").val(solicitud[10]);
      $("#curpCaptura").attr("readonly", true);
    }
    if(solicitud[11]!=""){
      $("#domicilioCaptura").val(solicitud[11]);
      $("#domicilioCaptura").attr("readonly", true);
    }
    if(solicitud[12]!=""){
      $("#colonia").val(solicitud[12]);
      $("#colonia").attr("readonly", true);
    }
    if(solicitud[13]!=""){
      $("#cp").val(solicitud[13]);
      $("#cp").attr("readonly", true);
    }
    if(solicitud[14]!=""){
      $("#poblacion").val(solicitud[14]);
      $("#poblacion").attr("readonly", true);
    }
    if(solicitud[15]!=""){
      $("#correo").val(solicitud[15]);
      $("#correo").attr("readonly", true);
    }
    if(solicitud[16]!=""){
      $("#personaEmergencia").val(solicitud[16]);
      $("#personaEmergencia").attr("readonly", true);
    }
    if(solicitud[17]!=""){
      $("#telefonoEmergencia").val(solicitud[17]);
      $("#telefonoEmergencia").attr("readonly", true);
    }
    if($("#infonavit").val()=="SI"){
      $("#prueba").text(solicitud[18]);
    }
    $("#status").val(solicitud[19]);





});
