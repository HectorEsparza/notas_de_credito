$(document).ready(function(){
  var solicitud = $("#solicitud"),
      acta = $("#acta"),
      ife = $("#ife"),
      domicilio = $("#domicilio"),
      seguro = $("#seguro"),
      curp = $("#curp"),
      rfc = $("#rfc"),
      penales = $("#penales"),
      fotos = $("#fotos"),
      estudios = $("#estudios"),
      solicitudOculto = $(".solicitudOculto"),
      actaOculto = $(".actaOculto"),
      domicilioOculto = $(".domicilioOculto"),
      rfcOculto = $(".rfcOculto"),
      estudiosOculto = $(".estudiosOculto"),
      seguroOculto = $(".seguroOculto"),
      curpOculto = $(".curpOculto");

      solicitudOculto.hide();
      actaOculto.hide();
      domicilioOculto.hide();
      rfcOculto.hide();
      estudiosOculto.hide();
      seguroOculto.hide();
      curpOculto.hide();

      solicitud.change(function(){
          if(solicitud.val()=="SI"){
            solicitudOculto.show();
          }
          else{
            solicitudOculto.hide();
          }
      });

      acta.change(function(){
          if(acta.val()=="SI"&&ife.val()=="SI"){
            actaOculto.show();
          }
          else{
            actaOculto.hide();
          }
      });

      ife.change(function(){
          if(acta.val()=="SI"&&ife.val()=="SI"){
            actaOculto.show();
          }
          else{
            actaOculto.hide();
          }
      });

      domicilio.change(function(){
          if(domicilio.val()=="SI"){
            domicilioOculto.show();
          }
          else{
            domicilioOculto.hide();
          }
      });

      seguro.change(function(){
          if(seguro.val()=="SI"){
            seguroOculto.show();
          }
          else{
            seguroOculto.hide();
          }
      });

      curp.change(function(){
          if(curp.val()=="SI"){
            curpOculto.show();
          }
          else{
            curpOculto.hide();
          }
      });

      rfc.change(function(){
          if(rfc.val()=="SI"){
            rfcOculto.show();
          }
          else{
            rfcOculto.hide();
          }
      });

      penales.change(function(){
          if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
            estudiosOculto.show();
          }
          else{
            estudiosOculto.hide();
          }
      });

      fotos.change(function(){
          if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
            estudiosOculto.show();
          }
          else{
            estudiosOculto.hide();
          }
      });

      estudios.change(function(){
          if(penales.val()=="SI"&&estudios.val()=="SI"&&fotos.val()=="SI"){
            estudiosOculto.show();
          }
          else{
            estudiosOculto.hide();
          }
      });
  // alert("Estamos Dentro!!!");
});
