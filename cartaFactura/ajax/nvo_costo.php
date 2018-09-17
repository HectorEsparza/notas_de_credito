<?php

$costo = $_POST['costo'];
$i = $_POST['indice'];
$user = $_POST['usuario'];


?>
  <input type="hidden" id='user' value=<?= $user?> />
<?php if($costo=="$0"):?>
<input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value, <?= $i?>, document.getElementById('user').value)" />
<?php else:?>
  <?=  $costo . " "?>
  <input type='button' class="boton" value='?' onclick="listas(document.querySelector('.clave<?= $i?>').value, <?= $i?>, document.getElementById('user').value)" />

<?php endif?>
