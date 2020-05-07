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
    if($("#factura").val()!=""||$("#cliente").val()!=""||$("#fecha").val()!=""||$("#fechaCorte").val()!=""||$("#folio").val()!=""){
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
      folio: folio,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/filtroFacturas.php", //Sera el archivo que va a procesar la petición AJAX
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
    $("#exportaExcel").show();

      if(datos.contador==0){
        //alert("No se encontraron datos en la Consulta");
        $('<tr>'+
            '<td colspan="10">No se encontraron datos en la consulta</td>'+
          '</tr>').appendTo($("#table"));
      }
      else{
        //console.log(datos[4][0]+datos[4][1]+datos[4][2]);
        for(var i = 0; i < datos.contador; i++){
          if(datos.fechaCorte[i]!=null){
            $('<tr>'+
                '<td>'+datos.factura[i]+'</td>'+
                '<td>'+datos.cliente[i]+'</td>'+
                '<td>'+datos.nombre[i]+'</td>'+
                '<td>'+datos.estatus[i]+'</td>'+
                '<td>'+datos.fecha[i]+'</td>'+
                '<td>$'+formatNumber.new(datos.importe[i])+'</td>'+
                '<td>'+datos.vendedor[i]+'</td>'+
                '<td>'+datos.descuento[i]+'%</td>'+
                '<td>'+datos.fechaCorte[i]+'</td>'+
                '<td>'+datos.entrada[i]+'</td>'+
              '</tr>').appendTo($("#table"));
          }
          else{
            $('<tr>'+
                '<td>'+datos.factura[i]+'</td>'+
                '<td>'+datos.cliente[i]+'</td>'+
                '<td>'+datos.nombre[i]+'</td>'+
                '<td>'+datos.estatus[i]+'</td>'+
                '<td>'+datos.fecha[i]+'</td>'+
                '<td>$'+formatNumber.new(datos.importe[i])+'</td>'+
                '<td>'+datos.vendedor[i]+'</td>'+
                '<td>'+datos.descuento[i]+'%</td>'+
                '<td></td>'+
                '<td></td>'+
              '</tr>').appendTo($("#table"));
          }

        }
      }
  }

  function problemas(textError, textStatus) {
        //var error = JSON.parse(textError);
        alert("Problemas en el Servlet: " + JSON.stringify(textError));
        alert("Problemas en el servlet: " + JSON.stringify(textStatus));
  }
});
