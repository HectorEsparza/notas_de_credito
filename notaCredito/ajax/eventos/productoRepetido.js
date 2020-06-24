$(document).ready(function(){

    // $("#clave1").blur(function(){
    //       if($("#clave1").val()!=""){
    //         $("#clave2").prop("readonly", false);
    //       }
    //       else{
    //         $("#clave2").prop("readonly", true);
    //       }
    // });
    $("#clave2").change(function(){

      var flag=0;

      var valor = document.getElementById('clave2').value;
      for (var i = 1; i<=2; i++) {
        if(i!=2){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave2").val("");
        $("#costo2").text("");
        $("#importeNota2").text("");
        $("#subtotal2").text("");
      }

    });
    $("#clave3").change(function(){

      var flag=0;

      var valor = document.getElementById('clave3').value;
      for (var i = 1; i<=3; i++) {
        if(i!=3){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave3").val("");
        $("#costo3").text("");
        $("#importeNota3").text("");
        $("#subtotal3").text("");
      }

    });
    $("#clave4").change(function(){

      var flag=0;

      var valor = document.getElementById('clave4').value;
      for (var i = 1; i<=4; i++) {
        if(i!=4){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave4").val("");
        $("#costo4").text("");
        $("#importeNota4").text("");
        $("#subtotal4").text("");
      }

    });
    $("#clave5").change(function(){

      var flag=0;

      var valor = document.getElementById('clave5').value;
      for (var i = 1; i<=5; i++) {
        if(i!=5){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave5").val("");
        $("#costo5").text("");
        $("#importeNota5").text("");
        $("#subtotal5").text("");
      }

    });
    $("#clave6").change(function(){

      var flag=0;

      var valor = document.getElementById('clave6').value;
      for (var i = 1; i<=6; i++) {
        if(i!=6){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave6").val("");
        $("#costo6").text("");
        $("#importeNota6").text("");
        $("#subtotal6").text("");
      }

    });
    $("#clave7").change(function(){

      var flag=0;

      var valor = document.getElementById('clave7').value;
      for (var i = 1; i<=7; i++) {
        if(i!=7){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave7").val("");
        $("#costo7").text("");
        $("#importeNota7").text("");
        $("#subtotal7").text("");
      }

    });
    $("#clave8").change(function(){

      var flag=0;

      var valor = document.getElementById('clave8').value;
      for (var i = 1; i<=8; i++) {
        if(i!=8){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave8").val("");
        $("#costo8").text("");
        $("#importeNota8").text("");
        $("#subtotal8").text("");
      }

    });
    $("#clave9").change(function(){

      var flag=0;

      var valor = document.getElementById('clave9').value;
      for (var i = 1; i<=9; i++) {
        if(i!=9){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave9").val("");
        $("#costo9").text("");
        $("#importeNota9").text("");
        $("#subtotal9").text("");
      }

    });
    $("#clave10").change(function(){

      var flag=0;

      var valor = document.getElementById('clave10').value;
      for (var i = 1; i<=10; i++) {
        if(i!=10){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave10").val("");
        $("#costo10").text("");
        $("#importeNota10").text("");
        $("#subtotal10").text("");
      }

    });
    $("#clave11").change(function(){

      var flag=0;

      var valor = document.getElementById('clave11').value;
      for (var i = 1; i<=11; i++) {
        if(i!=11){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave11").val("");
        $("#costo11").text("");
        $("#importeNota11").text("");
        $("#subtotal11").text("");
      }

    });
    $("#clave12").change(function(){

      var flag=0;

      var valor = document.getElementById('clave12').value;
      for (var i = 1; i<=12; i++) {
        if(i!=12){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave12").val("");
        $("#costo12").text("");
        $("#importeNota12").text("");
        $("#subtotal12").text("");
      }

    });
    $("#clave13").change(function(){

      var flag=0;

      var valor = document.getElementById('clave13').value;
      for (var i = 1; i<=13; i++) {
        if(i!=13){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave13").val("");
        $("#costo13").text("");
        $("#importeNota13").text("");
        $("#subtotal13").text("");
      }

    });
    $("#clave14").change(function(){

      var flag=0;

      var valor = document.getElementById('clave14').value;
      for (var i = 1; i<=14; i++) {
        if(i!=14){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave14").val("");
        $("#costo14").text("");
        $("#importeNota14").text("");
        $("#subtotal14").text("");
      }

    });
    $("#clave15").change(function(){

      var flag=0;

      var valor = document.getElementById('clave15').value;
      for (var i = 1; i<=15; i++) {
        if(i!=15){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave15").val("");
        $("#costo15").text("");
        $("#importeNota15").text("");
        $("#subtotal15").text("");
      }

    });
    $("#clave16").change(function(){

      var flag=0;

      var valor = document.getElementById('clave16').value;
      for (var i = 1; i<=16; i++) {
        if(i!=16){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave16").val("");
        $("#costo16").text("");
        $("#importeNota16").text("");
        $("#subtotal16").text("");
      }

    });
    $("#clave17").change(function(){

      var flag=0;

      var valor = document.getElementById('clave17').value;
      for (var i = 1; i<=17; i++) {
        if(i!=17){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave17").val("");
        $("#costo17").text("");
        $("#importeNota17").text("");
        $("#subtotal17").text("");
      }

    });
    $("#clave18").change(function(){

      var flag=0;

      var valor = document.getElementById('clave18').value;
      for (var i = 1; i<=18; i++) {
        if(i!=18){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave18").val("");
        $("#costo18").text("");
        $("#importeNota18").text("");
        $("#subtotal18").text("");
      }

    });
    $("#clave19").change(function(){

      var flag=0;

      var valor = document.getElementById('clave19').value;
      for (var i = 1; i<=19; i++) {
        if(i!=19){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave19").val("");
        $("#costo19").text("");
        $("#importeNota19").text("");
        $("#subtotal19").text("");
      }

    });
    $("#clave20").change(function(){

      var flag=0;

      var valor = document.getElementById('clave20').value;
      for (var i = 1; i<=20; i++) {
        if(i!=20){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave20").val("");
        $("#costo20").text("");
        $("#importeNota20").text("");
        $("#subtotal20").text("");
      }

    });
    $("#clave21").change(function(){

      var flag=0;

      var valor = document.getElementById('clave21').value;
      for (var i = 1; i<=21; i++) {
        if(i!=21){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave21").val("");
        $("#costo21").text("");
        $("#importeNota21").text("");
        $("#subtotal21").text("");
      }

    });
    $("#clave22").change(function(){

      var flag=0;

      var valor = document.getElementById('clave22').value;
      for (var i = 1; i<=22; i++) {
        if(i!=22){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave22").val("");
        $("#costo22").text("");
        $("#importeNota22").text("");
        $("#subtotal22").text("");
      }

    });
    $("#clave23").change(function(){

      var flag=0;

      var valor = document.getElementById('clave23').value;
      for (var i = 1; i<=23; i++) {
        if(i!=23){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave23").val("");
        $("#costo23").text("");
        $("#importeNota23").text("");
        $("#subtotal23").text("");
      }

    });
    $("#clave24").change(function(){

      var flag=0;

      var valor = document.getElementById('clave24').value;
      for (var i = 1; i<=24; i++) {
        if(i!=24){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave24").val("");
        $("#costo24").text("");
        $("#importeNota24").text("");
        $("#subtotal24").text("");
      }

    });

    $("#clave25").change(function(){

      var flag=0;

      var valor = document.getElementById('clave25').value;
      for (var i = 1; i<=25; i++) {
        if(i!=25){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave25").val("");
        $("#costo25").text("");
        $("#importeNota25").text("");
        $("#subtotal25").text("");
      }

    });

    $("#clave26").change(function(){

      var flag=0;

      var valor = document.getElementById('clave26').value;
      for (var i = 1; i<=26; i++) {
        if(i!=26){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave26").val("");
        $("#costo26").text("");
        $("#importeNota26").text("");
        $("#subtotal26").text("");
      }

    });

    $("#clave27").change(function(){

      var flag=0;

      var valor = document.getElementById('clave27').value;
      for (var i = 1; i<=27; i++) {
        if(i!=27){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave27").val("");
        $("#costo27").text("");
        $("#importeNota27").text("");
        $("#subtotal27").text("");
      }

    });

    $("#clave28").change(function(){

      var flag=0;

      var valor = document.getElementById('clave28').value;
      for (var i = 1; i<=28; i++) {
        if(i!=28){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave28").val("");
        $("#costo28").text("");
        $("#importeNota28").text("");
        $("#subtotal28").text("");
      }

    });

    $("#clave29").change(function(){

      var flag=0;

      var valor = document.getElementById('clave29').value;
      for (var i = 1; i<=29; i++) {
        if(i!=29){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave29").val("");
        $("#costo29").text("");
        $("#importeNota29").text("");
        $("#subtotal29").text("");
      }

    });

    $("#clave30").change(function(){

      var flag=0;

      var valor = document.getElementById('clave30').value;
      for (var i = 1; i<=30; i++) {
        if(i!=30){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave30").val("");
        $("#costo30").text("");
        $("#importeNota30").text("");
        $("#subtotal30").text("");
      }

    });

    $("#clave31").change(function(){

      var flag=0;

      var valor = document.getElementById('clave31').value;
      for (var i = 1; i<=31; i++) {
        if(i!=31){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave31").val("");
        $("#costo31").text("");
        $("#importeNota31").text("");
        $("#subtotal31").text("");
      }

    });

    $("#clave32").change(function(){

      var flag=0;

      var valor = document.getElementById('clave32').value;
      for (var i = 1; i<=32; i++) {
        if(i!=32){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave32").val("");
        $("#costo32").text("");
        $("#importeNota32").text("");
        $("#subtotal32").text("");
      }

    });

    $("#clave33").change(function(){

      var flag=0;

      var valor = document.getElementById('clave33').value;
      for (var i = 1; i<=33; i++) {
        if(i!=33){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave33").val("");
        $("#costo33").text("");
        $("#importeNota33").text("");
        $("#subtotal33").text("");
      }

    });

    $("#clave34").change(function(){

      var flag=0;

      var valor = document.getElementById('clave34').value;
      for (var i = 1; i<=34; i++) {
        if(i!=34){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave34").val("");
        $("#costo34").text("");
        $("#importeNota34").text("");
        $("#subtotal34").text("");
      }

    });

    $("#clave35").change(function(){

      var flag=0;

      var valor = document.getElementById('clave35').value;
      for (var i = 1; i<=35; i++) {
        if(i!=35){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave35").val("");
        $("#costo35").text("");
        $("#importeNota35").text("");
        $("#subtotal35").text("");
      }

    });

    $("#clave36").change(function(){

      var flag=0;

      var valor = document.getElementById('clave36').value;
      for (var i = 1; i<=36; i++) {
        if(i!=36){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave36").val("");
        $("#costo36").text("");
        $("#importeNota36").text("");
        $("#subtotal36").text("");
      }

    });

    $("#clave37").change(function(){

      var flag=0;

      var valor = document.getElementById('clave37').value;
      for (var i = 1; i<=37; i++) {
        if(i!=37){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave37").val("");
        $("#costo37").text("");
        $("#importeNota37").text("");
        $("#subtotal37").text("");
      }

    });

    $("#clave38").change(function(){

      var flag=0;

      var valor = document.getElementById('clave38').value;
      for (var i = 1; i<=38; i++) {
        if(i!=38){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave38").val("");
        $("#costo38").text("");
        $("#importeNota38").text("");
        $("#subtotal38").text("");
      }

    });

    $("#clave39").change(function(){

      var flag=0;

      var valor = document.getElementById('clave39').value;
      for (var i = 1; i<=39; i++) {
        if(i!=39){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave39").val("");
        $("#costo39").text("");
        $("#importeNota39").text("");
        $("#subtotal39").text("");
      }

    });

    $("#clave40").change(function(){

      var flag=0;

      var valor = document.getElementById('clave40').value;
      for (var i = 1; i<=40; i++) {
        if(i!=40){
          if(valor==document.getElementById('clave'+i).value){
            flag=1;
          }
        }
      }

      if(flag==1){
        alert("La clave de este producto ya ha sido capturada, por favor verificalo");
        $("#clave40").val("");
        $("#costo40").text("");
        $("#importeNota40").text("");
        $("#subtotal40").text("");
      }

    });

});
