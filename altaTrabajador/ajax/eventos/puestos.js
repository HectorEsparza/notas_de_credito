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

        if(auxiliar=="RECURSOS HUMANOS"||auxiliar=="CONTABILIDAD"||auxiliar=="ADMINISTRADOR"){
            $('<option value="">Seleccionar de la Lista</option>'+
            '<option value="Ejecutivo Recursos Humanos">Ejecutivo Recursos Humanos</option>'+
            '<option value="Ejecutivo Contable">Ejecutivo Contable</option>'+
            '<option value="Auxiliar Vigilante">Auxiliar Vigilante</option>'+
            '<option value="Vigilante">Vigilante</option>'+
            '<option value="Supervisor">Supervisor</option>'+
            '<option value="Prensista">Prensista</option>'+
            '<option value="Chofer">Chofer</option>'+
            '<option value="Supervisor en Capacitacion">Supervisor en Capacitacion</option>'+
            '<option value="Auxiliar de Reparto">Auxiliar de Reparto</option>'+
            '<option value="Ejecutivo Atencion a Clientes">Ejecutivo Atencion a Clientes</option>'+
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
            '<option value="Mecanico Aparatista">Mecanico</option>'+
            '<option value="Operador de Cizalla">Operador de Cizalla</option>'+
            '<option value="Operador de Troqueladora">Operador de Troqueladora</option>'+
            '<option value="Operador de Torno">Operador de Torno</option>'+
            '<option value="Soldador">Soldador</option>'+
            '<option value="Machueleador">Machueleador</option>'+
            '<option value="Ayudante General">Ayudante General</option>'+
            '<option value="Pintor">Pintor</option>'+
            '<option value="Almacenista">Almacenista</option>'+
            '<option value="Supervisor">Supervisor</option>'+
            '<option value="Supervisor en Capacitacion">Supervisor en Capacitacion</option>'+
            '<option value="">Seleccionar de la Lista</option>'+
            '<option value="Etiquetador">Etiquetador</option>'+
            '<option value="Auxiliar de Autoclave">Auxiliar de Autoclave</option>'+
            '<option value="Recortador">Recortador</option>'+
            '<option value="Pesador">Pesador</option>'+
            '<option value="Operador de Extrusora">Operador de Extrusora</option>'+
            '<option value="Operador Molino">Operador Molino</option>'+
            '<option value="Vigilante">Vigilante</option>'+
            '<option value="Operador de Autoclave">Operador de Autoclave</option>'+
            '<option value="Gerente">Gerente</option>'+
            '<option value="Auxiliar Mantenimiento">Auxiliar Mantenimiento</option>'+
            '<option value="Supervisor Mantenimiento">Supervisor Mantenimiento</option>').appendTo(vistaPuesto);
        }
        else if(auxiliar=="VENTAS"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value="">Seleccionar de la Lista</option>'+
              '<option value="Vigilante">Vigilante</option>'+
              '<option value="Supervisor">Supervisor</option>'+
              '<option value="Chofer">Chofer</option>'+
              '<option value="Supervisor en Capacitacion">Supervisor en Capacitacion</option>'+
              '<option value="Auxiliar de Reparto">Auxiliar de Reparto</option>'+
              '<option value="Ejecutivo Atencion a Clientes">Ejecutivo Atencion a Clientes</option>'+
              '<option value="Auxiliar Vigilante">Auxiliar Vigilante</option>').appendTo(vistaPuesto);
        }
        else if(auxiliar=="PRODUCCION SOPORTE"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value="">Seleccionar de la Lista</option>'+
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
              '<option value="Mecanico Aparatista">Mecanico</option>'+
              '<option value="Operador de Cizalla">Operador de Cizalla</option>'+
              '<option value="Operador de Troqueladora">Operador de Troqueladora</option>'+
              '<option value="Operador de Torno">Operador de Torno</option>'+
              '<option value="Soldador">Soldador</option>'+
              '<option value="Machueleador">Machueleador</option>'+
              '<option value="Ayudante General">Ayudante General</option>').appendTo(vistaPuesto);
        }
        else if(auxiliar=="ALMACEN"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value="">Seleccionar de la Lista</option>'+
              '<option value="Pintor">Pintor</option>'+
              '<option value="Almacenista">Almacenista</option>'+
              '<option value="Supervisor">Supervisor</option>'+
              '<option value="Supervisor en Capacitacion">Supervisor en Capacitacion</option>').appendTo(vistaPuesto);
        }

        else if (auxiliar=="PRODUCCION MANGUERA"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value="">Seleccionar de la Lista</option>'+
              '<option value="Etiquetador">Etiquetador</option>'+
              '<option value="Auxiliar de Autoclave">Auxiliar de Autoclave</option>'+
              '<option value="Recortador">Recortador</option>'+
              '<option value="Pesador">Pesador</option>'+
              '<option value="Operador de Extrusora">Operador de Extrusora</option>'+
              '<option value="Operador Molino">Operador Molino</option>'+
              '<option value="Supervisor en Capacitacion">Supervisor en Capacitacion</option>'+
              '<option value="Vigilante">Vigilante</option>'+
              '<option value="Operador de Autoclave">Operador de Autoclave</option>'+
              '<option value="Supervisor">Supervisor</option>'+
              '<option value="Gerente">Gerente</option>'+
              '<option value="Auxiliar Mantenimiento">Auxiliar Mantenimiento</option>'+
              '<option value="Supervisor Mantenimiento">Supervisor Mantenimiento</option>').appendTo(vistaPuesto);
        }

        else if(auxiliar=="CREDITO Y COBRANZA"){
            console.log("Agregando el select "+auxiliar.length);
            $('<option value="">Seleccionar de la Lista</option>'+
              '<option value="Ayudante General">Ayudante General</option>').appendTo(vistaPuesto);
        }









});
