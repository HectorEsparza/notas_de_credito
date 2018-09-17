var formulario = document.getElementsByName('formulario')[0],
    elementos = formulario.elements;
    //Esta funcion recupera el texto del costo para convertirlo en flotante
    function convertir(costo)
    {
      //Recibimos el costo en forma de texto
      var texto, subcadena, numero;
      texto = costo;
      //Separamos el texto en dos cadenas y nos quedamos con la cadena que contiene solo numeros
      subcadena = texto.split("$");
      //Remplasamos las comas del texto por vacio y hacemos la conversion a flotante
      numero = parseFloat(subcadena[1].replace(',', ""));
      //Retornamos el numero ya en forma flotante listo para hacer operaciones con el
      return numero;
    }

    $("#captura").click(function(){

      var cont = $("#contadorSubtotal").val();
      var auxiliar = 0;
      for(var i=1; i<=cont; i++){
        if($("#cantidad"+i).val()!=""&&$("#clave"+i).val()!=""){
          auxiliar++;
          $("#cost"+i).val(convertir($("#costo"+i).val()));
          $("#description"+i).val($("#descripcion"+i).val());
        }
      }

      $("#contador").val(auxiliar);
      console.log(auxiliar);
      $("#consecutivo").val($("#folio").text());
    });
