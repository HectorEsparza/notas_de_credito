var formulario = document.getElementsByName('formulario')[0],
    elementos = formulario.elements;

    function convertir(costo)
    {
      var texto, subcadena, numero;
      texto = costo;
      subcadena = texto.substring(1,10);
      numero = parseFloat(subcadena);

      return numero;
    }

    var costo = function()
    {
      if(document.getElementById('costo1').innerText!="")
      {
        document.getElementById('cost1').value = convertir(document.getElementById('costo1').innerText);
      }
      if(document.getElementById('costo2').innerText!="")
      {
        document.getElementById('cost2').value = convertir(document.getElementById('costo2').innerText);
      }
      if(document.getElementById('costo3').innerText!="")
      {
        document.getElementById('cost3').value = convertir(document.getElementById('costo3').innerText);
      }
      if(document.getElementById('costo4').innerText!="")
      {
        document.getElementById('cost4').value = convertir(document.getElementById('costo4').innerText);
      }
      if(document.getElementById('costo5').innerText!="")
      {
        document.getElementById('cost5').value = convertir(document.getElementById('costo5').innerText);
      }
      if(document.getElementById('costo6').innerText!="")
      {
        document.getElementById('cost6').value = convertir(document.getElementById('costo6').innerText);
      }
      if(document.getElementById('costo7').innerText!="")
      {
        document.getElementById('cost7').value = convertir(document.getElementById('costo7').innerText);
      }
      if(document.getElementById('costo8').innerText!="")
      {
        document.getElementById('cost8').value = convertir(document.getElementById('costo8').innerText);
      }
      if(document.getElementById('costo9').innerText!="")
      {
        document.getElementById('cost9').value = convertir(document.getElementById('costo9').innerText);
      }
      if(document.getElementById('costo10').innerText!="")
      {
        document.getElementById('cost10').value = convertir(document.getElementById('costo10').innerText);
      }
    }

    formulario.addEventListener("submit", costo);
