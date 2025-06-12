document.addEventListener("DOMContentLoaded", function () {
    let inputBuscar = document.getElementById("buscarProducto");
    let filas = document.querySelectorAll("#tablaProductos tr");

    if (!inputBuscar || filas.length === 0) {
        console.warn("No se encontró el buscador o la tabla está vacía.");
        return;
    }

    inputBuscar.addEventListener("keyup", function () {
        let filtro = this.value.toLowerCase().trim(); // Normalización del texto ingresado

        filas.forEach((fila) => {
            let columnas = fila.cells; // Obtiene todas las celdas de la fila

            if (!columnas || columnas.length === 0) return;

            let id = columnas[0]?.textContent.toLowerCase() || "";
            let nombre = columnas[1]?.textContent.toLowerCase() || "";
            let marca = columnas[2]?.textContent.toLowerCase() || "";
            let precio = columnas[4]?.textContent.toLowerCase() || "";
            let precioVenta = columnas[5]?.textContent.toLowerCase() || "";
            let stock = columnas[6]?.textContent.toLowerCase() || "";

            // Filtra por cualquier campo
            if (id.includes(filtro) || nombre.includes(filtro) || marca.includes(filtro) || precio.includes(filtro) || precioVenta.includes(filtro) || stock.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });
});