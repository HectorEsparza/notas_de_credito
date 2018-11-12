$(document).ready(function(){

  var nombre = $("#nombre"),
      personaEmergencia = $("#personaEmergencia"),
      domicilioCaptura = $("#domicilioCaptura"),
      colonia = $("#colonia"),
      poblacion = $("#poblacion"),
      curpCaptura = $("#curpCaptura"),
      rfcCaptura = $("#rfcCaptura");

      nombre.change(function(){

        var dato = nombre.val();
        dato = dato.toUpperCase();
        nombre.val(dato);
      });

      personaEmergencia.change(function(){

        var dato = personaEmergencia.val();
        dato = dato.toUpperCase();
        personaEmergencia.val(dato);
      });

      domicilioCaptura.change(function(){

        var dato = domicilioCaptura.val();
        dato = dato.toUpperCase();
        domicilioCaptura.val(dato);
      });

      colonia.change(function(){

        var dato = colonia.val();
        dato = dato.toUpperCase();
        colonia.val(dato);
      });

      poblacion.change(function(){

        var dato = poblacion.val();
        dato = dato.toUpperCase();
        poblacion.val(dato);
      });

      curpCaptura.change(function(){

        var dato = curpCaptura.val();
        dato = dato.toUpperCase();
        curpCaptura.val(dato);
      });

      rfcCaptura.change(function(){

        var dato = rfcCaptura.val();
        dato = dato.toUpperCase();
        rfcCaptura.val(dato);
      });


});
