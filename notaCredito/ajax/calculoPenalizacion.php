<?php
  require_once("../../funciones.php");

  $porcentaje = $_GET['porcentaje'];
  $total = explode("$", $_GET['total']);
  $total[1] = str_replace(",", "", $total[1]);

  echo "$" . number_format(calculoPenalizacion($porcentaje, $total[1]), 2, ".", ",");



?>
