document.getElementById("icon-menu").addEventListener("click", mostrar_menu);

function mostrar_menu(){

    document.getElementById("move-content").classList.toggle('move-container-all');
    document.getElementById("show-menu").classList.toggle('show-lateral');
}   

$(document).ready(function () {
    $(".menu-toggle").on("click", function () {
        $(".nav").toggleClass("showing");
        $(".nav ul").toggleClass("showing");
    });

    $(".post-wrapper").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: $(".next"),
        prevArrow: $(".prev"),
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
});
document.addEventListener("DOMContentLoaded", function () {
    let postsContainer = document.querySelector(".post-wrapper");
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || []; // Papelera temporal

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

        // Agregar funcionalidad de eliminación
        const deleteButtons = document.querySelectorAll(".btn-delete");
        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                const index = this.getAttribute("data-index");
                eliminarPost(index);
            });
        });

        // Agregar funcionalidad de restauración
        const restoreButtons = document.querySelectorAll(".btn-restore");
        restoreButtons.forEach(button => {
            button.addEventListener("click", function() {
                const index = this.getAttribute("data-index");
                restaurarPost(index);
            });
        });
    }
});

// Función para eliminar el post
function eliminarPost(index) {
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];

    // Mover el post a la papelera
    trash.push(posts.splice(index, 1)[0]);
    
    // Actualizar el almacenamiento
    localStorage.setItem("posts", JSON.stringify(posts));
    localStorage.setItem("trash", JSON.stringify(trash));

    // Volver a cargar los posts
    location.reload();
}

// Función para restaurar el post desde la papelera
function restaurarPost(index) {
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];

    // Mover el post de la papelera a los posts
    posts.push(trash.splice(index, 1)[0]);

    // Actualizar el almacenamiento
    localStorage.setItem("posts", JSON.stringify(posts));
    localStorage.setItem("trash", JSON.stringify(trash));

    // Volver a cargar los posts
    location.reload();
}









