function cli(str)
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
          document.getElementById('cliente').innerHTML = conexion.responseText;

        }
      }

      conexion.open("GET", "ajax/cliente.php?cliente="+str, true);
      conexion.send();
     }
