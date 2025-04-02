document.addEventListener("DOMContentLoaded", function () {
    const carruselContainer = document.getElementById("carrusel");
    const prevButton = document.getElementById("prev"); // Botón "Anterior"
    const nextButton = document.getElementById("next"); // Botón "Siguiente"
    const rutaActual = window.location.pathname; // Ruta actual de la página
    let endpoint = "";

    if (rutaActual.includes("index.php")) {
        // Si la ruta actual es index.php, se obtienen todas las imágenes
        endpoint = "http://localhost/proyecto/controllers/carController.php?action=showImages";
    } else if (rutaActual.includes("miColeccion.php")) {
        // Si la ruta actual es miColeccion.php, se obtienen las imágenes del usuario
        endpoint = "http://localhost/proyecto/controllers/carController.php?action=showMyOwnImages";
    }
    // Realiza la petición para obtener las imágenes en formato HTML
    fetch(endpoint)
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

function mostrarDecoracion(id_car) {
    console.log(id_car);
    const contenedor = document.getElementById("decoracion-" + id_car);
    const imagen = document.getElementById("imagen-" + id_car);
    if (contenedor.style.display === "none") {
        if (!contenedor.dataset.cargado) {
            fetch("controllers/carController.php?action=showImagesById&id_car=" + id_car)
                .then(response => response.text())
                .then(html => {
                    console.log("html recibido:", html); //para saber si el contenido llegó
                    contenedor.innerHTML = html;
                    contenedor.style.display = "block";
                    contenedor.dataset.cargado = "true";
                })
                .catch(error => {
                    console.error("Error al cargar la decoración:", error);
                    contenedor.innerHTML = "<p>No se pudo cargar la imagen.</p>";
                    contenedor.style.display = "block";
                });
        } else {
            contenedor.style.display = "block";
        }
    } else {
        contenedor.style.display = "none";
    }
}


