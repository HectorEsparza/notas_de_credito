// url para llamar la peticion por ajax
//var url_listar_usuario = "php/listar.php";
var url_listar_usuario = "clientes.php";
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

function get_data_callback(){
	$.ajax({
		data:{
		limit: itemsPorPagina,
		offset: desde,
		},
		type:"POST",
		url:url_listar_usuario
	}).done(function(data,textStatus,jqXHR){
    console.log(data);
		// obtiene la clave lista del json data
		var lista = data.lista;
		$("#table").html("");

		// si es necesario actualiza la cantidad de paginas del paginador
		if(pagina==0){
			creaPaginador(data.cantidad);
		}
		// genera el cuerpo de la tabla
		$.each(lista, function(ind, elem){
     
            $('<tr>'+
              '<td>'+elem.idCliente+'</td>'+
              '<td>'+elem.nombreCliente+'</td>'+
              '<td><input type="button" class="btn btn-info btn-sm remisiones" id="'+elem.idCliente+'" value="Remisiones" /></td>'+
            '</tr>').appendTo($("#table"));


		});

		//Agregando el srcipt para poder hacer el redireccionamiento hacia la vista de las remisones por cliente
		$("#scriptParaCargas").append('<script type="text/javascript" src="ajax/js/vistaRemisiones.js"></script>');
		//Ocultando el paginador
		$("#paginador").hide();

	}).fail(function(jqXHR,textStatus,textError){
		alert("Error al realizar la peticion dame".textError);
	});

}
