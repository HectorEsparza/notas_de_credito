<!DOCTYPE html>
<html>
<body>
<?php
  $user = $_POST['usuario'];
?>

<?php if($user==1): ?>
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
            informacionPenalizacion(document.getElementById('cantidadPenalizacion').value, document.getElementById('penalizacionNota').value);
            "/></td>
          <td><button class="btn btn-primary" id="cancelaciondePen" onclick="limpiar(); ">Cancelar</button></td>
        </tr>
      </table>
  <? else: ?>
    <table width='20%' border=1>
      <tr>
        <td colspan=2>
          <h3>Sin Permisos, Introduzca Contraseña</h3>
        </td>
      </tr>
      <tr>
        <td colspan=2>
          <input type="password" id="contra" placeholder="contraseña" />
        </td>
      </tr>

      <input type="hidden" class="costo" value="<?= $costo?>" />
      <input type="hidden" class="indice" value="<?= $i?>" />
      <input type="hidden" class="lista" value="<?= $lista?>" />
      <input type="hidden" class="clave" value="<?= $clave?>" />
      <tr>
        <td>
          <button class="btn btn-primary" onclick="penalizacion2(document.getElementById('contra').value)">Continuar</button>
        </td>
        <td>
          <button class="btn btn-primary" onclick="limpiar()">Cancelar</button>
        </td>
      </tr>


    </table>


<? endif ?>

</body>
</html>
