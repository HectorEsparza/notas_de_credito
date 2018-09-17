var formulario = document.getElementsByName('formulario')[0];

var motivo = function(e)
  {
    if(document.getElementsByName('motivo')[0].value=="")
    {
      alert("Escribe el motivo por favor");
      e.preventDefault();
    }
  }

formulario.addEventListener("submit", motivo);
