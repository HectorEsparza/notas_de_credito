$(document).ready(function(){

  $("#agregarFila").click(function(){
    var indice = $("#filas").val();
    // if($("#factura"+indice).val()!=""){
    //   indice = parseInt(indice, 10);
    //   indice +=1;
    //   $("#fila"+indice).show();
    //   console.log("Agregando la fila número "+indice);
    //   $("#filas").val(indice);
    // }
    // else{
    //   alert("Captura todas las filas, por favor");
    // }
    indice = parseInt(indice, 10);
    indice +=1;
    $("#fila"+indice).show();
    console.log("Agregando la fila número "+indice);
    $("#filas").val(indice);
      
  });

});
