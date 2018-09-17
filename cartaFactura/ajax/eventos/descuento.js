var formulario = document.getElementsByName('formulario')[0];

var motivo = function(e)
  {
    if(document.getElementById('descuento').innerText=="")
    {
      alert("Selecciona un cliente válido, por favor");
      e.preventDefault();
    }
  }

formulario.addEventListener("submit", motivo);
