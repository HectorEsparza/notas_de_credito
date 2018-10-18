$(document).ready(function(){

  var departamento = $("#departamento").val(),
      empleado = $("#noEmpleado"),
      contrato = $("#contrato"),
      imss = $("#imss"),
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
  }
  else {
    $("#guardar").hide();
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
    arreglo = arreglo[1];
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



});
