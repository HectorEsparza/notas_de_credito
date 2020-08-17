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
      alert("Captura al menos un campo, por favor");
    }

  });

  function enviar(){
    var factura = $("#factura").val();
    var cliente = $("#cliente").val();
    var fecha = $("#fecha").val();
    var fechaCorte = $("#fechaCorte").val();
    var pago = $("#pago").val();
    var folio = $("#folio").val();
   
    var parametros =
    {
      factura: factura,
      cliente: cliente,
      fecha: fecha,
      fechaCorte : fechaCorte,
      pago: pago,
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
      console.log("Cargando filtro facturas/remisiones...");
  }

  function llegada(datos){
    var contador = Object.keys(datos.facturas).length;
    $("#table").empty();
    $("#paginador").empty();
    $("#exportaExcel").show();
    
      if(contador==0){
        //alert("No se encontraron datos en la Consulta");
        $('<tr>'+
            '<td colspan="11">No se encontraron datos en la consulta</td>'+
          '</tr>').appendTo($("#table"));
      }
      else{
        //console.log(datos[4][0]+datos[4][1]+datos[4][2]);
        for(var i = 0; i < contador; i++){
          if(datos.fechasCorte[i]!=null){
            $('<tr>'+
                '<td>'+datos.facturas[i]+'</td>'+
                '<td>'+datos.clientes[i]+'</td>'+
                '<td>'+datos.nombre[i]+'</td>'+
                '<td>'+datos.estatus[i]+'</td>'+
                '<td>'+datos.fechas[i]+'</td>'+
                '<td>$'+formatNumber.new(datos.importe[i])+'</td>'+
                '<td>'+datos.vendedor[i]+'</td>'+
                '<td>'+datos.descuento[i]+'%</td>'+
                '<td>'+datos.metodos[i]+'</td>'+
                '<td>'+datos.fechasCorte[i]+'</td>'+
                '<td>'+datos.entrada[i]+'</td>'+
              '</tr>').appendTo($("#table"));
          }
          else{
            $('<tr>'+
                '<td>'+datos.facturas[i]+'</td>'+
                '<td>'+datos.clientes[i]+'</td>'+
                '<td>'+datos.nombre[i]+'</td>'+
                '<td>'+datos.estatus[i]+'</td>'+
                '<td>'+datos.fechas[i]+'</td>'+
                '<td>$'+formatNumber.new(datos.importe[i])+'</td>'+
                '<td>'+datos.vendedor[i]+'</td>'+
                '<td>'+datos.descuento[i]+'%</td>'+
                '<td>'+datos.metodos[i]+'</td>'+
                '<td></td>'+
                '<td>'+datos.entrada[i]+'</td>'+
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
