<!DOCTYPE html>
<html>
<body>
        <table width="20%" border=1>
            <tr>
              <th colspan=2>Selecciona una opción</th>
            </tr>
            <tr>
              <td colspan=2>
                <select style="width:150px" id="cantidadFlete">
                  <option value="90">$90.00</option>
                  <option value="102">$102.00</option>
                  <option value="190">$190.00</option>
                </select>
              </td>
            </tr>
            <tr>
              <!-- infoPenalizacion(this.value, document.getElementById('totalNota').value); -->
              <td><input type="button" class='btn btn-primary' id='hola' value='Ok' onclick="limpiar();
                informacionFlete(document.getElementById('cantidadFlete').value);
                "/></td>
              <td><button class="btn btn-primary" id="cancelaciondePen" onclick="limpiar(); ">Cancelar</button></td>
            </tr>
          </table>

</body>
</html>
