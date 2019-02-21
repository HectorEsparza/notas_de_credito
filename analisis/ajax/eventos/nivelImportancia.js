$(document).ready(function(){
  var caro = $("#caro"), igual = $("#igual"), barato = $("#barato"), todo = $("#todo");


  caro.click(function(){
    $("#nivel").show();
    $(".Caro").show();
    $(".Igual").hide();
    $(".Barato").hide();
    $("#tituloImportancia").text("Productos Caros");

  });

  igual.click(function(){
    $("#nivel").show();
    $(".Igual").show();
    $(".Caro").hide();
    $(".Barato").hide();
    $("#tituloImportancia").text("Productos Iguales");

  });

  barato.click(function(){
    $("#nivel").show();
    $(".Barato").show();
    $(".Igual").hide();
    $(".Caro").hide();
    $("#tituloImportancia").text("Productos Baratos");
  });

  todo.click(function(){
    $("#nivel").show();
    $(".Igual").show();
    $(".Caro").show();
    $(".Barato").show();
    $("#tituloImportancia").text("Todos los Productos");
  });
});
