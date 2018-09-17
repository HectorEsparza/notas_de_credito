var formulario = document.getElementsByName('formulario')[0],
    elementos = formulario.elements,
    boton = document.getElementById('captura'),
    costo1 = document.getElementById('costo1').innerText;


    // var principal = function(e)
    // {
    //   if(elementos.clave1.value!=""&&document.getElementById('costo1').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave2.value!=""&&document.getElementById('costo2').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave3.value!=""&&document.getElementById('costo3').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave4.value!=""&&document.getElementById('costo4').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave5.value!=""&&document.getElementById('costo5').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave6.value!=""&&document.getElementById('costo6').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave7.value!=""&&document.getElementById('costo7').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave8.value!=""&&document.getElementById('costo8').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave9.value!=""&&document.getElementById('costo9').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    //   else if (elementos.clave10.value!=""&&document.getElementById('costo10').innerText=="")
    //   {
    //     alert("Hay Productos que no existen en la base de datos, por favor verificalos");
    //     e.preventDefault();
    //   }
    // }
    var validar = function(e)
    {
        if((elementos.cantidad1.value==0&&elementos.clave1.value!="")||(elementos.cantidad1.value!=0&&elementos.clave1.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }

        if((elementos.cantidad2.value==0&&elementos.clave2.value!="")||(elementos.cantidad2.value!=0&&elementos.clave2.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad3.value==0&&elementos.clave3.value!="")||(elementos.cantidad3.value!=0&&elementos.clave3.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad4.value==0&&elementos.clave4.value!="")||(elementos.cantidad4.value!=0&&elementos.clave4.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad5.value==0&&elementos.clave5.value!="")||(elementos.cantidad5.value!=0&&elementos.clave5.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad6.value==0&&elementos.clave6.value!="")||(elementos.cantidad6.value!=0&&elementos.clave6.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad7.value==0&&elementos.clave7.value!="")||(elementos.cantidad7.value!=0&&elementos.clave7.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad8.value==0&&elementos.clave8.value!="")||(elementos.cantidad8.value!=0&&elementos.clave8.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad9.value==0&&elementos.clave9.value!="")||(elementos.cantidad9.value!=0&&elementos.clave9.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad10.value==0&&elementos.clave10.value!="")||(elementos.cantidad10.value!=0&&elementos.clave10.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad11.value==0&&elementos.clave11.value!="")||(elementos.cantidad11.value!=0&&elementos.clave11.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad12.value==0&&elementos.clave12.value!="")||(elementos.cantidad12.value!=0&&elementos.clave12.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad13.value==0&&elementos.clave13.value!="")||(elementos.cantidad13.value!=0&&elementos.clave13.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad14.value==0&&elementos.clave14.value!="")||(elementos.cantidad14.value!=0&&elementos.clave14.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad15.value==0&&elementos.clave15.value!="")||(elementos.cantidad15.value!=0&&elementos.clave15.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad16.value==0&&elementos.clave16.value!="")||(elementos.cantidad16.value!=0&&elementos.clave16.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad17.value==0&&elementos.clave17.value!="")||(elementos.cantidad17.value!=0&&elementos.clave17.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad18.value==0&&elementos.clave18.value!="")||(elementos.cantidad18.value!=0&&elementos.clave18.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad19.value==0&&elementos.clave19.value!="")||(elementos.cantidad19.value!=0&&elementos.clave19.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad20.value==0&&elementos.clave20.value!="")||(elementos.cantidad20.value!=0&&elementos.clave20.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad21.value==0&&elementos.clave21.value!="")||(elementos.cantidad21.value!=0&&elementos.clave21.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad22.value==0&&elementos.clave22.value!="")||(elementos.cantidad22.value!=0&&elementos.clave22.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad23.value==0&&elementos.clave23.value!="")||(elementos.cantidad23.value!=0&&elementos.clave23.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad24.value==0&&elementos.clave24.value!="")||(elementos.cantidad24.value!=0&&elementos.clave24.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }
        else if((elementos.cantidad25.value==0&&elementos.clave25.value!="")||(elementos.cantidad25.value!=0&&elementos.clave25.value==""))
        {
          alert("Faltan llenar campos de cantidad o clave");
          e.preventDefault();
        }


      }




  formulario.addEventListener("submit", validar);
  // formulario.addEventListener("submit", principal);
