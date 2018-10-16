$(document).ready(function(){

  var contadorDocumentos = 11,
      contadorSolicitud = 18,
      documentos = [],
      solicitud = [];

      for (var i = 1; i <= contadorDocumentos; i++){
        documentos[i] = $("#documentos"+i).val();
        console.log(documentos[i]);
      }

      for (var i = 1; i <= contadorSolicitud; i++){
        solicitud[i] = $("#solicitud"+i).val();
        console.log(solicitud[i]);
      }
});
