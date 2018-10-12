// url para llamar la peticion por ajax
//var url_listar_usuario = "php/listar.php";
var url_listar_usuario = "listado.php";
var contador = 1;
var folio = document.getElementById('folio').value;

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

		// si es necesario actualiza la cantidad de paginas del paginador
		if(pagina==0){
			creaPaginador(data.cantidad);
		}
		// genera el cuerpo de la tabla
		$.each(lista, function(ind, elem){
      var departamento = $("#departamento").val();
      //var click = "saludo(document.querySelector('.folio"+contador+"').value)";
      var click = "saludo(document.getElementById('folio"+contador+"').innerText)";
      console.log("El departamento desde main es "+elem.departamento);
      departamento = departamento.split("_");
      for (var i = 0; i < departamento.length; i++) {
        if(i==0){
          auxiliar = departamento[i];
        }
        else{
          auxiliar = auxiliar+" "+departamento[i];
        }
      }
      if(elem.status=="Capturando"){
        if(auxiliar==elem.departamento){
          $('<tr class="capturando">'+
               '<td id="folio'+contador+'">'+elem.id+'</td>'+
               '<td>'+elem.fechaAlta+'</td>'+
               '<td>'+elem.puesto+'</td>'+
               '<td>'+elem.nombre+'</td>'+
               '<td>'+elem.status+'</td>'+
               '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
               '</tr>').appendTo($("#table"));
        }
      }

      else if(elem.status="Revision"){
        if(auxiliar==elem.departamento){
          $('<tr class="revision">'+
               '<td id="identificador'+contador+'">'+elem.id+'</td>'+
               '<td>'+elem.fechaAlta+'</td>'+
               '<td>'+elem.puesto+'</td>'+
               '<td>'+elem.nombre+'</td>'+
               '<td>'+elem.status+'</td>'+
               '</tr>').appendTo($("#table"));
        }
      }

      else{
        if(auxiliar==elem.departamento){
          $('<tr class="contratado">'+
               '<td id="identificador'+contador+'">'+elem.id+'</td>'+
               '<td>'+elem.fechaAlta+'</td>'+
               '<td>'+elem.puesto+'</td>'+
               '<td>'+elem.nombre+'</td>'+
               '<td>'+elem.status+'</td>'+
               '</tr>').appendTo($("#table"));
        }
      }

      contador++;

       // var valida = 2;
       // var tamano = elem.notasae.length;
       // var click = "saludo(document.querySelector('.folio"+contador+"').value)";
       // var click2 = "cancela(document.querySelector('.folio"+contador+"').value)";
       // var click3 = "vista(document.querySelector('.folio"+contador+"').value)";
       // var tipo = elem.foliointerno;
       // var tipo = tipo.split("-");
       // var tipo = tipo[0];
       //
       //  if(elem.status=="ACTIVA"){
       //
       //    if(tamano>1){
       //        $('<tr>'+
       //             '<td class="principal"><input type="text" class="folio'+contador+'" value='+elem.foliointerno+' size="4" readonly /></td>'+
       //             '<td class="principal">'+elem.nocliente+'</td>'+
       //             '<td class="principal">'+elem.cliente+'</td>'+
       //             '<td class="principal">'+elem.notasae+'</td>'+
       //             '<td class="principal">$'+formatNumber.new(elem.total)+'</td>'+
       //             '<td class="principal">'+fechaStandar(elem.fecha)+'</td>'+
       //             '<td class="principal">'+elem.status+'</td>'+
       //             '<td class="principal"><button class="ver" onclick='+click+'>Ver</button></td>'+
       //             '<td class="principal"><button class="modifica" onclick='+click2+'>Cancelar</button></td>'+
       //             '</tr>').appendTo($("#table"));
       //
       //
       //     }
       //     else {
       //         $('<tr>'+
       //              '<td class="nulo"><input type="text" class="folio'+contador+'" value='+elem.foliointerno+' size="4" readonly /></td>'+
       //              '<td class="nulo">'+elem.nocliente+'</td>'+
       //              '<td class="nulo">'+elem.cliente+'</td>'+
       //              '<td class="nulo">'+elem.notasae+'</td>'+
       //              '<td class="nulo">$'+formatNumber.new(elem.total)+'</td>'+
       //              '<td class="nulo">'+fechaStandar(elem.fecha)+'</td>'+
       //              '<td class="nulo">'+elem.status+'</td>'+
       //              '<td class="nulo"><button class="modifica" onclick='+click+'>!</button></td>'+
       //              '<td class="nulo"><button class="modifica" onclick='+click2+'>Cancelar</button></td>'+
       //              '</tr>').appendTo($("#table"));
       //
       //
       //     }
       //  }
       //
       //
       //  else{
       //            $('<tr>'+
       //              '<td class="cancelada"><input type="text" class="folio'+contador+'"  value='+elem.foliointerno+' size="4"  readonly /></td>'+
       //              '<td class="cancelada">'+elem.nocliente+'</td>'+
       //              '<td class="cancelada">'+elem.cliente+'</td>'+
       //              '<td class="cancelada">'+elem.notasae+'</td>'+
       //              '<td class="cancelada">$'+formatNumber.new(elem.total)+'</td>'+
       //              '<td class="cancelada">'+fechaStandar(elem.fecha)+'</td>'+
       //              '<td class="cancelada">'+elem.status+'</td>'+
       //              '<td class="cancelada" colspan=2><button class="ver" onclick='+click3+'>Ver</button></td>'+
       //              '</tr>').appendTo($("#table"));
       //
       //  }
       //
       //  contador++;
		});
    // for (var i = 1; i <= contador; i++) {
    //   $("#botonPrueba"+i).click(function(){
    //
    //     //alert(i);
    //     // alert($("#identificador"+i).text());
    //   });
    // }
    // console.log(contador);
	}).fail(function(jqXHR,textStatus,textError){
		alert("Error al realizar la peticion dame".textError);
	});

}
