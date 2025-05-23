document
  .getElementById("buscarProducto")
  .addEventListener("keyup", function () {
    let filtro = this.value.toLowerCase();
    let filas = document.querySelectorAll("#tablaProducto tr");

    filas.forEach((fila) => {
      let nombreProducto = fila
        .querySelector(".nombre-producto")
        .textContent.toLowerCase();
      if (nombreProducto.includes(filtro)) {
        fila.style.display = "";
      } else {
        fila.style.display = "none";
      }
    });
  });
