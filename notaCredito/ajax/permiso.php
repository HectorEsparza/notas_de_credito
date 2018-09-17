<!DOCTYPE html>
<html>
  <head>
  </head>

  <body>
    <?php
      $costo = $_GET['costo'];
      $i = $_GET['indice'];
      $lista = $_GET['lista'];
      /*
      $usuario = $_GET['usuario'];

      if($usuario=='ADAN SALAZAR'||$usuario=='FERNANDA FRIAS'){
        echo "Tienes Permiso<br />";
        echo $costo . "<br />";
        echo $usuario;
      }
      else{
        echo "No tiene permisos<br /";
        echo $costo . "<br />";
        echo $usuario;
      }*/
    ?>

    <table width='30%' border=1>
      <tr>
        <th colspan=2 align='center'>Confirmar Permiso</th>
      </tr>
      <tr>
        <th>
          USUARIO
        </th>
        <td>
          <input type="text" id="usuario" />
        </td>
      </tr>
      <tr>
        <th>
          PASSWORD
        </th>
        <td>
          <input type="password" id="contra" />
        </td>
      </tr>
      <tr>
      <input type="hidden" class="costo" value="<?= $costo?>" />
      <input type="hidden" class="indice" value="<?= $i?>" />
      <input type="hidden" class="lista" value="<?= $lista?>" />
        <th colspan=2 >
          <button onclick="nvo_costo2(document.getElementById('usuario').value, document.getElementById('contra').value,
          document.querySelector('.costo').value, document.querySelector('.indice').value, document.querySelector('.lista').value);
          limpiar()">Continuar</button>
        </th>
      </tr>
    </table>
  </body>
</html>
