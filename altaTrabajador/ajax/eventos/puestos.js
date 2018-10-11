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
              '<option value="Supervisor">Supervisor</option>'+
              // '<option value="Supervisor Reparto">Supervisor Reparto</option>'+
              // '<option value="Supervisor Atencion Cliente">Supervisor Atencion Cliente</option>'+
              '<option value="Chofer">Chofer</option>'+
              '<option value="Supervisor Capacitacion">Supervisor Capacitacion</option>'+
              '<option value="Auxiliar Reparto">Auxiliar Reparto</option>'+
              '<option value="Ejecutivo Atencion Cliente">Ejecutivo Atencion Cliente</option>').appendTo(vistaPuesto);
        }
        else if(auxiliar=="PRODUCCION SOPORTE"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value=""></option>'+
              '<option value="Auxiliar de Limpieza">Auxiliar de Limpieza</option>'+
              '<option value="Vigilante">Vigilante</option>'+
              '<option value="Supervisor">Supervisor</option>'+
              '<option value="Prensista">Prensista</option>'+
              '<option value="Preformista">Preformista</option>'+
              '<option value="Granallador">Granallador</option>'+
              '<option value="Pintor Adhesivo">Pintor Adhesivo</option>'+
              '<option value="Recortador">Recortador</option>'+
              '<option value="Cardeador">Cardeador</option>'+
              '<option value="Armador de Soporte">Armador de Soporte</option>'+
              '<option value="Mecanico">Mecanico</option>'+
              '<option value="Operador de Cizalla">Operador de Cizalla</option>'+
              '<option value="Operador de Troqueladora">Operador de Troqueladora</option>'+
              '<option value="Operador de Torno">Operador de Torno</option>'+
              '<option value="Soldador">Soldador</option>'+
              '<option value="Machueleador">Machueleador</option>'+
              '<option value="Ayudante General">Ayudante General</option>').appendTo(vistaPuesto);
        }






});
