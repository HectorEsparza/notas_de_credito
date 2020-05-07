$(document).ready(function(){
  var formatNumber = {
     separador: ",", // separador para los miles
     sepDecimal: '.', // separador para los decimales
     formatear:function (num){
     num +='';
     var splitStr = num.split('.');
     var splitLeft = splitStr[0];
     var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
     var regx = /(\d+)(\d{3})/;
     while (regx.test(splitLeft)) {
     splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
     }
     return this.simbol + splitLeft +splitRight;
     },
     new:function(num, simbol){
     this.simbol = simbol ||'';
     return this.formatear(num);
     }
  }

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


  $('#fechaFin').datepicker({
      //dateFormat:'yy-mm-dd'
      //dateFormat: 'dd-mm-yy'
      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      dateFormat: 'dd/mm/yy',
      changeMonth: false,
      changeYear: false,
      dayNamesMin: abrevia_dias,
      selectOtherMonths: true,
  });

  $("#buscar").click(function(){
    if($("#idContado").val()!="" || $("#fecha").val()!="" || $("#fechaFin").val()!=""){
      enviar();
    }
    else{
      alert("Captura al menos un campo, por favor");
    }

  });

  function enviar(){
    var idContado = $("#idContado").val();
    var fecha = $("#fecha").val();
    var fechaFin = $("#fechaFin").val();

    var parametros =
    {
      idContado: idContado,
      fecha: fecha,
      fechaFin: fechaFin,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/filtroContado.php", //Sera el archivo que va a procesar la petición AJAX
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
      console.log("Cargando...");
  }

  function llegada(datos){
    $("#table").empty();
    $("#paginador").empty();
    console.log(datos.length);
    var datosLength = datos.length;
    var contador = 1;
    //console.log(datos[0]+" "+datos[1]+" "+datos[2]);
    if(datos[0].clave==""){
      //alert("No se encontraron datos en la Consulta");
      $('<tr>'+
          '<td colspan="5">No se encontraron datos en la consulta</td>'+
        '</tr>').appendTo($("#table"));
    }
    else{
      for (var i = 0; i < datos.length; i++) {
          var click = "ver(document.getElementById('folio"+contador+"').innerText)";
          $('<tr>'+
            '<td id="folio'+contador+'">'+datos[i].folio+'</td>'+
            '<td>'+datos[i].fecha+'</td>'+
            '<td>$'+formatNumber.new(datos[i].total)+'</td>'+
            '<td>'+datos[i].usuario+'</td>'+
            '<td><input type="button" class="btn btn-info btn-sm" value="Ver" onclick='+click+' /></td>'+
          '</tr>').appendTo($("#table"));
          contador++;
      }
    }
  }

  function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
  }
});
