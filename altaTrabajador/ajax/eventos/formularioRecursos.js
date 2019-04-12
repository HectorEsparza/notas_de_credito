$(document).ready(function(){

  var departamento = $("#departamento").val(),
      empleado = $("#noEmpleado"),
      contrato = $("#contrato"),
      imss = $("#imss"),
      bancomer = $("#bancomer"),
      estatus = $("#estatusFinal"),
      auxiliar="";
  // alert(departamento.val());
  departamento = departamento.split("_");
  for (var i = 0; i < departamento.length; i++) {
    if(i==0){
      auxiliar = departamento[i];
    }
    else{
      auxiliar = auxiliar+" "+departamento[i];
    }
  }
  // alert(auxiliar);
  if(auxiliar!="RECURSOS HUMANOS"){
    $("#recursosHumanos").hide();
    $("#gerentes").hide();
  }
  else {
    $("#gerentes").show();
    $("#guardar").hide();
    // $("#new").hide();
    $("#usuarios").hide();


  }
  if(auxiliar!="ADMINISTRADOR"){
    $("#gerente").hide();
    $("#gerentes").hide();
    if(auxiliar=="RECURSOS HUMANOS"){
      $("#gerentes").show();
    }

  }
  else{
    $("#gerentes").show();
    $("#recursosHumanos").show();
    $("#guardar").hide();
    $("#final").hide();
    $("#new").hide();
    $("#usuarios").hide();
  }

  empleado.change(function(){

    console.log("Introdujo numero de empleado");
    if(empleado.val()!=""&&contrato.val()!=""&&imss.val()!=""){
      $("#final").attr("disabled", false);
    }
    else{
      $("#final").attr("disabled", true);
    }
  });

  contrato.change(function(){

    console.log("Introdujo pdf contrato");
    var archivo = contrato.val();
    arreglo = archivo.split("\\");
    arreglo = arreglo[arreglo.length-1];
    //alert("Introduciste el archivo "+arreglo+" y el tamaño es de "+arreglo.length);
    arreglo = arreglo.split(".");
    arreglo = arreglo[1]
    if(arreglo!="pdf"){
      alert("Solamente se permiten archivos PDF");


      contrato.val("");
    }
    if(empleado.val()!=""&&contrato.val()!=""&&imss.val()!=""){
      $("#final").attr("disabled", false);
    }
    else{
      $("#final").attr("disabled", true);
    }
  });

  imss.change(function(){

    console.log("Introduhi pdf imss");
    var archivo = imss.val();
    arreglo = archivo.split("\\");
    arreglo = arreglo[arreglo.length-1];
    //alert("Introduciste el archivo "+arreglo+" y el tamaño es de "+arreglo.length);
    arreglo = arreglo.split(".");
    arreglo = arreglo[1];
    if(arreglo!="pdf"){
      alert("Solamente se permiten archivos PDF");
      imss.val("");
    }
    if(empleado.val()!=""&&contrato.val()!=""&&imss.val()!=""){
      $("#final").attr("disabled", false);
    }
    else{
      $("#final").attr("disabled", true);
    }
  });

  bancomer.change(function(){

    if(bancomer.val()!=""&&estatus.val()!=""){
      $("#autorizacion").attr("disabled", false);
    }
    else{
      $("#autorizacion").attr("disabled", true);

    }
  });

  estatus.change(function(){

    if(bancomer.val()!=""&&estatus.val()!=""){
      $("#autorizacion").attr("disabled", false);
    }
    else{
      $("#autorizacion").attr("disabled", true);

    }
  });




});
