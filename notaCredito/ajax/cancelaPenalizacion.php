<?php

  $penalizacion = $_POST['penalizacion'];
  $total = $_POST['total'];


  if($total!=""){
    $total = explode("$", $_POST['total']);
    $total[1] = str_replace(",", "", $total[1]);
    echo "$" . number_format($total[1]+$penalizacion, 2, ".", ",");
  }



?>
