document.addEventListener("DOMContentLoaded", function() {
    let tiempoRestante = 30 * 60;
    const temporizadorElemento = document.getElementById('temporizador');

    function actualizarTemporizador() {
        const minutos = Math.floor(tiempoRestante / 60);
                const segundos = tiempoRestante % 60;
                const formato = `${minutos}:${segundos < 10 ? '0' : ''}${segundos}`;
                temporizadorElemento.innerText = formato;

                if (tiempoRestante === 0) {
                    // Aquí puedes agregar lógica adicional cuando el tiempo se agota
                    alert('¡Tiempo agotado!');
                } else {
                    tiempoRestante--;
            }
    }

    actualizarTemporizador(); // Actualizar el temporizador inmediatamente
    setInterval(actualizarTemporizador, 1000);
});