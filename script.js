document.getElementById("icon-menu").addEventListener("click", mostrar_menu);

function mostrar_menu() {
    document.getElementById("move-content").classList.toggle('move-container-all');
    document.getElementById("show-menu").classList.toggle('show-lateral');
}

$(document).ready(function () {
    // Inicializar el carrusel
    $(".post-wrapper").slick({
        centerMode: true,        // Activa el modo centrado
        centerPadding: '0px',    // Sin relleno en los lados
        slidesToShow: 3,         // Muestra 3 slides a la vez
        slidesToScroll: 1,       // Desplaza 1 slide a la vez
        autoplay: true,          // Activar autoplay
        autoplaySpeed: 2000,     // Velocidad de autoplay
        nextArrow: $(".next"),   // Configuración de los botones de navegación
        prevArrow: $(".prev"),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    centerMode: true,
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    centerMode: true,
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerMode: true,
                    slidesToShow: 1,
                }
            }
        ]
    });

    // Manejo del menú
    $(".menu-toggle").on("click", function () {
        $(".nav").toggleClass("showing");
        $(".nav ul").toggleClass("showing");
    });

    // Cargar publicaciones
    cargarPublicaciones();
});

// Función para cargar publicaciones desde localStorage
function cargarPublicaciones() {
    let postsContainer = document.querySelector(".post-wrapper");
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];        

    if (posts.length === 0 && trash.length === 0) {
        postsContainer.innerHTML = "<p>No hay posts disponibles.</p>";
    } else {
        posts.forEach((post, index) => {
            let postElement = document.createElement("div");
            postElement.classList.add("post");
            postElement.innerHTML = `
                <div class="post-content">
                    <p>${post.contenido}</p>
                    <button class="btn-delete" data-index="${index}">Eliminar</button>
                    <button class="btn-restore" data-index="${index}">Restaurar</button>
                </div>
            `;
            postsContainer.appendChild(postElement);
        });
        agregarEventosBotones();
    }
}

// Agregar eventos a los botones de eliminar y restaurar
function agregarEventosBotones() {
    const deleteButtons = document.querySelectorAll(".btn-delete");
    deleteButtons.forEach(button => {
        button.addEventListener("click", function() {
            const index = this.getAttribute("data-index");
            eliminarPost(index);
        });
    });

    const restoreButtons = document.querySelectorAll(".btn-restore");
    restoreButtons.forEach(button => {
        button.addEventListener("click", function() {
            const index = this.getAttribute("data-index");
            restaurarPost(index);
        });
    });
}

// Función para eliminar el post
function eliminarPost(index) {
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];
    trash.push(posts.splice(index, 1)[0]);
    localStorage.setItem("posts", JSON.stringify(posts));
    localStorage.setItem("trash", JSON.stringify(trash));
    location.reload(); // Recargar para reflejar cambios
}

// Función para restaurar el post
function restaurarPost(index) {
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];
    posts.push(trash.splice(index, 1)[0]);
    localStorage.setItem("posts", JSON.stringify(posts));
    localStorage.setItem("trash", JSON.stringify(trash));
    location.reload(); // Recargar para reflejar cambios
}
