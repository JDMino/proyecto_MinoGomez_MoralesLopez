document
  .getElementById("buscarProductoCatalogo")
  .addEventListener("keyup", function () {
    let filtro = this.value.toLowerCase();
    let productos = document.querySelectorAll(".catalogo-section");

    productos.forEach((producto) => {
      let nombreProducto = producto
        .querySelector(".card-title")
        .textContent.toLowerCase();

      if (nombreProducto.includes(filtro)) {
        producto.parentElement.style.display = "";
      } else {
        producto.parentElement.style.display = "none";
      }
    });
  });
