document.getElementById("buscarUsuario").addEventListener("keyup", function () {
  let filtro = this.value.toLowerCase();
  let filas = document.querySelectorAll("#tablaUsuarios tr");

  filas.forEach((fila) => {
    let nombreUsuario = fila
      .querySelector(".nombre-usuario")
      .textContent.toLowerCase();
    if (nombreUsuario.includes(filtro)) {
      fila.style.display = "";
    } else {
      fila.style.display = "none";
    }
  });
});
