$(document).ready(function(){

  $("#agregar").click(function(){
    var cuerpo = $("#cuerpo");
    var fila = $("#filas").val();
    fila = parseInt(fila, 10);
    fila+=1;
    console.log("Agregando la fila número "+fila);
    $("#filas").val(fila);
    $("#fila"+fila).show();
    // $('<tr>'+
    //     '<td><input type="text" id="factura'+fila+'" style="width: 100px; height: 20px;"/></td>'+
    //     '<td>'+
    //       '<select id="metodo'+fila+'">'+
    //         '<option value=""></option>'+
    //         '<option value="Firma">Firma</option>'+
    //         '<option value="Contado">Contado</option>'+
    //         '<option value="Transferencia">Transferencia</option>'+
    //         '<option value="Guía">Guía</option>'+
    //       '</select>'+
    //     '</td>'+
    //     '<td id="cliente'+fila+'"></td>'+
    //     '<td id="nombre'+fila+'"></td>'+
    //     '<td id="importe'+fila+'"></td>'+
    //     '<td><input type="text" id="observaciones'+fila+'" style="width: 100px; height: 20px;" /></td>'+
    //   '</tr>').appendTo(cuerpo);
  });

});
