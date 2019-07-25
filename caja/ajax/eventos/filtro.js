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
  $('#fechaCorte').datepicker({
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
    if($("#factura").val()!=""||$("#cliente").val()!=""||$("#fecha").val()!=""||$("#fechaCorte").val()!=""||$("#pago").val()!=""||$("#folio").val()!=""){
        enviar();
    }
    else{
      alert("Al menos captura un campo");
    }

  });

  function enviar(){
    var factura = $("#factura").val();
    var cliente = $("#cliente").val();
    var fecha = $("#fecha").val();
    var fechaCorte = $("#fechaCorte").val();
    var pago = $("#pago").val();
    var folio = $("#folio").val();
    var tipo = $("#tipo").val();
    // var arreglo = [];
    // arreglo[0] = factura;
    // arreglo[1] = cliente;
    // arreglo[2] = fecha;
    // alert(factura+" "+cliente+" "+fecha);
    var parametros =
    {
      factura: factura,
      cliente: cliente,
      fecha: fecha,
      tipo: tipo,
      fechaCorte : fechaCorte,
      pago: pago,
      folio: folio,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/filtro.php", //Sera el archivo que va a procesar la petición AJAX
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
    if(datos[10]=="conEntrada"){
      if(datos[0]==0){
        //alert("No se encontraron datos en la Consulta");
        $('<tr>'+
            '<td colspan="11">No se encontraron datos en la consulta</td>'+
          '</tr>').appendTo($("#table"));
      }
      else{
        for(var i = 0; i < datos[0]; i++){
          $('<tr>'+
              '<td>'+datos[1][i]+'</td>'+
              '<td>'+datos[2][i]+'</td>'+
              '<td>'+datos[3][i]+'</td>'+
              '<td>'+datos[4][i]+'</td>'+
              '<td>'+datos[5][i]+'</td>'+
              '<td>$'+formatNumber.new(datos[6][i])+'</td>'+
              '<td>'+datos[7][i]+'</td>'+
              '<td>'+datos[8][i]+'%</td>'+
              '<td>'+datos[11][i]+'</td>'+
              '<td>'+datos[12][i]+'</td>'+
              '<td>'+datos[9][i]+'</td>'+
            '</tr>').appendTo($("#table"));
        }
      }
    }
    else if(datos[10]=="sinEntrada"){
      if(datos[0]==0){
        //alert("No se encontraron datos en la Consulta");
        $('<tr>'+
            '<td colspan="11">No se encontraron datos en la consulta</td>'+
          '</tr>').appendTo($("#table"));
      }
      else{
        for(var i = 0; i < datos[0]; i++){
          if(datos[4][i]=="Emitida"&&datos[9][i]==""){
            $('<tr>'+
                '<td>'+datos[1][i]+'</td>'+
                '<td>'+datos[2][i]+'</td>'+
                '<td>'+datos[3][i]+'</td>'+
                '<td>'+datos[4][i]+'</td>'+
                '<td>'+datos[5][i]+'</td>'+
                '<td>$'+formatNumber.new(datos[6][i])+'</td>'+
                '<td>'+datos[7][i]+'</td>'+
                '<td>'+datos[8][i]+'%</td>'+
                '<td>'+datos[11][i]+'</td>'+
                '<td>'+datos[12][i]+'</td>'+
                '<td>'+datos[9][i]+'</td>'+
              '</tr>').appendTo($("#table"));
          }
          else{
            $('<tr>'+
                '<td colspan="8">No se encontraron datos en la consulta</td>'+
              '</tr>').appendTo($("#table"));
          }
        }
      }
    }
  }

  function problemas(){
      console.log("Problemas en el Servidor...");
  }
});
