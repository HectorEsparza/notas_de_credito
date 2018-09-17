<!DOCTYPE html>
<html>
<body>
        <table width="20%" border=1>
            <tr>
              <th colspan=2>Selecciona una opción</th>
            </tr>
            <tr>
              <td colspan=2>
                <select style="width:150px" id="cantidadPenalizacion">
                  <option value="10">10%</option>
                  <option value="20">20%</option>
                  <option value="30">30%</option>
                  <option value="40">40%</option>
                  <option value="50">50%</option>
                  <option value="60">60%</option>
                  <option value="70">70%</option>
                  <option value="80">80%</option>
                  <option value="90">90%</option>
                  <option value="100">100%</option>
                </select>
              </td>
            </tr>
            <tr>
              <!-- infoPenalizacion(this.value, document.getElementById('totalNota').value); -->
              <td><input type="button" class='btn btn-primary' id='hola' value='Ok' onclick="limpiar();
                calculoPenalizacion(document.getElementById('cantidadPenalizacion').value, document.getElementById('totalNota').value);
                informacionPenalizacion(document.getElementById('cantidadPenalizacion').value, document.getElementById('totalNota').value);
                "/></td>
              <td><button class="btn btn-primary" id="cancelaciondePen" onclick="limpiar(); ">Cancelar</button></td>
            </tr>
          </table>

</body>
</html>
