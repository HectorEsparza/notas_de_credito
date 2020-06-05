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
    if($("#factura").val()!="" || $("#cliente").val()!="" || $("#fecha").val()!="" || $("#fechaFin").val()!=""){
      enviar();
    }
    else{
      alert("Captura al menos un campo, por favor");
    }

  });

  function enviar(){
    var factura = $("#factura").val();
    var cliente = $("#cliente").val();
    var fecha = $("#fecha").val();
    var fechaFin = $("#fechaFin").val();

    var parametros =
    {
      factura: factura,
      cliente: cliente,
      fecha: fecha,
      fechaFin: fechaFin,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/filtroFacturasSinContado.php", //Sera el archivo que va a procesar la petición AJAX
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
    $("#scriptParaImpresion").empty();
    console.log(datos.length);
    var datosLength = datos.length;
    var contador = 1;
    //console.log(datos[0]+" "+datos[1]+" "+datos[2]);
    if(datos[0].clave==""){
      //alert("No se encontraron datos en la Consulta");
      $('<tr>'+
          '<td colspan="9">No se encontraron datos en la consulta</td>'+
        '</tr>').appendTo($("#table"));
    }
    else{
      $("#exportaExcel").show();
      for (var i = 0; i < datos.length; i++) {
        if(datos[i].folioCaja!=""){
          $('<tr>'+
            '<td>'+datos[i].clave+'</td>'+
            '<td>'+datos[i].cliente+'</td>'+
            '<td>'+datos[i].nombre+'</td>'+
            '<td>'+datos[i].estatus+'</td>'+
            '<td>'+datos[i].fecha+'</td>'+
            '<td>$'+formatNumber.new(datos[i].importe)+'</td>'+
            '<td>'+datos[i].vendedor+'</td>'+
            '<td>'+datos[i].descuento+'%</td>'+
            '<td><input type="button" class="btn btn-sm btn-info verImpresion" id="caja-'+datos[i].folioCaja+'" value="'+datos[i].folioCaja+'" /></td>'+
          '</tr>').appendTo($("#table"));
        }
        else{
          $('<tr>'+
            '<td>'+datos[i].clave+'</td>'+
            '<td>'+datos[i].cliente+'</td>'+
            '<td>'+datos[i].nombre+'</td>'+
            '<td>'+datos[i].estatus+'</td>'+
            '<td>'+datos[i].fecha+'</td>'+
            '<td>$'+formatNumber.new(datos[i].importe)+'</td>'+
            '<td>'+datos[i].vendedor+'</td>'+
            '<td>'+datos[i].descuento+'%</td>'+
            '<td></td>'+
          '</tr>').appendTo($("#table"));
        }
        
      }
    }
    $("#scriptParaImpresion").append('<script type="text/javascript" src="../js/verImpresion.js"></script>');
  }

  function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
  }
});
