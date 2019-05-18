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

  $("#buscar").click(function(){
    enviar();
  });

  function enviar(){
    var idCobranza = $("#idCobranza").val();
    var fecha = $("#fecha").val();

    var parametros =
    {
      idCobranza: idCobranza,
      fecha: fecha,
    }
    $.ajax({
        async: true, //Activar la transferencia asincronica
        type: "POST", //El tipo de transaccion para los datos
        dataType: "json", //Especificaremos que datos vamos a enviar
        contentType: "application/x-www-form-urlencoded", //Especificaremos el tipo de contenido
        url: "ajax/filtroCobranza.php", //Sera el archivo que va a procesar la petición AJAX
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
    var click = "ver(document.getElementById('folio1').innerText)";
    //console.log(datos[0]+" "+datos[1]+" "+datos[2]);
    if(datos[0]==0){
      //alert("No se encontraron datos en la Consulta");
      $('<tr>'+
          '<td colspan="5">No se encontraron datos en la consulta</td>'+
        '</tr>').appendTo($("#table"));
    }
    else{
        $('<tr>'+
            '<td id="folio1">'+datos[1]+'</td>'+
            '<td>'+datos[2]+'</td>'+
            '<td>$'+formatNumber.new(datos[4])+'</td>'+
            '<td>'+datos[3]+'</td>'+
            '<td><input type="button" class="btn btn-info btn-sm" value="Ver" onclick='+click+' /></td>'+
          '</tr>').appendTo($("#table"));
    }
  }

  function problemas(){
      console.log("Problemas en el Servidor...");
  }
});
