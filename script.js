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
// Se ejecuta cuando el contenido del DOM está completamente cargado
document.addEventListener("DOMContentLoaded", function () {
    // Seleccionamos el contenedor donde se mostrarán los posts
    let postsContainer = document.querySelector(".post-wrapper");

    // Recuperamos los posts del localStorage, si no existen, se usa un array vacío
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    
    // Recuperamos los posts eliminados de la "papelera", si no existen, se usa un array vacío
    let trash = JSON.parse(localStorage.getItem("trash")) || []; 

    // Si no hay posts ni en la papelera
    if (posts.length === 0 && trash.length === 0) {
        postsContainer.innerHTML = "<p>No hay posts disponibles.</p>";
    } else {
        // Si hay posts, los mostramos
        posts.forEach((post, index) => {
            let postElement = document.createElement("div");
            postElement.classList.add("post");

            // Creamos el contenido del post con los botones de eliminar y restaurar
            postElement.innerHTML = `
                <div class="post-content">
                    <p>${post.contenido}</p>
                    <button class="btn-delete" data-index="${index}">Eliminar</button>
                    <button class="btn-restore" data-index="${index}">Restaurar</button>
                </div>
            `;

            // Agregamos el post al contenedor de posts
            postsContainer.appendChild(postElement);
        });

        // Agregar funcionalidad al botón de eliminar
        const deleteButtons = document.querySelectorAll(".btn-delete");
        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Obtenemos el índice del post a eliminar
                const index = this.getAttribute("data-index");
                eliminarPost(index); // Llamamos a la función de eliminar
            });
        });

        // Agregar funcionalidad al botón de restaurar
        const restoreButtons = document.querySelectorAll(".btn-restore");
        restoreButtons.forEach(button => {
            button.addEventListener("click", function() {
                // Obtenemos el índice del post a restaurar
                const index = this.getAttribute("data-index");
                restaurarPost(index); // Llamamos a la función de restaurar
            });
        });
    }
});

// Función para eliminar el post (moverlo a la papelera)
function eliminarPost(index) {
    // Recuperamos los posts y la papelera
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];

    // Movemos el post de la lista de posts a la papelera
    trash.push(posts.splice(index, 1)[0]);

    // Actualizamos el almacenamiento
    localStorage.setItem("posts", JSON.stringify(posts));
    localStorage.setItem("trash", JSON.stringify(trash));

    // Recargamos la página para reflejar los cambios
    location.reload();
}

// Función para restaurar el post (moverlo de la papelera a los posts)
function restaurarPost(index) {
    // Recuperamos los posts y la papelera
    let posts = JSON.parse(localStorage.getItem("posts")) || [];
    let trash = JSON.parse(localStorage.getItem("trash")) || [];

    // Movemos el post de la papelera a los posts
    posts.push(trash.splice(index, 1)[0]);

    // Actualizamos el almacenamiento
    localStorage.setItem("posts", JSON.stringify(posts));
    localStorage.setItem("trash", JSON.stringify(trash));

    // Recargamos la página para reflejar los cambios
    location.reload();
}
