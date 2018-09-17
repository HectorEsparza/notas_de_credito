<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <?php

    ?>

    <table width='20%' border=1>
             <tr>
               <th colspan=3>Descuentos</th>
             </tr>
             <tr>
               <td>Número</td>
               <td>Descuento</td>
               <td>Selecciona</td>
             </tr>
             <tr>
               <td>1</td>
               <td id='1'>53.25%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('1').innerText);limpiar()">OK</button></td>
             </tr>
             <tr>
               <td>2</td>
               <td id='2'>55.59%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('2').innerText);limpiar()">OK</button></td>
             </tr>
             <tr>
               <td>3</td>
               <td id='3'>57.92%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('3').innerText);limpiar()">OK</button></td>
             </tr>
             <tr>
               <td>4</td>
               <td id='4'>60.26%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('4').innerText);limpiar()">OK</button></td>
             </tr>
             <tr>
               <td>5</td>
               <td id='5'>62.60%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('5').innerText);limpiar()">OK</button></td>
             </tr>
             <tr>
               <td>6</td>
               <td id='6'>64.94%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('6').innerText);limpiar()">OK</button></td>
             </tr>
             <tr>
               <td>7</td>
               <td id='7'>67.28%</td>
               <td><button class='boton' onclick="cambioDescuento(document.getElementById('7').innerText);limpiar()">OK</button></td>
             </tr>

          </table>

  </body>
</html>
