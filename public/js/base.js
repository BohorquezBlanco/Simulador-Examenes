
//#################################-MODAL DESDE 0-###############################
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.abrirModal').forEach(function(el) {
        el.addEventListener('click', function() {
            var modalId = this.dataset.target;
            document.getElementById(modalId).style.display = 'block';
        });
    });

    document.querySelectorAll('.cerrar').forEach(function(el) {
        el.addEventListener('click', function() {
            this.closest('.modal').style.display = 'none';
        });
    });
});
