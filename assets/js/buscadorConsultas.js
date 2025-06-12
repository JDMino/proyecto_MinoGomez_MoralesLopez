document.addEventListener("DOMContentLoaded", function () {
    let inputBuscar = document.getElementById("buscarConsulta");
    let tablaConsultas = document.getElementById("tablaConsultas").getElementsByTagName("tr");

    if (!inputBuscar || tablaConsultas.length === 0) {
        console.warn("No se encontró el buscador o la tabla está vacía.");
        return;
    }

    inputBuscar.addEventListener("keyup", function () {
        let filtro = inputBuscar.value.toLowerCase().trim(); // Elimina espacios extra

        for (let fila of tablaConsultas) {
            let columnas = fila.cells; // Obtiene todas las celdas de la fila

            // Verifica que existan columnas antes de acceder a ellas
            if (!columnas || columnas.length === 0) continue;

            let id = columnas[0]?.textContent.toLowerCase() || "";
            let nombre = columnas[1]?.textContent.toLowerCase() || "";
            let apellido = columnas[2]?.textContent.toLowerCase() || "";
            let email = columnas[3]?.textContent.toLowerCase() || "";
            let telefono = columnas[4]?.textContent.toLowerCase() || "";
            let mensaje = columnas[5]?.textContent.toLowerCase() || "";

            // Filtra correctamente en ambas vistas
            if (id.includes(filtro) || nombre.includes(filtro) || apellido.includes(filtro) || email.includes(filtro) || telefono.includes(filtro) || mensaje.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        }
    });
});