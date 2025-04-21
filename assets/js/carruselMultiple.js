let diapositivaActual = 0;

// Movimiento automático cada 3 segundos
let intervaloAutomatico = setInterval(() => moverDiapositiva(1), 3000);

function moverDiapositiva(direccion) {
    const carrusel = document.getElementById('carousel');
    const totalDiapositivas = carrusel.children.length;
    const esMovil = window.innerWidth < 769; // Verifica si es móvil
    const imagenesVisibles = esMovil ? 1 : 3; // 1 imagen en móvil, 3 en escritorio

    // Mover según la dirección y la cantidad de imágenes visibles
    diapositivaActual = diapositivaActual + (direccion * imagenesVisibles);

    // Evitar que el carrusel desborde los límites
    if (diapositivaActual < 0) {
        diapositivaActual = totalDiapositivas - imagenesVisibles; // Ir al final del carrusel
    } else if (diapositivaActual > totalDiapositivas - imagenesVisibles) {
        diapositivaActual = 0; // Regresar al inicio del carrusel
    }

    // Calcular el porcentaje de desplazamiento
    const porcentajeDesplazamiento = (diapositivaActual / imagenesVisibles) * 100;
    carrusel.style.transform = `translateX(-${porcentajeDesplazamiento}%)`;

    // Reiniciar el intervalo automático después de un movimiento manual
    clearInterval(intervaloAutomatico);
    intervaloAutomatico = setInterval(() => moverDiapositiva(1), 3000);
}
