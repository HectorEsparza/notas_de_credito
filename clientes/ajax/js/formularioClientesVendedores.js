$(document).ready(function(){
    $("#registrosYactualizaciones").click(function(){
        //alert("Mostrando clientes");
        $("#formularioParaCargas").empty();
        $("#scriptParaCargas").empty();
        var contenido = '<h3>Cargar Archivo Para Clientes</h3>'+
                        '<br />'+
                        '<form enctype="multipart/form-data" id="formularioDeCarga" method="post">'+
                        '<table class="table table-primary table-bordered">'+
                            '<thead>'+
                                '<tr>'+
                                    '<th colspan=2 align="center">Ingresa los datos por favor</th>'+
                                '</tr>'+
                            '</thead>'+ 
                            '<tbody>'+
                                '<tr>'+
                                    '<td>Opción</td>'+
                                    '<td>'+
                                        '<select id="opcionDeCarga" name="opcionDeCarga">'+
                                            '<option value="">Selecciona una opción...</option>'+
                                            '<option value="Nuevos Clientes">Nuevos Clientes</option>'+
                                            '<option value="Actualizar Clientes">Actualizar Clientes</option>'+
                                            '<option value="Nuevos Vendedores">Nuevos Vendedores</option>'+
                                            '<option value="Actualizar Vendedores">Actualizar Vendedores</option>'+
                                        '</select>'+
                                    '</td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td>Archivo</td>'+
                                    '<td><input type="file" id="archivoDeCarga" name="archivoDeCarga" /></td>'+
                                '</tr>'+
                                '<tr>'+
                                    '<td colspan=2 align="center"><input type="button" class="btn btn-primary" id="botonDeCarga" value="Cargar" /></td>'+
                                '</tr>'+                
                            '</tbody>'+
                        '</table>'+
                        '</form>';
        $("#formularioParaCargas").append(contenido);
        $("#scriptParaCargas").append('<script type="text/javascript" src="ajax/eventos/cargarArchivo.js"></script>');
    });
});