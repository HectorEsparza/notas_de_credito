function calculoPenalizacion(porcentaje, total)
{
       function totalSub(importe, descuento){
         var x = descuento/100;
         var y = importe-(importe*x);
         var z = Math.round(y*100)/100;
         return z;
       }
       function iva(subtotal){

         var x = subtotal*.16;
         var y = Math.round(x * 100) / 100;
         return y;
       }

       function total(iva, subtotal){
         var resultado = Math.round((iva + subtotal)*100) / 100;
         return resultado;
       }
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
       var conexion;
       var totalOculto;
       var porcentajeOculto;
       var contador = $("#contadorSubtotal").val();
       var totalPenalizacion = 0;
       var penalizacion = 0;
       // if(document.getElementById('costo2').innerText!=""){
       //   alert(document.getElementById('costo2').innerText);
       // }
       // else{
       //   alert("Adios");
       // }
       for (var i = 1; i <= contador; i++) {
         if(document.getElementById('costo'+i).innerText!=""){

           var costo = document.getElementById('costo'+i).innerText;
           costo = costo.replace(',', "");
           costo = costo.split("$");
           costo = parseFloat(costo[1]);
           console.log(costo);
           $("#subtotalPenalizacion"+i).val(costo);
           if($("#cantidad"+i).val()>0 && costo>0){
             var costoPenalizacion = totalSub(costo, porcentaje);
             var importePenalizacion = Math.round(($("#cantidad"+i).val()*costoPenalizacion)*100)/100;
             var subtotalPenalizacion = Math.round((totalSub(importePenalizacion, $("#descuentoConsulta").val()))*100)/100;
             var funcion = "listas(document.querySelector('.clave"+i+"').value, "+i+", document.getElementById('user').value)";
             document.getElementById('costo'+i).innerHTML = '$'+formatNumber.new(costoPenalizacion)+'<input type="button" class="boton" value="?" onclick="'+funcion+'" />';
             $("#importeNota"+i).text("$"+formatNumber.new(importePenalizacion));
             $("#subtotal"+i).text("$"+formatNumber.new(subtotalPenalizacion));
             totalPenalizacion += subtotalPenalizacion;
             penalizacion += costo-costoPenalizacion;
           }
           else{
             var costoPenalizacion = totalSub(costo, porcentaje);
             var funcion = "listas(document.querySelector('.clave"+i+"').value, "+i+", document.getElementById('user').value)";
             document.getElementById('costo'+i).innerHTML = '$'+formatNumber.new(costoPenalizacion)+'<input type="button" class="boton" value="?" onclick="'+funcion+'" />';
             $("#importeNota"+i).text("$"+formatNumber.new(costoPenalizacion));
             $("#subtotal"+i).text("$"+formatNumber.new(costoPenalizacion));
             totalPenalizacion += subtotalPenalizacion;
             penalizacion += costo-costoPenalizacion;
           }

         }
       }
       $("#subtotalNota").val("$"+formatNumber.new(Math.round(totalPenalizacion*100)/100));
       $("#iva").val("$"+formatNumber.new(Math.round(iva(totalPenalizacion)*100)/100));
       $("#totalNota").val("$"+formatNumber.new(Math.round(total(iva(totalPenalizacion), totalPenalizacion)*100)/100));
       $("#penalizacionNota").val(Math.round(penalizacion*100)/100);
       $("#porcentaje").val(porcentaje);
       // console.log(Math.round(totalPenalizacion*100)/100);
       // totalOculto = total.replace(',', '');
       // totalOculto = totalOculto.split("$");
       // descuento = parseFloat(totalOculto[1]);
       // porcentajeOculto = porcentaje/100;
       // descuento = descuento*porcentajeOculto;
       // descuento = Math.round(descuento*100)/100;
       // document.getElementById('penalizacionNota').value = descuento;
       // document.getElementById('porcentaje').value = porcentaje;
       $("#cancelaPenalizacion").show();
       $("#penalizacion").hide();

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
               if(conexion.readyState==4 && conexion.status==200)
               {
                   //document.getElementById('pen').innerHTML = conexion.responseText;
                   //document.getElementById('totalNota').value = conexion.responseText;

               }
             }

             conexion.open("GET", "ajax/calculoPenalizacion.php?porcentaje="+porcentaje+"&total="+total, true);
             conexion.send();

}
