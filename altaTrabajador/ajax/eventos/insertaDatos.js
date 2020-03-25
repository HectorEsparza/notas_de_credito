$(document).ready(function(){
    var contadorDocumentos = $("#contadorDocumentos").val(),
        contadorSolicitud = $("#contadorSolicitud").val(),
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
    for (var i = 0; i < documentos.length; i++) {
      console.log("Documento "+i+" "+documentos[i]);
    }
    $("#solicitud").val(documentos[1]);
    $("#acta").val(documentos[2]);
    $("#ife").val(documentos[3]);
    $("#domicilio").val(documentos[4]);
    $("#seguro").val(documentos[5]);
    $("#curp").val(documentos[6]);
    $("#rfc").val(documentos[7]);
    //$("#penales").val(documentos[8]);
    // $("#fotos").val(documentos[9]);
    // $("#estudios").val(documentos[10]);
    $("#infonavit").val(documentos[11]);
    $("#adeudo").val(documentos[12]);

    //Insertamos datos de la tabla Solicitud
    if(solicitud[1]!=""){
      $("#fechaAlta").val(solicitud[1]);
      //$("#fechaAlta").attr("readonly", true);
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
      // $("#seguridadSocial").attr("readonly", true);
    }
    if(solicitud[9]!=""){
      $("#rfcCaptura").val(solicitud[9]);
      // $("#rfcCaptura").attr("readonly", true);
    }
    if(solicitud[10]!=""){
      $("#curpCaptura").val(solicitud[10]);
      // $("#curpCaptura").attr("readonly", true);
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
      console.log(solicitud[18]);
      $("#telefonoEmergencia").val(solicitud[17]);
      $("#telefonoEmergencia").attr("readonly", true);
    }
    if($("#infonavit").val()=="SI"){
      console.log(solicitud[18]);
      //$("#prueba").text("Nombre del archivo "+solicitud[18]);
      if(solicitud[18]!=""){
        var boton = "<a href='infonavit/"+solicitud[18]+"' target='_blank'><input type='button' value='Infonavit' class='btn btn-primary'/></a>";
        $("#prueba").html(boton);
      }
      else{
        $("#prueba").text("");
      }

    }
    $("#status").val(solicitud[19]);

    if(solicitud[20]!=""){
      $("#noEmpleado").val(solicitud[20]);
      $("#noEmpleado").attr("readonly", true);
    }
    if(solicitud[21]!=""){

      var boton = "<a href='contrato/"+solicitud[21]+"' target='_blank'><input type='button' value='Contrato' class='btn btn-primary'/></a>";
      $("#contratoFila").html(boton);
      $("#botonGuardar").hide();
      boton = "<td><a href='contrato/"+solicitud[21]+"' target='_blank'><input type='button' value='Contrato' class='btn btn-primary'/></a></td><td><a href='imss/"+solicitud[22]+"' target='_blank'><input type='button' value='IMSS' class='btn btn-primary'/></a></td>";
      $("#botones").html(boton);
    }
    if(solicitud[22]!=""){
      var boton = "<a href='imss/"+solicitud[22]+"' target='_blank'><input type='button' value='IMSS' class='btn btn-primary'/></a>";
      $("#imssFila").html(boton);
      $("#botonGuardar").hide();
      boton = "<td><a href='contrato/"+solicitud[21]+"' target='_blank'><input type='button' value='Contrato' class='btn btn-primary'/></a></td><td><a href='imss/"+solicitud[22]+"' target='_blank'><input type='button' value='IMSS' class='btn btn-primary'/></a></td>";
      $("#botones").html(boton);
    }
    if(solicitud[23]!=""){
      $("#siVale").val(solicitud[23]);
      $("#siVale").attr("readonly", true);
    }
    if(solicitud[20]!=""&&solicitud[21]!=""&&solicitud[22]!=""){
      //alert("Entramos");
      $("#final").attr("disabled", false);
    }
    if(solicitud[24]!=""){
      $("#bancomer").val(solicitud[24]);
      $("#bancomer").attr("readonly", true);
    }
    if(solicitud[19]!=""){
      $("#insertaEstatus").text(solicitud[19]);
    }
    if(solicitud[25]!=""){
      $("#salarioSemanal").val(solicitud[25]);
      $("#salarioSemanal").attr("readonly", true);
    }
    if(solicitud[26]!=""){
      $("#edoCivil").val(solicitud[26]);
      $("#edoCivil").attr("disabled", true);
    }
    if(solicitud[27]!=""){
      $("#sexo").val(solicitud[27]);
      $("#sexo").attr("disabled", true);
    }

    //Insertar el nombre del gerente que solicita la Alta
    var gerente = $("#firma").val();
    gerente = gerente.replace("_", " ");
    $("#solicitudGerente").text(gerente);






});
