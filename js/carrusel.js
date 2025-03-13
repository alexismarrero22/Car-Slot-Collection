document.addEventListener('DOMContentLoaded', function () {
    const carrusel = document.querySelector(".carrusel");
    let currentIndex = 0;

    //obtener imagenes de la base de datos
    fetch("http://localhost/proyecto/controllers/getImages.php")
        .then(response => response.json())
        .then(images => {
            if (images.length === 0) {
                carrusel.innerHTML = "<p>No hay imagenes disponibles</p>";
                return;
            }

            //agregar imagenes al carrusel
            images.forEach(imgSrc => {
                const img = document.createElement("img");
                img.src = imgSrc;
                carrusel.appendChild(img);
            });

            updateCarrusel(); // iniciar el carrusel
        })
        .catch(error => console.error("Error al cargar las imagenes: ", error));

    //funcion para actualizar el carrusel
    function updateCarrusel() {
        const totalImages = document.querySelectorAll(".carrusel img").length;
        if (totalImages > 0) {
            carrusel.computedStyleMap.transform = `translateX(-${currentIndex * 100}%)`;
        }
    }

    //boton siguiente
    document.querySelector(".next").addEventListener("click", function () {
        const totalImages = document.querySelectorAll(".carrusel img").length;
        if (currentIndex < totalImages - 1) {
            currentIndex++;
            console.log("se mueve");
        } else {
            currentIndex = 0; //volver a empezar
        }
        updateCarrusel();

    });

    //boton anterior
    document.querySelector(".prev").addEventListener("click", function () {
        const totalImages = document.querySelectorAll(".carrusel img").length;
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = totalImages - 1; //Ir al final
        }
        updateCarrusel();

    });

});