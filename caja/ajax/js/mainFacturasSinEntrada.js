// url para llamar la peticion por ajax
//var url_listar_usuario = "php/listar.php";
var url_listar_usuario = "listadoFacturas.php";
var contador = 1;

$( document ).ready(function() {
   // se genera el paginador
   paginador = $(".pagination");
	// cantidad de items por pagina
	var items = 20, numeros =4;
	// inicia el paginador
	init_paginator(paginador,items,numeros);
	// se envia la peticion ajax que se realizara como callback
	set_callback(get_data_callback);
	cargaPagina(0);
});
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
function get_data_callback(){
	$.ajax({
		data:{
		limit: itemsPorPagina,
		offset: desde,
		},
		type:"POST",
		url:url_listar_usuario
	}).done(function(data,textStatus,jqXHR){
		// obtiene la clave lista del json data
		var lista = data.lista;
		$("#table").html("");

		// si es necesario actualiza la cantidad de paginas del paginador
		if(pagina==0){
			creaPaginador(data.cantidad);
		}
		// genera el cuerpo de la tabla
		$.each(lista, function(ind, elem){
      console.log("Hola "+elem.entrada);
      //En el servidor la condicion se cumple si elem.entrada==""
      //En el servidor local la condicion se cumple si elem.entrada==null
      if(elem.entrada==null&&elem.estatus!="Cancelada"){
        $('<tr>'+
          '<td>'+elem.clave+'</td>'+
          '<td>'+elem.cliente+'</td>'+
          '<td>'+elem.nombre+'</td>'+
          '<td>'+elem.estatus+'</td>'+
          '<td>'+elem.fecha+'</td>'+
          '<td>'+'$'+formatNumber.new(elem.importe)+'</td>'+
          '<td>'+elem.vendedor+'</td>'+
          '<td>'+elem.descuento+'%'+'</td>'+
        '</tr>').appendTo($("#table"));
      }
		});

	}).fail(function(jqXHR,textStatus,textError){
		alert("Error al realizar la peticion dame".textError);
	});

}
