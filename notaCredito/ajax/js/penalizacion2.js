function penalizacion2(contra)
{

  var conexion;


      if (contra=="9MC70")
      {

        var params = "contra="+contra;

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
              //document.getElementById('costo'+i).innerHTML = conexion.responseText;
              document.getElementById('listas').innerHTML = conexion.responseText;

          }
        }

        conexion.open("POST", "ajax/penalizacion2.php", true);
        conexion.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        conexion.send(params);
      }
      else
      {
        alert("Permiso Denegado");
      }

}
