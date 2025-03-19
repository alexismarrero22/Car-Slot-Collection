document.addEventListener("DOMContentLoaded", function () {
    const carruselContainer = document.getElementById("carrusel");
    const prevButton = document.getElementById("prev"); // Botón "Anterior"
    const nextButton = document.getElementById("next"); // Botón "Siguiente"

    // Realiza la petición para obtener las imágenes en formato HTML
    fetch("http://localhost/proyecto/controllers/carController.php?action=showImages")
        .then(response => response.text()) // La respuesta es HTML
        .then(html => {
            carruselContainer.innerHTML = html; // Inserta las imágenes en el carrusel
            iniciarCarrusel(); // Llama a la función que activa el carrusel
        })
        .catch(error => console.error("Error al cargar las imágenes del carrusel:", error));

    function iniciarCarrusel() {
        let imagenes = carruselContainer.querySelectorAll("img");
        let indiceActual = 0;

        function mostrarImagen(indice) {
            imagenes.forEach(img => img.style.display = "none"); // Oculta todas
            imagenes[indice].style.display = "block"; // Muestra la actual
        }

        function siguienteImagen() {
            indiceActual = (indiceActual + 1) % imagenes.length;
            mostrarImagen(indiceActual);
        }

        function anteriorImagen() {
            indiceActual = (indiceActual - 1 + imagenes.length) % imagenes.length;
            mostrarImagen(indiceActual);
        }

        // Mostrar la primera imagen
        if (imagenes.length > 0) {
            mostrarImagen(indiceActual);

            // Eventos para los botones
            nextButton.addEventListener("click", siguienteImagen);
            prevButton.addEventListener("click", anteriorImagen);
        }
    }
});

