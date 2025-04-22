let diapositivaActual = 0;

// Movimiento automático cada 3 segundos
let intervaloAutomatico = setInterval(() => moverDiapositiva(1), 3000);

window.addEventListener('resize', reiniciarCarrusel);

function moverDiapositiva(direccion) {
    const carrusel = document.getElementById('carousel');
    if (!carrusel) return; // Evitar errores si el elemento no está presente

    const totalDiapositivas = carrusel.children.length;
    const esMovil = window.innerWidth < 769;
    const imagenesVisibles = esMovil ? 1 : 3;

    // Mover según la dirección y la cantidad de imágenes visibles
    diapositivaActual = diapositivaActual + (direccion * imagenesVisibles);

    // Evitar que el carrusel desborde los límites
    if (diapositivaActual < 0) {
        diapositivaActual = totalDiapositivas - imagenesVisibles;
    } else if (diapositivaActual > totalDiapositivas - imagenesVisibles) {
        diapositivaActual = 0;
    }

    // Calcular el porcentaje de desplazamiento
    const porcentajeDesplazamiento = (diapositivaActual / imagenesVisibles) * 100;
    carrusel.style.transform = `translateX(-${porcentajeDesplazamiento}%)`;

    // Reiniciar el intervalo automático después de un movimiento manual
    clearInterval(intervaloAutomatico);
    intervaloAutomatico = setInterval(() => moverDiapositiva(1), 3000);
}

function reiniciarCarrusel() {
    diapositivaActual = 0; // Reiniciar la posición del carrusel
    moverDiapositiva(0); // Forzar actualización
}
