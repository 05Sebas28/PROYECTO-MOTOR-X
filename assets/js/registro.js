window.addEventListener("DOMContentLoaded", function () {
    const formulario_register = document.querySelector("form");
    const alerta = document.getElementById("alerta");

    formulario_register.addEventListener("submit", function (event) {
        event.preventDefault(); // Detener el envío para mostrar la alerta
        alerta.style.display = "block"; // Mostrar la alerta

        setTimeout(() => {
            alerta.style.display = "none"; // Ocultar alerta después de 3 segundos
            formulario_register.submit(); // Enviar el formulario después de ocultar la alerta
        }, 3000);
    });
});
