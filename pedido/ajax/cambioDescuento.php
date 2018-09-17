<?php
  $descuento = $_GET['descuento'];
?>
<?= $descuento . " "?> <input type="button" class="boton" value="?" onclick="listaDescuentos(document.getElementById('user').value)" />
