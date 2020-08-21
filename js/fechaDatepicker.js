$(document).ready(function () {

    var abrevia_dias = ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"];
    $('.fecha').datepicker({
        //dateFormat:'yy-mm-dd'
        //dateFormat: 'dd-mm-yy'
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        dateFormat: 'dd/mm/yy',
        changeMonth: false,
        changeYear: false,
        dayNamesMin: abrevia_dias,
        selectOtherMonths: true,
    });
});