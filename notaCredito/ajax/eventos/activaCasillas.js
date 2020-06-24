$(document).ready(function(){

    // for (var i = 1; i <=9; i++) {
    //   var cont = i+1;
    //   $("#clave"+i).change(function(){
    //     alert("Oralee Muchachon!!!");
    //         if($("#clave"+i).val()!=""){
    //           $("#clave"+cont).prop("readonly", false);
    //           $("#cantidad"+cont).prop("readonly", false);
    //         }
    //         else{
    //           $("#clave"+cont).prop("readonly", true);
    //           $("#cantidad"+cont).prop("readonly", true);
    //         }
    //   });
    // }
    $("#clave1").change(function(){
          if($("#clave1").val()!=""){
            $("#clave2").prop("readonly", false);
            $("#cantidad2").prop("readonly", false);
            $("#devolucion2").prop("disabled", false);
            $("#devolucion1").prop("required", true);
            $("#penalizacion").show();
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave2").prop("readonly", true);
            $("#cantidad2").prop("readonly", true);
            $("#devolucion2").prop("disabled", true);
            $("#devolucion1").prop("required", false);
            $("#penalizacion").hide();
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave2").change(function(){
          if($("#clave2").val()!=""){
            $("#clave3").prop("readonly", false);
            $("#cantidad3").prop("readonly", false);
            $("#devolucion3").prop("disabled", false);
            $("#devolucion2").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave3").prop("readonly", true);
            $("#cantidad3").prop("readonly", true);
            $("#devolucion3").prop("disabled", true);
            $("#devolucion2").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave3").change(function(){
          if($("#clave3").val()!=""){
            $("#clave4").prop("readonly", false);
            $("#cantidad4").prop("readonly", false);
            $("#devolucion4").prop("disabled", false);
            $("#devolucion3").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave4").prop("readonly", true);
            $("#cantidad4").prop("readonly", true);
            $("#devolucion4").prop("disabled", true);
            $("#devolucion3").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave4").change(function(){
          if($("#clave4").val()!=""){
            $("#clave5").prop("readonly", false);
            $("#cantidad5").prop("readonly", false);
            $("#devolucion5").prop("disabled", false);
            $("#devolucion4").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave5").prop("readonly", true);
            $("#cantidad5").prop("readonly", true);
            $("#devolucion5").prop("disabled", true);
            $("#devolucion4").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave5").change(function(){
          if($("#clave5").val()!=""){
            $("#clave6").prop("readonly", false);
            $("#cantidad6").prop("readonly", false);
            $("#devolucion6").prop("disabled", false);
            $("#devolucion5").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave6").prop("readonly", true);
            $("#cantidad6").prop("readonly", true);
            $("#devolucion6").prop("disabled", true);
            $("#devolucion5").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave6").change(function(){
          if($("#clave6").val()!=""){
            $("#clave7").prop("readonly", false);
            $("#cantidad7").prop("readonly", false);
            $("#devolucion7").prop("disabled", false);
            $("#devolucion6").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave7").prop("readonly", true);
            $("#cantidad7").prop("readonly", true);
            $("#devolucion7").prop("disabled", true);
            $("#devolucion6").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave7").change(function(){
          if($("#clave7").val()!=""){
            $("#clave8").prop("readonly", false);
            $("#cantidad8").prop("readonly", false);
            $("#devolucion8").prop("disabled", false);
            $("#devolucion7").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave8").prop("readonly", true);
            $("#cantidad8").prop("readonly", true);
            $("#devolucion8").prop("disabled", true);
            $("#devolucion7").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave8").change(function(){
          if($("#clave8").val()!=""){
            $("#clave9").prop("readonly", false);
            $("#cantidad9").prop("readonly", false);
            $("#devolucion9").prop("disabled", false);
            $("#devolucion8").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave9").prop("readonly", true);
            $("#cantidad9").prop("readonly", true);
            $("#devolucion9").prop("disabled", true);
            $("#devolucion8").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave9").change(function(){
          if($("#clave9").val()!=""){
            $("#clave10").prop("readonly", false);
            $("#cantidad10").prop("readonly", false);
            $("#devolucion10").prop("disabled", false);
            $("#devolucion9").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave10").prop("readonly", true);
            $("#cantidad10").prop("readonly", true);
            $("#devolucion10").prop("disabled", true);
            $("#devolucion9").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave10").change(function(){
          if($("#clave10").val()!=""){
            $("#clave11").prop("readonly", false);
            $("#cantidad11").prop("readonly", false);
            $("#devolucion11").prop("disabled", false);
            $("#devolucion10").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave11").prop("readonly", true);
            $("#cantidad11").prop("readonly", true);
            $("#devolucion11").prop("disabled", true);
            $("#devolucion10").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave11").change(function(){
          if($("#clave11").val()!=""){
            $("#clave12").prop("readonly", false);
            $("#cantidad12").prop("readonly", false);
            $("#devolucion12").prop("disabled", false);
            $("#devolucion11").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave12").prop("readonly", true);
            $("#cantidad12").prop("readonly", true);
            $("#devolucion12").prop("disabled", true);
            $("#devolucion11").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave12").change(function(){
          if($("#clave12").val()!=""){
            $("#clave13").prop("readonly", false);
            $("#cantidad13").prop("readonly", false);
            $("#devolucion13").prop("disabled", false);
            $("#devolucion12").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave13").prop("readonly", true);
            $("#cantidad13").prop("readonly", true);
            $("#devolucion13").prop("disabled", true);
            $("#devolucion12").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave13").change(function(){
          if($("#clave13").val()!=""){
            $("#clave14").prop("readonly", false);
            $("#cantidad14").prop("readonly", false);
            $("#devolucion14").prop("disabled", false);
            $("#devolucion13").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave14").prop("readonly", true);
            $("#cantidad14").prop("readonly", true);
            $("#devolucion14").prop("disabled", true);
            $("#devolucion13").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave14").change(function(){
          if($("#clave14").val()!=""){
            $("#clave15").prop("readonly", false);
            $("#cantidad15").prop("readonly", false);
            $("#devolucion15").prop("disabled", false);
            $("#devolucion14").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave15").prop("readonly", true);
            $("#cantidad15").prop("readonly", true);
            $("#devolucion15").prop("disabled", true);
            $("#devolucion14").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave15").change(function(){
          if($("#clave15").val()!=""){
            $("#clave16").prop("readonly", false);
            $("#cantidad16").prop("readonly", false);
            $("#devolucion16").prop("disabled", false);
            $("#devolucion15").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave16").prop("readonly", true);
            $("#cantidad16").prop("readonly", true);
            $("#devolucion16").prop("disabled", true);
            $("#devolucion15").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave16").change(function(){
          if($("#clave16").val()!=""){
            $("#clave17").prop("readonly", false);
            $("#cantidad17").prop("readonly", false);
            $("#devolucion17").prop("disabled", false);
            $("#devolucion16").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave17").prop("readonly", true);
            $("#cantidad17").prop("readonly", true);
            $("#devolucion17").prop("disabled", true);
            $("#devolucion16").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave17").change(function(){
          if($("#clave17").val()!=""){
            $("#clave18").prop("readonly", false);
            $("#cantidad18").prop("readonly", false);
            $("#devolucion18").prop("disabled", false);
            $("#devolucion17").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave18").prop("readonly", true);
            $("#cantidad18").prop("readonly", true);
            $("#devolucion18").prop("disabled", true);
            $("#devolucion17").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave18").change(function(){
          if($("#clave18").val()!=""){
            $("#clave19").prop("readonly", false);
            $("#cantidad19").prop("readonly", false);
            $("#devolucion19").prop("disabled", false);
            $("#devolucion18").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave19").prop("readonly", true);
            $("#cantidad19").prop("readonly", true);
            $("#devolucion19").prop("disabled", true);
            $("#devolucion18").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave19").change(function(){
          if($("#clave19").val()!=""){
            $("#clave20").prop("readonly", false);
            $("#cantidad20").prop("readonly", false);
            $("#devolucion20").prop("disabled", false);
            $("#devolucion19").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave20").prop("readonly", true);
            $("#cantidad20").prop("readonly", true);
            $("#devolucion20").prop("disabled", true);
            $("#devolucion19").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave20").change(function(){
          if($("#clave20").val()!=""){
            $("#clave21").prop("readonly", false);
            $("#cantidad21").prop("readonly", false);
            $("#devolucion21").prop("disabled", false);
            $("#devolucion20").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave21").prop("readonly", true);
            $("#cantidad21").prop("readonly", true);
            $("#devolucion21").prop("disabled", true);
            $("#devolucion20").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave21").change(function(){
          if($("#clave21").val()!=""){
            $("#clave22").prop("readonly", false);
            $("#cantidad22").prop("readonly", false);
            $("#devolucion22").prop("disabled", false);
            $("#devolucion21").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave22").prop("readonly", true);
            $("#cantidad22").prop("readonly", true);
            $("#devolucion22").prop("disabled", true);
            $("#devolucion21").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave22").change(function(){
          if($("#clave22").val()!=""){
            $("#clave23").prop("readonly", false);
            $("#cantidad23").prop("readonly", false);
            $("#devolucion23").prop("disabled", false);
            $("#devolucion22").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave23").prop("readonly", true);
            $("#cantidad23").prop("readonly", true);
            $("#devolucion23").prop("disabled", true);
            $("#devolucion22").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave23").change(function(){
          if($("#clave23").val()!=""){
            $("#clave24").prop("readonly", false);
            $("#cantidad24").prop("readonly", false);
            $("#devolucion24").prop("disabled", false);
            $("#devolucion23").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave24").prop("readonly", true);
            $("#cantidad24").prop("readonly", true);
            $("#devolucion24").prop("disabled", true);
            $("#devolucion23").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave24").change(function(){
          if($("#clave24").val()!=""){
            $("#clave25").prop("readonly", false);
            $("#cantidad25").prop("readonly", false);
            $("#devolucion25").prop("disabled", false);
            $("#devolucion24").prop("required", true);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
          }
          else{
            $("#clave25").prop("readonly", true);
            $("#cantidad25").prop("readonly", true);
            $("#devolucion25").prop("disabled", true);
            $("#devolucion24").prop("required", false);
            //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
          }
    });

    $("#clave25").change(function(){
      if($("#clave25").val()!=""){
        $("#clave26").prop("readonly", false);
        $("#cantidad26").prop("readonly", false);
        $("#devolucion26").prop("disabled", false);
        $("#devolucion25").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave26").prop("readonly", true);
        $("#cantidad26").prop("readonly", true);
        $("#devolucion26").prop("disabled", true);
        $("#devolucion25").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave26").change(function(){
      if($("#clave26").val()!=""){
        $("#clave27").prop("readonly", false);
        $("#cantidad27").prop("readonly", false);
        $("#devolucion27").prop("disabled", false);
        $("#devolucion26").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave27").prop("readonly", true);
        $("#cantidad27").prop("readonly", true);
        $("#devolucion27").prop("disabled", true);
        $("#devolucion26").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave27").change(function(){
      if($("#clave27").val()!=""){
        $("#clave28").prop("readonly", false);
        $("#cantidad28").prop("readonly", false);
        $("#devolucion28").prop("disabled", false);
        $("#devolucion27").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave28").prop("readonly", true);
        $("#cantidad28").prop("readonly", true);
        $("#devolucion28").prop("disabled", true);
        $("#devolucion27").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave28").change(function(){
      if($("#clave28").val()!=""){
        $("#clave29").prop("readonly", false);
        $("#cantidad29").prop("readonly", false);
        $("#devolucion29").prop("disabled", false);
        $("#devolucion28").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave29").prop("readonly", true);
        $("#cantidad29").prop("readonly", true);
        $("#devolucion29").prop("disabled", true);
        $("#devolucion28").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave29").change(function(){
      if($("#clave29").val()!=""){
        $("#clave30").prop("readonly", false);
        $("#cantidad30").prop("readonly", false);
        $("#devolucion30").prop("disabled", false);
        $("#devolucion29").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave30").prop("readonly", true);
        $("#cantidad30").prop("readonly", true);
        $("#devolucion30").prop("disabled", true);
        $("#devolucion29").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave30").change(function(){
      if($("#clave30").val()!=""){
        $("#clave31").prop("readonly", false);
        $("#cantidad31").prop("readonly", false);
        $("#devolucion31").prop("disabled", false);
        $("#devolucion30").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave31").prop("readonly", true);
        $("#cantidad31").prop("readonly", true);
        $("#devolucion31").prop("disabled", true);
        $("#devolucion30").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave31").change(function(){
      if($("#clave31").val()!=""){
        $("#clave32").prop("readonly", false);
        $("#cantidad32").prop("readonly", false);
        $("#devolucion32").prop("disabled", false);
        $("#devolucion31").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave32").prop("readonly", true);
        $("#cantidad32").prop("readonly", true);
        $("#devolucion32").prop("disabled", true);
        $("#devolucion31").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave32").change(function(){
      if($("#clave32").val()!=""){
        $("#clave33").prop("readonly", false);
        $("#cantidad33").prop("readonly", false);
        $("#devolucion33").prop("disabled", false);
        $("#devolucion32").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave33").prop("readonly", true);
        $("#cantidad33").prop("readonly", true);
        $("#devolucion33").prop("disabled", true);
        $("#devolucion32").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave33").change(function(){
      if($("#clave33").val()!=""){
        $("#clave34").prop("readonly", false);
        $("#cantidad34").prop("readonly", false);
        $("#devolucion34").prop("disabled", false);
        $("#devolucion33").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave34").prop("readonly", true);
        $("#cantidad34").prop("readonly", true);
        $("#devolucion34").prop("disabled", true);
        $("#devolucion33").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave34").change(function(){
      if($("#clave34").val()!=""){
        $("#clave35").prop("readonly", false);
        $("#cantidad35").prop("readonly", false);
        $("#devolucion35").prop("disabled", false);
        $("#devolucion34").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave35").prop("readonly", true);
        $("#cantidad35").prop("readonly", true);
        $("#devolucion35").prop("disabled", true);
        $("#devolucion34").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave35").change(function(){
      if($("#clave35").val()!=""){
        $("#clave36").prop("readonly", false);
        $("#cantidad36").prop("readonly", false);
        $("#devolucion36").prop("disabled", false);
        $("#devolucion35").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave36").prop("readonly", true);
        $("#cantidad36").prop("readonly", true);
        $("#devolucion36").prop("disabled", true);
        $("#devolucion35").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave36").change(function(){
      if($("#clave36").val()!=""){
        $("#clave37").prop("readonly", false);
        $("#cantidad37").prop("readonly", false);
        $("#devolucion37").prop("disabled", false);
        $("#devolucion36").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave37").prop("readonly", true);
        $("#cantidad37").prop("readonly", true);
        $("#devolucion37").prop("disabled", true);
        $("#devolucion36").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave37").change(function(){
      if($("#clave37").val()!=""){
        $("#clave38").prop("readonly", false);
        $("#cantidad38").prop("readonly", false);
        $("#devolucion38").prop("disabled", false);
        $("#devolucion37").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave38").prop("readonly", true);
        $("#cantidad38").prop("readonly", true);
        $("#devolucion38").prop("disabled", true);
        $("#devolucion37").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave38").change(function(){
      if($("#clave38").val()!=""){
        $("#clave39").prop("readonly", false);
        $("#cantidad39").prop("readonly", false);
        $("#devolucion39").prop("disabled", false);
        $("#devolucion38").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave39").prop("readonly", true);
        $("#cantidad39").prop("readonly", true);
        $("#devolucion39").prop("disabled", true);
        $("#devolucion38").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    $("#clave39").change(function(){
      if($("#clave39").val()!=""){
        $("#clave40").prop("readonly", false);
        $("#cantidad40").prop("readonly", false);
        $("#devolucion40").prop("disabled", false);
        $("#devolucion39").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#clave40").prop("readonly", true);
        $("#cantidad40").prop("readonly", true);
        $("#devolucion40").prop("disabled", true);
        $("#devolucion39").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });

    

    $("#clave40").change(function(){
      if($("#clave40").val()!=""){
        $("#devolucion40").prop("required", true);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())+1);
      }
      else{
        $("#devolucion40").prop("required", false);
        //$("#contadorPenalizacion").val(parseInt($("#contadorPenalizacion").val())-1);
      }
    });
});
