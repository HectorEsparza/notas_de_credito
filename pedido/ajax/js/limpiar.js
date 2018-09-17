function limpiar()
  {

      var conexion;
      if (window.XMLHttpRequest)
      {
        conexion = new XMLHttpRequest();
      }
      else
      {
        conexion = new ActiveXObject("Microsoft.XMLHTTP");
      }

      conexion.onreadystatechange = function()
      {
        if (conexion.readyState==4 && conexion.status==200)
        {
            document.getElementById('listas').innerHTML = conexion.responseText;

        }
      }

      conexion.open("GET", "ajax/limpiar.php", true);
      conexion.send();
   }
