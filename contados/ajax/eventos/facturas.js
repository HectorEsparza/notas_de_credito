$(document).ready(function(){

  $("#archivo").change(function(){
    var archivo = $("#archivo").val();
    arreglo = archivo.split("\\");
    arreglo = arreglo[arreglo.length-1];
    //alert("Introduciste el archivo "+arreglo+" y el tamaño es de "+arreglo.length);
    arreglo = arreglo.split(".");
    arreglo = arreglo[1];
    if (arreglo=="csv"){
      $("#cargar").prop("disabled", false);
    }
    else {
      alert("Introduce un documento válido, solamente se permiten archivos con extensión .csv");
      $("#cargar").prop("disabled", true);
    }
  });

});