$(document).ready(function(){

  var linea = $("#linea"), sublinea = $("#sublinea"), descuentoApa = $("#descuentoApa"), descuentoVazlo = $("#descuentoVazlo"), descuentoAdicional = $("#descuentoAdicional");

  linea.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()>0&&descuentoVazlo.val()>0){
      // alert("Activado AJAX");
      enviar();
      //console.log(descuentoAdicional.prop("checked"));
    }
  });
  sublinea.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()>0&&descuentoVazlo.val()>0){
      // alert("Activado AJAX");
      enviar();
      //console.log(descuentoAdicional.prop("checked"));
    }
  });
  descuentoApa.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()>0&&descuentoVazlo.val()>0){
      // alert("Activado AJAX");
      enviar();
      //console.log(descuentoAdicional.prop("checked"));
    }
  });
  descuentoVazlo.change(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()>0&&descuentoVazlo.val()>0){
      // alert("Activado AJAX");
      enviar();
      //console.log(descuentoAdicional.prop("checked"));
    }
  });
  descuentoAdicional.click(function(){
    if(linea.val()!=""&&sublinea.val()!=""&&descuentoApa.val()>0&&descuentoVazlo.val()>0){
      // alert("Activado AJAX");
      enviar();
      //console.log(descuentoAdicional.prop("checked"));
    }
  });
  function enviar(){
    // var total = $("#totalNota").val();
    // var penalizacion = $("#penalizacionNota").val();
    // console.log(total);

    var parametros =
    {
      linea: linea.val(),
      sublinea: sublinea.val(),
      descuentoApa: descuentoApa.val(),
      descuentoVazlo: descuentoVazlo.val(),
      descuentoAdicional: descuentoAdicional.prop("checked"),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/consultas.php", //Sera el archivo que va a procesar la petición AJAX
        data: parametros, //Datos que le vamos a enviar
        // data: "total="+total+"&penalizacion="+penalizacion,
        beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
        success: llegada, //Función que se ejecuta en caso de tener exito
        timeout: 4000,
        error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    }).fail(function(jqXHR,textStatus,textError){
  		alert("Error al realizar la peticion dame".textError);
  	});
    return false;
  }
  function inicioEnvio(){
      var cargando = $("#cantidad");
      cargando.text("Cargando...");
  }

  function llegada(datos){
      //Vaciamos la información de consultas anteriores
      $("#tablaNivel").empty();
      $("#nivel").hide();
      //Solamente si existen datos se desplegarán en las tablas
      if(datos[0]>0){
        if(datos[1]>0){
          $("#porcentaje").css("color", "green");
          $("#cantidad").css("color", "green");
        }
        else if(datos[1]<0){
          $("#porcentaje").css("color", "red");
          $("#cantidad").css("color", "red");
        }
        $("#productos").text(datos[0]);
        $("#porcentaje").text(Math.round(datos[1])+"%");
        $("#cantidad").text(Math.round(datos[2]));
        $("#porcentajeCaro").text(Math.round(datos[3])+"%");
        $("#cantidadCaro").text(datos[4]);
        $("#porcentajeIgual").text(Math.round(datos[5])+"%");
        $("#cantidadIgual").text(datos[6]);
        $("#porcentajeBarato").text(Math.round(datos[7])+"%");
        $("#cantidadBarato").text(datos[8]);
        $("#totalPorcentaje").text("100%");
        $("#totalCantidad").text(datos[0]);
        console.log(datos[6]+" "+datos[8]);
        var porcentajeCaroA = 0;
        var porcentajeCaroB = 0;
        var porcentajeCaroC = 0;
        var porcentajeIgualA = 0;
        var porcentajeIgualB = 0;
        var porcentajeIgualC = 0;
        var porcentajeBaratoA = 0;
        var porcentajeBaratoB = 0;
        var porcentajeBaratoC = 0;
        // //Porcentajes por tipo de Productos Caros
        // if(datos[4]>0){
        //   porcentajeCaroA = Math.round(((datos[14][0]*100)/datos[4])*100)/100;
        //   porcentajeCaroB = Math.round(((datos[14][1]*100)/datos[4])*100)/100;
        //   porcentajeCaroC = Math.round(((datos[14][2]*100)/datos[4])*100)/100;
        // }
        //
        // //Porcentajes por tipo de Productos Iguales
        // if(datos[6]>0){
        //   porcentajeIgualA = Math.round(((datos[15][0]*100)/datos[6])*100)/100;
        //   porcentajeIgualB = Math.round(((datos[15][1]*100)/datos[6])*100)/100;
        //   porcentajeIgualC = Math.round(((datos[15][2]*100)/datos[6])*100)/100;
        // }
        //
        // //Porcentajes por tipo de Productos Baratos
        // if(datos[8]>0){
        //   porcentajeBaratoA = Math.round(((datos[16][0]*100)/datos[8])*100)/100;
        //   porcentajeBaratoB = Math.round(((datos[16][1]*100)/datos[8])*100)/100;
        //   porcentajeBaratoC = Math.round(((datos[16][2]*100)/datos[8])*100)/100;
        // }

        //Porcentajes por tipo de Productos Caros
        if(datos[4]>0){
          porcentajeCaroA = Math.round((datos[14][0]*100)/datos[4]);
          porcentajeCaroB = Math.round((datos[14][1]*100)/datos[4]);
          porcentajeCaroC = Math.round((datos[14][2]*100)/datos[4]);
        }
        //Porcentajes por tipo de Productos Baratos
        if(datos[8]>0){
          porcentajeBaratoA = Math.round((datos[16][0]*100)/datos[8]);
          porcentajeBaratoB = Math.round((datos[16][1]*100)/datos[8]);
          porcentajeBaratoC = Math.round((datos[16][2]*100)/datos[8]);
        }

        $("#porcentajeCaroA").text(porcentajeCaroA+"%");
        $("#cantidadCaroA").text(datos[14][0]);
        $("#porcentajeCaroB").text(porcentajeCaroB+"%");
        $("#cantidadCaroB").text(datos[14][1]);
        $("#porcentajeCaroC").text(porcentajeCaroC+"%");
        $("#cantidadCaroC").text(datos[14][2]);
        $("#porcentajeIgualA").text(porcentajeIgualA+"%");
        $("#cantidadIgualA").text(datos[15][0]);
        $("#porcentajeIgualB").text(porcentajeIgualB+"%");
        $("#cantidadIgualB").text(datos[15][1]);
        $("#porcentajeIgualC").text(porcentajeIgualC+"%");
        $("#cantidadIgualC").text(datos[15][2]);
        $("#porcentajeBaratoA").text(porcentajeBaratoA+"%");
        $("#cantidadBaratoA").text(datos[16][0]);
        $("#porcentajeBaratoB").text(porcentajeBaratoB+"%");
        $("#cantidadBaratoB").text(datos[16][1]);
        $("#porcentajeBaratoC").text(porcentajeBaratoC+"%");
        $("#cantidadBaratoC").text(datos[16][2]);
        $("#totalPorcentajeA").text("100%");
        $("#totalCantidadA").text(datos[14][0]+datos[15][0]+datos[16][0]);
        $("#totalPorcentajeB").text("100%");
        $("#totalCantidadB").text(datos[14][1]+datos[15][1]+datos[16][1]);
        $("#totalPorcentajeC").text("100%");
        $("#totalCantidadC").text(datos[14][2]+datos[15][2]+datos[16][2]);
        $("#variacionPorcentajeCaro").text(Math.round(datos[18]));
        $("#variacionPorcentajeBarato").text(Math.round(datos[19]));
        $("#variacionPesosCaro").text(Math.round(datos[20]));
        $("#variacionPesosBarato").text(Math.round(datos[21]));

        // alert((porcentajeCaroA+porcentajeCaroB+porcentajeCaroC));
        //alert(datos[9][0]+" "+datos[9][1]);
        var cuerpoTabla = $("#tablaNivel");
        var caro = 0;
        var igual = 0;
        var barato = 0;

        for (var i = 0; i < datos[9].length; i++){
          //console.log(datos[9][i] +" "+ datos[10][i] +" "+datos[11][i] +" "+datos[12][i] +" "+datos[13][i]);
          if(datos[17][i]=="Caro"){
            $('<tr class="Caro">'+
                '<td>'+datos[9][i]+'</td>'+
                '<td>'+datos[10][i]+'</td>'+
                '<td>'+"$"+datos[11][i]+'</td>'+
                '<td>'+datos[12][i]+'</td>'+
                '<td>'+"$"+datos[13][i]+'</td>'+
              '</tr>').appendTo(cuerpoTabla);
              caro++;
          }
          else if(datos[17][i]=="Igual"){
            $('<tr class="Igual">'+
                '<td>'+datos[9][i]+'</td>'+
                '<td>'+datos[10][i]+'</td>'+
                '<td>'+"$"+datos[11][i]+'</td>'+
                '<td>'+datos[12][i]+'</td>'+
                '<td>'+"$"+datos[13][i]+'</td>'+
              '</tr>').appendTo(cuerpoTabla);
              igual++;
          }
          else if(datos[17][i]=="Barato"){
            $('<tr class="Barato">'+
                '<td>'+datos[9][i]+'</td>'+
                '<td>'+datos[10][i]+'</td>'+
                '<td>'+"$"+datos[11][i]+'</td>'+
                '<td>'+datos[12][i]+'</td>'+
                '<td>'+"$"+datos[13][i]+'</td>'+
              '</tr>').appendTo(cuerpoTabla);
              barato++;
          }


        }
        console.log("Caro: "+caro+" Igual: "+igual+" Barato: "+barato);

        console.log("Caros por nivel de importancia");
        console.log("A: "+datos[14][0]+" B: "+datos[14][1]+" C: "+datos[14][2]);
        console.log("Iguales por nivel de importancia");
        console.log("A: "+datos[15][0]+" B: "+datos[15][1]+" C: "+datos[15][2]);
        console.log("Baratos por nivel de importancia");
        console.log("A: "+datos[16][0]+" B: "+datos[16][1]+" C: "+datos[16][2]);
        // console.log(datos[9][0] +" "+ datos[10][0] +" "+datos[11][0] +" "+datos[12][0] +" "+datos[13][0]);

      }
      //Si no hay datos mandaremos una alerta
      else{

        $("#productos").text("");
        $("#porcentaje").text("");
        $("#cantidad").text("");
        $("#porcentajeCaro").text("");
        $("#cantidadCaro").text("");
        $("#porcentajeIgual").text("");
        $("#cantidadIgual").text("");
        $("#porcentajeBarato").text("");
        $("#cantidadBarato").text("");
        $("#totalPorcentaje").text("");
        $("#totalCantidad").text("");
        alert("No se encontraron productos en la consulta");

      }


  }

  function problemas(){
      $("#cantidad").text("Problemas en el servidor");
  }
});
