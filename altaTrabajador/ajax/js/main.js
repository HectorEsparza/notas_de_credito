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
      //console.log("El departamento desde main es "+elem.departamento);
      //console.log("El status es: "+elem.status);
      departamento = departamento.split("_");


      for (var i = 0; i < departamento.length; i++) {
        if(i==0){
          auxiliar = departamento[i];
        }
        else{
          auxiliar = auxiliar+" "+departamento[i];
        }
      }
      // alert(elem.bancomer);
      //alert(elem.empleado);
      switch (elem.status) {
          case "Faltan Datos":
            console.log("Faltan Datos El status es: "+elem.status);
            if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="ADMINISTRADOR"){
              $('<tr class="faltanDatos">'+
                '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                '<td id="folio'+contador+'">'+elem.id+'</td>'+
                '<td>'+elem.empleado+'</td>'+
                '<td>'+elem.nombre+'</td>'+
                '<td>'+elem.curp+'</td>'+
                '<td>'+elem.rfc+'</td>'+
                '<td>'+elem.seguro+'</td>'+
                '<td>'+elem.salarioDiario+'</td>'+
                '<td>'+elem.salarioSemanal+'</td>'+
                '<td>'+elem.departamento+'</td>'+
                '<td>'+elem.puesto+'</td>'+
                '<td>'+elem.fechaAlta+'</td>'+
                '<td>'+elem.bancomer+'</td>'+
                '<td>'+elem.sivale+'</td>'+
                '<td>'+elem.calle+'</td>'+
                '<td>'+elem.colonia+'</td>'+
                '<td>'+elem.cp+'</td>'+
                '<td>'+elem.poblacion+'</td>'+
                '<td>'+elem.fechaNacimiento+'</td>'+
                '<td>'+elem.telefono+'</td>'+
                '<td>'+elem.telefonoEmergencia+'</td>'+
                '<td>'+elem.personaEmergencia+'</td>'+
                '<td>'+elem.correo+'</td>'+
                '<td>'+elem.edoCivil+'</td>'+
                '<td>'+elem.sexo+'</td>'+
                '<td>'+elem.status+'</td>'+
              '</tr>').appendTo($("#table"));
            }
            else if(auxiliar==elem.departamento){
              $('<tr class="faltanDatos">'+
                   '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
          break;
          case "Revision":
            console.log("Revision El status es: "+elem.status);
            if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="ADMINISTRADOR"){
              $('<tr class="revision">'+
                '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                '<td id="folio'+contador+'">'+elem.id+'</td>'+
                '<td>'+elem.empleado+'</td>'+
                '<td>'+elem.nombre+'</td>'+
                '<td>'+elem.curp+'</td>'+
                '<td>'+elem.rfc+'</td>'+
                '<td>'+elem.seguro+'</td>'+
                '<td>'+elem.salarioDiario+'</td>'+
                '<td>'+elem.salarioSemanal+'</td>'+
                '<td>'+elem.departamento+'</td>'+
                '<td>'+elem.puesto+'</td>'+
                '<td>'+elem.fechaAlta+'</td>'+
                '<td>'+elem.bancomer+'</td>'+
                '<td>'+elem.sivale+'</td>'+
                '<td>'+elem.calle+'</td>'+
                '<td>'+elem.colonia+'</td>'+
                '<td>'+elem.cp+'</td>'+
                '<td>'+elem.poblacion+'</td>'+
                '<td>'+elem.fechaNacimiento+'</td>'+
                '<td>'+elem.telefono+'</td>'+
                '<td>'+elem.telefonoEmergencia+'</td>'+
                '<td>'+elem.personaEmergencia+'</td>'+
                '<td>'+elem.correo+'</td>'+
                '<td>'+elem.edoCivil+'</td>'+
                '<td>'+elem.sexo+'</td>'+
                '<td>'+elem.status+'</td>'+
              '</tr>').appendTo($("#table"));
            }
            else if(auxiliar==elem.departamento){
              $('<tr class="revision">'+
                   '<td></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
          break;
          case "Contratado":
            console.log("Contratado El status es: "+elem.status);
            if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="ADMINISTRADOR"){
              $('<tr class="contratado">'+
                   '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.empleado+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.curp+'</td>'+
                   '<td>'+elem.rfc+'</td>'+
                   '<td>'+elem.seguro+'</td>'+
                   '<td>'+elem.salarioDiario+'</td>'+
                   '<td>'+elem.salarioSemanal+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.bancomer+'</td>'+
                   '<td>'+elem.sivale+'</td>'+
                   '<td>'+elem.calle+'</td>'+
                   '<td>'+elem.colonia+'</td>'+
                   '<td>'+elem.cp+'</td>'+
                   '<td>'+elem.poblacion+'</td>'+
                   '<td>'+elem.fechaNacimiento+'</td>'+
                   '<td>'+elem.telefono+'</td>'+
                   '<td>'+elem.telefonoEmergencia+'</td>'+
                   '<td>'+elem.personaEmergencia+'</td>'+
                   '<td>'+elem.correo+'</td>'+
                   '<td>'+elem.edoCivil+'</td>'+
                   '<td>'+elem.sexo+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
            else if(auxiliar==elem.departamento){
              $('<tr class="contratado">'+
                   '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
          break;
          case "Aceptado":
            console.log("Aceptado El status es: "+elem.status);
            if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="ADMINISTRADOR"){
              $('<tr class="aceptado">'+
              '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
              '<td id="folio'+contador+'">'+elem.id+'</td>'+
              '<td>'+elem.empleado+'</td>'+
              '<td>'+elem.nombre+'</td>'+
              '<td>'+elem.curp+'</td>'+
              '<td>'+elem.rfc+'</td>'+
              '<td>'+elem.seguro+'</td>'+
              '<td>'+elem.salarioDiario+'</td>'+
              '<td>'+elem.salarioSemanal+'</td>'+
              '<td>'+elem.departamento+'</td>'+
              '<td>'+elem.puesto+'</td>'+
              '<td>'+elem.fechaAlta+'</td>'+
              '<td>'+elem.bancomer+'</td>'+
              '<td>'+elem.sivale+'</td>'+
              '<td>'+elem.calle+'</td>'+
              '<td>'+elem.colonia+'</td>'+
              '<td>'+elem.cp+'</td>'+
              '<td>'+elem.poblacion+'</td>'+
              '<td>'+elem.fechaNacimiento+'</td>'+
              '<td>'+elem.telefono+'</td>'+
              '<td>'+elem.telefonoEmergencia+'</td>'+
              '<td>'+elem.personaEmergencia+'</td>'+
              '<td>'+elem.correo+'</td>'+
              '<td>'+elem.edoCivil+'</td>'+
              '<td>'+elem.sexo+'</td>'+
              '<td>'+elem.status+'</td>'+
              '</tr>').appendTo($("#table"));
            }
            else if(auxiliar==elem.departamento){
              $('<tr class="aceptado">'+
                   '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
          break;
          case "Rechazado":
            console.log("Rechazado El status es: "+elem.status);
            if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="ADMINISTRADOR"){
              $('<tr class="rechazado">'+
              '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
              '<td id="folio'+contador+'">'+elem.id+'</td>'+
              '<td>'+elem.empleado+'</td>'+
              '<td>'+elem.nombre+'</td>'+
              '<td>'+elem.curp+'</td>'+
              '<td>'+elem.rfc+'</td>'+
              '<td>'+elem.seguro+'</td>'+
              '<td>'+elem.salarioDiario+'</td>'+
              '<td>'+elem.salarioSemanal+'</td>'+
              '<td>'+elem.departamento+'</td>'+
              '<td>'+elem.puesto+'</td>'+
              '<td>'+elem.fechaAlta+'</td>'+
              '<td>'+elem.bancomer+'</td>'+
              '<td>'+elem.sivale+'</td>'+
              '<td>'+elem.calle+'</td>'+
              '<td>'+elem.colonia+'</td>'+
              '<td>'+elem.cp+'</td>'+
              '<td>'+elem.poblacion+'</td>'+
              '<td>'+elem.fechaNacimiento+'</td>'+
              '<td>'+elem.telefono+'</td>'+
              '<td>'+elem.telefonoEmergencia+'</td>'+
              '<td>'+elem.personaEmergencia+'</td>'+
              '<td>'+elem.correo+'</td>'+
              '<td>'+elem.edoCivil+'</td>'+
              '<td>'+elem.sexo+'</td>'+
              '<td>'+elem.status+'</td>'+
              '</tr>').appendTo($("#table"));
            }
            else if(auxiliar==elem.departamento){
              $('<tr class="rechazado">'+
                   '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
          break;
          case "Faltan Documentos":
            console.log("Faltan Documentos El status es: "+elem.status);
            if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="ADMINISTRADOR"){
              $('<tr class="faltanDocumentos">'+
              '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
              '<td id="folio'+contador+'">'+elem.id+'</td>'+
              '<td>'+elem.empleado+'</td>'+
              '<td>'+elem.nombre+'</td>'+
              '<td>'+elem.curp+'</td>'+
              '<td>'+elem.rfc+'</td>'+
              '<td>'+elem.seguro+'</td>'+
              '<td>'+elem.salarioDiario+'</td>'+
              '<td>'+elem.salarioSemanal+'</td>'+
              '<td>'+elem.departamento+'</td>'+
              '<td>'+elem.puesto+'</td>'+
              '<td>'+elem.fechaAlta+'</td>'+
              '<td>'+elem.bancomer+'</td>'+
              '<td>'+elem.sivale+'</td>'+
              '<td>'+elem.calle+'</td>'+
              '<td>'+elem.colonia+'</td>'+
              '<td>'+elem.cp+'</td>'+
              '<td>'+elem.poblacion+'</td>'+
              '<td>'+elem.fechaNacimiento+'</td>'+
              '<td>'+elem.telefono+'</td>'+
              '<td>'+elem.telefonoEmergencia+'</td>'+
              '<td>'+elem.personaEmergencia+'</td>'+
              '<td>'+elem.correo+'</td>'+
              '<td>'+elem.edoCivil+'</td>'+
              '<td>'+elem.sexo+'</td>'+
              '<td>'+elem.status+'</td>'+
              '</tr>').appendTo($("#table"));
            }
            else if(auxiliar==elem.departamento){
              $('<tr class="faltanDocumentos">'+
                   '<td><input type="button" value="Ver" class="ver" id="botonPrueba'+contador+'" onclick='+click+'></td>'+
                   '<td id="folio'+contador+'">'+elem.id+'</td>'+
                   '<td>'+elem.fechaAlta+'</td>'+
                   '<td>'+elem.departamento+'</td>'+
                   '<td>'+elem.puesto+'</td>'+
                   '<td>'+elem.nombre+'</td>'+
                   '<td>'+elem.status+'</td>'+
                   '</tr>').appendTo($("#table"));
            }
          break;
        default:
            console.log("Error");
        break;

      }

      contador++;

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
