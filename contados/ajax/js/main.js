// url para llamar la peticion por ajax
//var url_listar_usuario = "php/listar.php";
var url_listar_usuario = "listado.php";
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
function fechaJquery(fecha){

  var fecha = fecha;
  var convierte = fecha.split("-");
  var nueva = convierte[1]+"/"+convierte[2]+"/"+convierte[0];
  return nueva;
}

function fechaStandar(fecha){

  var fecha = fecha;
  var convierte = fecha.split("-");
  var nueva = convierte[2]+"/"+convierte[1]+"/"+convierte[0];
  return nueva;
}


/*$(function fechaJquery(fecha){

  var variable = "Otra fecha";
  return variable;
});*/
// peticion ajax enviada como callback
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
    var departamento = data.departamento;
		// si es necesario actualiza la cantidad de paginas del paginador
		if(pagina==0){
			creaPaginador(data.cantidad);
		}
		// genera el cuerpo de la tabla
		$.each(lista, function(ind, elem){
    
      var click = "ver(document.getElementById('folio"+contador+"').innerText)";

        if(departamento=="CONTADOS"){
          if(elem.departamento=="CONTADOS"){
            $('<tr>'+
              '<td id="folio'+contador+'">'+elem.clave+'</td>'+
              '<td>'+fechaStandar(elem.fecha)+'</td>'+
              '<td>'+"$"+formatNumber.new(elem.total)+'</td>'+
              '<td>'+elem.usuario+'</td>'+
              '<td><input type="button" class="btn btn-info btn-sm" value="Ver" onclick='+click+' /></td>'+
              // '<td><input type="button" class="btn btn-warning" value="Editar" onclick='+click2+' /></td>'+
              // '<td><input type="button" class="btn btn-warning" value="Editar" onclick='+click+'/></td>'+
            '</tr>').appendTo($("#table"));

            contador++;
          }
        }
        else if (departamento=="CONTADOS_TECAMAC") {
          if(elem.departamento=="CONTADOS_TECAMAC"){
            $('<tr>'+
              '<td id="folio'+contador+'">'+elem.clave+'</td>'+
              '<td>'+fechaStandar(elem.fecha)+'</td>'+
              '<td>'+"$"+formatNumber.new(elem.total)+'</td>'+
              '<td>'+elem.usuario+'</td>'+
              '<td><input type="button" class="btn btn-info btn-sm" value="Ver" onclick='+click+' /></td>'+
              // '<td><input type="button" class="btn btn-warning" value="Editar" onclick='+click2+' /></td>'+
              // '<td><input type="button" class="btn btn-warning" value="Editar" onclick='+click+'/></td>'+
            '</tr>').appendTo($("#table"));

            contador++;
          }
        }
        else{
          $('<tr>'+
            '<td id="folio'+contador+'">'+elem.clave+'</td>'+
            '<td>'+fechaStandar(elem.fecha)+'</td>'+
            '<td>'+"$"+formatNumber.new(elem.total)+'</td>'+
            '<td>'+elem.usuario+'</td>'+
            '<td><input type="button" class="btn btn-info btn-sm" value="Ver" onclick='+click+' /></td>'+
            // '<td><input type="button" class="btn btn-warning" value="Editar" onclick='+click2+' /></td>'+
            // '<td><input type="button" class="btn btn-warning" value="Editar" onclick='+click+'/></td>'+
          '</tr>').appendTo($("#table"));

          contador++;
        }
		});

	}).fail(function(jqXHR,textStatus,textError){
		alert("Error al realizar la peticion dame".textError);
	});

}
