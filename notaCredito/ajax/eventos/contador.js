var formulario = document.getElementsByName('formulario')[0],
    elementos = formulario.elements;
    $("#captura").click(function(){

      var cont = $("#contadorSubtotal").val();
      var auxiliar = 0;
      for(var i=1; i<=cont; i++){
        if($("#cantidad"+i).val()!=""&&$("#clave"+i).val()!=""){
          auxiliar++;
        }
      }
      $("#contador").val(auxiliar);
      console.log(auxiliar);
    });
