var formulario = document.getElementsByName('formulario')[0];

var motivo = function(e)
  {
    if(document.getElementsByName('observaciones')[0].value=="")
    {
      alert("Escribe las observaciones, por favor");
      e.preventDefault();
    }
  }

formulario.addEventListener("submit", motivo);
