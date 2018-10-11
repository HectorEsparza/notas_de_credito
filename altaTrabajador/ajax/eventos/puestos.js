$(document).ready(function(){

    var departamento = $("#departamento").val(),
        vistaDepartamento = $("#vistaDepartamento"),
        vistaPuesto = $("#vistaPuesto"),
        auxiliar = "";
        // selector = 1;

        departamento = departamento.split("_");
        for (var i = 0; i < departamento.length; i++) {
          if(i==0){
            auxiliar = departamento[i];
          }
          else{
            auxiliar = auxiliar+" "+departamento[i];
          }
        }
        vistaDepartamento.val(auxiliar);
        console.log(auxiliar);


        if(auxiliar=="VENTAS"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value=""></option>'+
              '<option value="Vigilante">Vigilante</option>'+
              '<option value="Supervisor Logistica">Supervisor Logistica</option>'+
              '<option value="Supervisor Reparto">Supervisor Reparto</option>'+
              '<option value="Supervisor Atencion Cliente">Supervisor Atencion Cliente</option>'+
              '<option value="Chofer">Chofer</option>'+
              '<option value="Supervisor Capacitacion">Supervisor Capacitacion</option>'+
              '<option value="Auxiliar Reparto">Auxiliar Reparto</option>'+
              '<option value="Ejecutivo Atencion Cliente">Ejecutivo Atencion Cliente</option>').appendTo(vistaPuesto);
        }




});
