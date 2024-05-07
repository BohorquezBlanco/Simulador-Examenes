//Elimina  los dragovers vinculados para poder reutilizarlos en otras funciones 
function desvincularDragover()
{
   // Desvincular los eventos 'dragover' y 'drop' del elemento '#modificar'
    $('#modificar').off('dragover');
   $('#modificar').off('drop');

   $('#eliminar').off('dragover');
   $('#eliminar').off('drop');
}