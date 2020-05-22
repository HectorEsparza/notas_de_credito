$(document).ready(function(){
    $(".verImpresion").click(function(){
        var id = $(this).attr('id');
        id = id.split("-");
        var pagina = id[0];
        var folio = id[1];
        //Desarrollo
        var url = window.location.host+"/hesparza/aplicacion/"+pagina+"/impresion.php?folio="+folio;
        //Produccion
        //var url = "apawebdesarrollo.com/"+pagina+"/impresion.php?folio="+folio;
        window.open('http://'+url+'', '_blank');
    });
});