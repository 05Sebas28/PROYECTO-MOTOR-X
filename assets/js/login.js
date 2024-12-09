window.addEventListener("DOMContentLoaded", function () {
    // Selecciona el formulario de login y la caja trasera de login
    const formulario_login = document.querySelector(".formulario__login");
    const caja_trasera_login = document.querySelector(".caja__trasera-login");

    // Ajustar el diseño según el ancho de la página
    function ajustarVista() {
        if (window.innerWidth > 850) {
            caja_trasera_login.style.display = "block";
        } else {
            caja_trasera_login.style.display = "none";
            formulario_login.style.display = "block";
        }
    }

    window.addEventListener("resize", ajustarVista);
    ajustarVista();

    // Validación adicional en el frontend si se quiere
    const formulario = document.querySelector("form");
    formulario.addEventListener("submit", function (e) {
        const correo = document.querySelector("input[name='correo']").value;
        const contraseña = document.querySelector("input[name='contraseña']").value;

        if (!correo || !contraseña) {
            e.preventDefault(); // Prevenir el envío del formulario
            document.getElementById('alertaError').style.display = 'block';
            document.getElementById('alertaError').innerText = "Por favor complete ambos campos.";
        }
    });
});
