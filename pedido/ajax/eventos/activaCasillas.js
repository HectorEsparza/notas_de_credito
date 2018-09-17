$(document).ready(function(){

    // for (var i = 1; i <=9; i++) {
    //   var cont = i+1;
    //   $("#clave"+i).blur(function(){
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
    $("#clave1").blur(function(){
          if($("#clave1").val()!=""){
            $("#clave2").prop("readonly", false);
            $("#cantidad2").prop("readonly", false);
            $("#devolucion2").prop("disabled", false);
            $("#devolucion1").prop("required", true);
            $("#penalizacion").show();
          }
          else{
            $("#clave2").prop("readonly", true);
            $("#cantidad2").prop("readonly", true);
            $("#devolucion2").prop("disabled", true);
            $("#devolucion1").prop("required", false);
            $("#penalizacion").hide();
          }
    });

    $("#clave2").blur(function(){
          if($("#clave2").val()!=""){
            $("#clave3").prop("readonly", false);
            $("#cantidad3").prop("readonly", false);
            $("#devolucion3").prop("disabled", false);
            $("#devolucion2").prop("required", true);
          }
          else{
            $("#clave3").prop("readonly", true);
            $("#cantidad3").prop("readonly", true);
            $("#devolucion3").prop("disabled", true);
            $("#devolucion2").prop("required", false);
          }
    });

    $("#clave3").blur(function(){
          if($("#clave3").val()!=""){
            $("#clave4").prop("readonly", false);
            $("#cantidad4").prop("readonly", false);
            $("#devolucion4").prop("disabled", false);
            $("#devolucion3").prop("required", true);
          }
          else{
            $("#clave4").prop("readonly", true);
            $("#cantidad4").prop("readonly", true);
            $("#devolucion4").prop("disabled", true);
            $("#devolucion3").prop("required", false);
          }
    });

    $("#clave4").blur(function(){
          if($("#clave4").val()!=""){
            $("#clave5").prop("readonly", false);
            $("#cantidad5").prop("readonly", false);
            $("#devolucion5").prop("disabled", false);
            $("#devolucion4").prop("required", true);
          }
          else{
            $("#clave5").prop("readonly", true);
            $("#cantidad5").prop("readonly", true);
            $("#devolucion5").prop("disabled", true);
            $("#devolucion4").prop("required", false);
          }
    });

    $("#clave5").blur(function(){
          if($("#clave5").val()!=""){
            $("#clave6").prop("readonly", false);
            $("#cantidad6").prop("readonly", false);
            $("#devolucion6").prop("disabled", false);
            $("#devolucion5").prop("required", true);
          }
          else{
            $("#clave6").prop("readonly", true);
            $("#cantidad6").prop("readonly", true);
            $("#devolucion6").prop("disabled", true);
            $("#devolucion5").prop("required", false);
          }
    });

    $("#clave6").blur(function(){
          if($("#clave6").val()!=""){
            $("#clave7").prop("readonly", false);
            $("#cantidad7").prop("readonly", false);
            $("#devolucion7").prop("disabled", false);
            $("#devolucion6").prop("required", true);
          }
          else{
            $("#clave7").prop("readonly", true);
            $("#cantidad7").prop("readonly", true);
            $("#devolucion7").prop("disabled", true);
            $("#devolucion6").prop("required", false);
          }
    });

    $("#clave7").blur(function(){
          if($("#clave7").val()!=""){
            $("#clave8").prop("readonly", false);
            $("#cantidad8").prop("readonly", false);
            $("#devolucion8").prop("disabled", false);
            $("#devolucion7").prop("required", true);
          }
          else{
            $("#clave8").prop("readonly", true);
            $("#cantidad8").prop("readonly", true);
            $("#devolucion8").prop("disabled", true);
            $("#devolucion7").prop("required", false);
          }
    });

    $("#clave8").blur(function(){
          if($("#clave8").val()!=""){
            $("#clave9").prop("readonly", false);
            $("#cantidad9").prop("readonly", false);
            $("#devolucion9").prop("disabled", false);
            $("#devolucion8").prop("required", true);
          }
          else{
            $("#clave9").prop("readonly", true);
            $("#cantidad9").prop("readonly", true);
            $("#devolucion9").prop("disabled", true);
            $("#devolucion8").prop("required", false);
          }
    });

    $("#clave9").blur(function(){
          if($("#clave9").val()!=""){
            $("#clave10").prop("readonly", false);
            $("#cantidad10").prop("readonly", false);
            $("#devolucion10").prop("disabled", false);
            $("#devolucion9").prop("required", true);
          }
          else{
            $("#clave10").prop("readonly", true);
            $("#cantidad10").prop("readonly", true);
            $("#devolucion10").prop("disabled", true);
            $("#devolucion9").prop("required", false);
          }
    });

    $("#clave10").blur(function(){
          if($("#clave10").val()!=""){
            $("#clave11").prop("readonly", false);
            $("#cantidad11").prop("readonly", false);
            $("#devolucion11").prop("disabled", false);
            $("#devolucion10").prop("required", true);
          }
          else{
            $("#clave11").prop("readonly", true);
            $("#cantidad11").prop("readonly", true);
            $("#devolucion11").prop("disabled", true);
            $("#devolucion10").prop("required", false);
          }
    });

    $("#clave11").blur(function(){
          if($("#clave11").val()!=""){
            $("#clave12").prop("readonly", false);
            $("#cantidad12").prop("readonly", false);
            $("#devolucion12").prop("disabled", false);
            $("#devolucion11").prop("required", true);
          }
          else{
            $("#clave12").prop("readonly", true);
            $("#cantidad12").prop("readonly", true);
            $("#devolucion12").prop("disabled", true);
            $("#devolucion11").prop("required", false);
          }
    });

    $("#clave12").blur(function(){
          if($("#clave12").val()!=""){
            $("#clave13").prop("readonly", false);
            $("#cantidad13").prop("readonly", false);
            $("#devolucion13").prop("disabled", false);
            $("#devolucion12").prop("required", true);
          }
          else{
            $("#clave13").prop("readonly", true);
            $("#cantidad13").prop("readonly", true);
            $("#devolucion13").prop("disabled", true);
            $("#devolucion12").prop("required", false);
          }
    });

    $("#clave13").blur(function(){
          if($("#clave13").val()!=""){
            $("#clave14").prop("readonly", false);
            $("#cantidad14").prop("readonly", false);
            $("#devolucion14").prop("disabled", false);
            $("#devolucion13").prop("required", true);
          }
          else{
            $("#clave14").prop("readonly", true);
            $("#cantidad14").prop("readonly", true);
            $("#devolucion14").prop("disabled", true);
            $("#devolucion13").prop("required", false);
          }
    });

    $("#clave14").blur(function(){
          if($("#clave14").val()!=""){
            $("#clave15").prop("readonly", false);
            $("#cantidad15").prop("readonly", false);
            $("#devolucion15").prop("disabled", false);
            $("#devolucion14").prop("required", true);
          }
          else{
            $("#clave15").prop("readonly", true);
            $("#cantidad15").prop("readonly", true);
            $("#devolucion15").prop("disabled", true);
            $("#devolucion14").prop("required", false);
          }
    });

    $("#clave15").blur(function(){
          if($("#clave15").val()!=""){
            $("#clave16").prop("readonly", false);
            $("#cantidad16").prop("readonly", false);
            $("#devolucion16").prop("disabled", false);
            $("#devolucion15").prop("required", true);
          }
          else{
            $("#clave16").prop("readonly", true);
            $("#cantidad16").prop("readonly", true);
            $("#devolucion16").prop("disabled", true);
            $("#devolucion15").prop("required", false);
          }
    });

    $("#clave16").blur(function(){
          if($("#clave16").val()!=""){
            $("#clave17").prop("readonly", false);
            $("#cantidad17").prop("readonly", false);
            $("#devolucion17").prop("disabled", false);
            $("#devolucion16").prop("required", true);
          }
          else{
            $("#clave17").prop("readonly", true);
            $("#cantidad17").prop("readonly", true);
            $("#devolucion17").prop("disabled", true);
            $("#devolucion16").prop("required", false);
          }
    });

    $("#clave17").blur(function(){
          if($("#clave17").val()!=""){
            $("#clave18").prop("readonly", false);
            $("#cantidad18").prop("readonly", false);
            $("#devolucion18").prop("disabled", false);
            $("#devolucion17").prop("required", true);
          }
          else{
            $("#clave18").prop("readonly", true);
            $("#cantidad18").prop("readonly", true);
            $("#devolucion18").prop("disabled", true);
            $("#devolucion17").prop("required", false);
          }
    });

    $("#clave18").blur(function(){
          if($("#clave18").val()!=""){
            $("#clave19").prop("readonly", false);
            $("#cantidad19").prop("readonly", false);
            $("#devolucion19").prop("disabled", false);
            $("#devolucion18").prop("required", true);
          }
          else{
            $("#clave19").prop("readonly", true);
            $("#cantidad19").prop("readonly", true);
            $("#devolucion19").prop("disabled", true);
            $("#devolucion18").prop("required", false);
          }
    });

    $("#clave19").blur(function(){
          if($("#clave19").val()!=""){
            $("#clave20").prop("readonly", false);
            $("#cantidad20").prop("readonly", false);
            $("#devolucion20").prop("disabled", false);
            $("#devolucion19").prop("required", true);
          }
          else{
            $("#clave20").prop("readonly", true);
            $("#cantidad20").prop("readonly", true);
            $("#devolucion20").prop("disabled", true);
            $("#devolucion19").prop("required", false);
          }
    });

    $("#clave20").blur(function(){
          if($("#clave20").val()!=""){
            $("#clave21").prop("readonly", false);
            $("#cantidad21").prop("readonly", false);
            $("#devolucion21").prop("disabled", false);
            $("#devolucion20").prop("required", true);
          }
          else{
            $("#clave21").prop("readonly", true);
            $("#cantidad21").prop("readonly", true);
            $("#devolucion21").prop("disabled", true);
            $("#devolucion20").prop("required", false);
          }
    });

    $("#clave21").blur(function(){
          if($("#clave21").val()!=""){
            $("#clave22").prop("readonly", false);
            $("#cantidad22").prop("readonly", false);
            $("#devolucion22").prop("disabled", false);
            $("#devolucion21").prop("required", true);
          }
          else{
            $("#clave22").prop("readonly", true);
            $("#cantidad22").prop("readonly", true);
            $("#devolucion22").prop("disabled", true);
            $("#devolucion21").prop("required", false);
          }
    });

    $("#clave22").blur(function(){
          if($("#clave22").val()!=""){
            $("#clave23").prop("readonly", false);
            $("#cantidad23").prop("readonly", false);
            $("#devolucion23").prop("disabled", false);
            $("#devolucion22").prop("required", true);
          }
          else{
            $("#clave23").prop("readonly", true);
            $("#cantidad23").prop("readonly", true);
            $("#devolucion23").prop("disabled", true);
            $("#devolucion22").prop("required", false);
          }
    });

    $("#clave23").blur(function(){
          if($("#clave23").val()!=""){
            $("#clave24").prop("readonly", false);
            $("#cantidad24").prop("readonly", false);
            $("#devolucion24").prop("disabled", false);
            $("#devolucion23").prop("required", true);
          }
          else{
            $("#clave24").prop("readonly", true);
            $("#cantidad24").prop("readonly", true);
            $("#devolucion24").prop("disabled", true);
            $("#devolucion23").prop("required", false);
          }
    });

    // $("#clave24").blur(function(){
    //       if($("#clave24").val()!=""){
    //         $("#clave25").prop("readonly", false);
    //         $("#cantidad25").prop("readonly", false);
    //         $("#devolucion25").prop("disabled", false);
    //         $("#devolucion24").prop("required", true);
    //       }
    //       else{
    //         $("#clave25").prop("readonly", true);
    //         $("#cantidad25").prop("readonly", true);
    //         $("#devolucion25").prop("disabled", true);
    //         $("#devolucion24").prop("required", false);
    //       }
    // });

    $("#clave24").blur(function(){
          if($("#clave24").val()!=""){
            $("#devolucion24").prop("required", true);
          }
          else{
            $("#devolucion24").prop("required", false);
          }
    });


});
