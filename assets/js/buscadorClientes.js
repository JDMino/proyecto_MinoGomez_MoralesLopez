document.getElementById("buscarCliente").addEventListener("keyup", function () {
  let filtro = this.value.toLowerCase();
  let filas = document.querySelectorAll("#tablaClientes tr");

  filas.forEach((fila) => {
    let nombreCliente = fila
      .querySelector(".nombre-cliente")
      .textContent.toLowerCase();
    if (nombreCliente.includes(filtro)) {
      fila.style.display = "";
    } else {
      fila.style.display = "none";
    }
  });
});
