$(document).ready(function(){
  var formatNumber = {
     separador: ",", // separador para los miles
     sepDecimal: '.', // separador para los decimales
     formatear:function (num){
     num +='';
     var splitStr = num.split('.');
     var splitLeft = splitStr[0];
     var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
     var regx = /(\d+)(\d{3})/;
     while (regx.test(splitLeft)) {
     splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
     }
     return this.simbol + splitLeft +splitRight;
     },
     new:function(num, simbol){
     this.simbol = simbol ||'';
     return this.formatear(num);
     }
  }

  for (var i = 0; i < 15; i++){
    $("#factura"+i).blur(function(){
      var total = 0;
      var subtotal = 0;
      var auxiliar = [];

      for (var j = 1; j<=15; j++) {

        if(document.getElementById('importe'+j).innerText.length==1){
          auxiliar[j] = 0;
        }
        else{
          var valor = document.getElementById('importe'+j).innerText;
          var cadena = valor.split("$");
          auxiliar[j] = parseFloat(cadena[1]);
          console.log(auxiliar[j]);
        }
      }

      for (var j = 1; j<=15; j++) {
         subtotal = subtotal + auxiliar[j];
      }
      $("#total").text("$"+subtotal);
    });
  }

});
