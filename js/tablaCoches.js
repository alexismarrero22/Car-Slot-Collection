//función para cargar los coches en una tabla en la página de colecciones.php
function verColeccion(userId) {
    fetch("http://localhost/proyecto/controllers/carController.php?action=showCollection&id_user=" + userId)
        .then(response => response.text())
        .then(html => {
            document.getElementById("contenidoCoches").innerHTML = html;
            document.getElementById("modalCoches").style.display = "flex";
        });
}
function cerrarModal() {
    document.getElementById("modalCoches").style.display = "none";
}