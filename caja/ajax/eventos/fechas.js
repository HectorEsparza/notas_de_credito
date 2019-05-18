$(document).ready(function(){


  var abrevia_dias = ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"];
  $('#fecha').datepicker({
    //dateFormat:'yy-mm-dd'
    //dateFormat: 'dd-mm-yy'
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    dateFormat: 'dd/mm/yy',
    changeMonth: false,
    changeYear: false,
    dayNamesMin: abrevia_dias,
    selectOtherMonths: true,
  });

  $("#borraFecha").click(function(){
    // console.log("Prueba");
    $("#fecha").val("");
    $("#fechaDeCargas").text("");
    //Se bloquea la primera fila
    $("#factura1").prop("readonly", true);
    $("#metodo1").prop("disabled", true);
    $("#observaciones1").prop("readonly", true);
    //Borramos la fecha de carga
    $("#fechaCaptura").val("");
    //Borramos el folio de carga
    $("#folio").val("");
    //Bloqueamos el boton de Guardar
    $("#guardar").prop("disabled", true);


  });

  $("#fecha").change(function(){
    enviar();
  });

  function enviar(){
    // var total = $("#totalNota").val();
    // var penalizacion = $("#penalizacionNota").val();
    // console.log(total);
    var parametros =
    {
      fecha: $("#fecha").val(),
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/fechas.php", //Sera el archivo que va a procesar la petición AJAX
        data: parametros, //Datos que le vamos a enviar
        // data: "total="+total+"&penalizacion="+penalizacion,
        beforeSend: inicioEnvio, //Es la función que se ejecuta antes de empezar la transacción
        success: llegada, //Función que se ejecuta en caso de tener exito
        timeout: 4000,
        error: problemas //Función que se ejecuta si se tiene problemas al superar el timeout
    });
    return false;
  }
  function inicioEnvio(){
      var cargando = $("#fechaDeCargas");
      cargando.text("Cargando...");
  }

  function llegada(datos){
    //Combropamos si la fecha elegina en el reporte de cobranza esta disponible
    if(datos[1]=="fechaNoDisponoble"){
      $("#fecha").val("");
      $("#fechaDeCargas").text("");
      alert("La fecha elegida ya ha sido seleccionada en un reporte de cobranza anterior, elegir otra fecha por favor");
    }
    else{
      var fecha = $("#fecha").val();
      fecha = fecha.split("/");
      function diaSemana(dia,mes,anio,mesEspanol){
          var dias=["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
          let meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Augosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
          var dt = new Date(mes+' '+dia+', '+anio+' 12:00:00');
          document.getElementById('fechaDeCargas').innerHTML = "Reporte de Cobranza "+dias[dt.getUTCDay()]+" "+dia+" de "+meses[mesEspanol]+" "+anio+" "+"PB"+datos[0];
          //Guardamos la fecha de carga
          $("#fechaCaptura").val($("#fecha").val());
          //Guardamos el folio de carga
          console.log(datos[0]);
          $("#folio").val("PB"+datos[0]);


      };
      let meses = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
      var dia = fecha[0];
      var mes = meses[parseInt(fecha[1])-1];
      var anio= fecha[2];
      var mesEspanol = parseInt(fecha[1])-1;
      diaSemana(dia, mes,anio,mesEspanol);

      console.log("Cambio la fecha " + mes);
      //Activamos la primera fila, para poder introducir facturas
      $("#factura1").prop("readonly", false);
      $("#metodo1").prop("disabled", false);
      $("#observaciones1").prop("readonly", false);
      //Activamos el boton de Guardar, solo si la primera fila esta capturada
      if($("#factura1").val()!=""&&$("#cliente1").text()!=""){
        $("#guardar").prop("disabled", false);
      }

    }


  }

  function problemas(){
      $("#fechaDeCargas").text("Problemas en el Servidor");
  }

});
