<?php

  $penalizacion = $_GET['penalizacion'];
  $total = $_GET['total'];

  if($total!=""){
    $total = explode("$", $_GET['total']);
    $total[1] = str_replace(",", "", $total[1]);
    echo "$" . number_format($total[1]+$penalizacion, 2, ".", ",");
  }



?>
