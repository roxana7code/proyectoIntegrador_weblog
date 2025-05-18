<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diseño web tipo blog - para practica</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="estilosPost.css">
    <link rel="stylesheet" type="text/css" href="path_to_slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="path_to_slick/slick-theme.css"/>
    <script type="text/javascript" src="path_to_slick/slick.min.js"></script>

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, 
    minimum-scale=1.0">
</head>
<body>
    <header>
        <div class="contenido-heder">
            <div class="menu-tips">
                <div class="logo-ods"> 
                    <img src="imagenWeb/img9.png" alt="">
                </div>
                <h1><a href="/indexUsuario.php">Salud y <b>bienestar</b></a></h1>
                <div class="menu-contenido">
                    <nav style="display: flex; align-items: center;">
                        <ul style="display: flex; margin: 0; padding: 0;">
                            <li><a href="/indexUsuario.php"><i class="fas fa-home"></i> Inicio</a></li>
                            <li><a href="https://www.youtube.com/channel/UCP6DHuQs90149gArPEcevJg"><i class="fab fa-youtube"></i> Tutoriales</a></li>
                            <li><a href="/nosotros.php"><i class="fas fa-users"></i> Nosotros</a></li>
                            <li><a href="/crud/cerrar_sesion.php"><i class="fas fa-sign-in-alt"></i> Cerrar sesión</a></li>
                        </ul>

                    <!-- Formulario de búsqueda -->
                    <form id="searchForm" class="search-form" action="buscar.php" method="GET" style="margin-left: 20px; display: flex;">
                            <input type="text" name="q" placeholder="Buscar..." required style="padding: 5px;">
                            <button type="submit" style="padding: 5px;"><i class="fas fa-search"></i></button>
                        </form>
                        <!-- Saludo al usuario -->
                        <div class="perfil-usuario" style="margin-left: 20px; color: white;">
                        <?php
if (isset($_SESSION['usuario'])) {
    echo '<span style="color:rgb(0, 0, 0);"><i class="fas fa-user-circle"></i> Bienvenido, ' . htmlspecialchars($_SESSION['usuario']) . '</span>';
}
?>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="container-all" id="move-content">
        <div class="container-cover">
            <div id="icon-menu">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

    <div class="post-slider">
    <h1 class="slider-title">Publicaciones Recientes</h1>
    <i class="fas fa-chevron-left prev"></i>
    <i class="fas fa-chevron-right next"></i>

<div class="post-wrapper">
    
    <?php
    // Consulta para obtener las publicaciones
    include 'conexion.php'; // Asegúrate de que este archivo contenga la función connection()
    $con = connection(); // Llama a la función de conexión

    // Consulta SQL para obtener las últimas 5 publicaciones
    $sql = "SELECT * FROM publicaciones ORDER BY fecha DESC LIMIT 5"; 
    $query = mysqli_query($con, $sql);

    // Verificar si la consulta fue exitosa
    if (!$query) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    // Procesar los resultados
    if (mysqli_num_rows($query) > 0) {
        while ($fila = mysqli_fetch_assoc($query)) {
            echo '<div class="post">';
            echo '<img src="../imagenWeb/' . htmlspecialchars($fila['imagen']) . '" alt="" class="slider-image">';
            echo '<div class="post-info">';
            echo '<h4><a href="detalle_publicacion.php?id=' . $fila['publicacion'] . '">' . htmlspecialchars($fila['titulo']) . '</a></h4>';
            echo '<i class="far fa-user"> ' . htmlspecialchars($fila['autor']) . '</i> &nbsp;';
            echo '<i class="far fa-calendar"> ' . htmlspecialchars($fila['fecha']) . '</i>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No hay publicaciones disponibles.";
    }

    // Cierra la conexión al final
    mysqli_close($con);
    ?>
</div>





    </div>
</div>


        <div class="container-conten">
            <div class="Big-post">
                <h1>Pasos para una alimentación saludable</h1>
            </div>
            <article>
                <div class="contenido">
                    <nav>
                        <ul>
                            <li><a href="#"><i class="fas fa-calendar-alt"></i></a> Planificas tus comidas</li>
                            <p>Organiza tus comidas saludables para</p>
                            <p>asegurar una dieta balanceada</p>
                            <li><a href="#"><i class="fas fa-apple-alt"></i></a> Incluye mas frutas y verduras</li>
                            <p>Aumenta el consumo de alimentos frescos y</p>
                            <p>naturales en tu dieta diaria</p>
                            <li><a href="#"><i class="fas fa-tint"></i></a> Hidratate adecuadamente</li>
                            <p>Mantén tu cuerpo hidratado bebiendo</p>
                            <p>suficiente agua a lo largo del día</p>
                        </ul>
                    </nav>

                    <button onclick="window.location.href='post-tips.php';">
                        <a href="post-tips.php" style="color: whitesmoke; text-decoration: none;">Leer más</a>
                    </button>
                </div>

                <img src="imagenWeb/img16.jpg" alt="">
            </article>
        </div>

        <div class="post-wrapper">
            <!-- Aquí se insertarán los posts desde JavaScript -->
        </div>

        <section id="ultimos-articulos">
            <div class="articulo">
                <div class="articulo-item">
                    <img src="post_Img/post6.jpg" alt="Salud y bienestar">
                    <h3>Galletas de avena y platano </h3>
                    <p>Estas son unas galletas de avena muy saludables y fáciles, ideales…  </p>
                    <span>24/05/2025</span>
                    <a href="post-Bloguero/post6.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="post_Img/post1.jpg" alt="Salud y bienestar">
                    <h3>¿Cómo debe de ser la dieta para deportistas de alto rendimiento? </h3>
                    <p>La dieta para deportistas de alto rendimiento juega un papel crucial para… </p>
                    <span>24/05/2025</span>
                    <a href="post-Bloguero/post1.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="post_Img/post2.jpg" alt="Salud y bienestar">
                    <h3>Dieta antiinflamatoria: alimentos recomendados y cuáles evitar </h3>
                    <p>Elegir una dieta antiinflamatoria es clave para prevenir y combatir la inflamación que… </p>
                    <span>24/05/2025</span>
                    <a href="post-Bloguero/post2.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="post_Img/post3.jpg" alt="Salud y bienestar">
                    <h3>Galletas de calabaza para el desayuno  </h3>
                    <p>Estas galletas de calabaza se han vuelto una de mis recetas favoritas. Te prometo que te van a encantar… </p>
                    <span>24/05/2025</span>
                    <a href="post-Bloguero/post3.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="post_Img/post4.jpg" alt="Salud y bienestar">
                    <h3>Smoothie de Frutas y Avena </h3>
                    <p>Este smoothie es una excelente manera de comenzar el… </p>
                    <span>24/05/2025</span>
                    <a href="post-Bloguero/post4.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="post_Img/post5.png" alt="Salud y bienestar">
                    <h3>Ensalada con naranja, queso y pistachos </h3>
                    <p>Esta ensalada con naranja, queso de cabra y pistachos, aportan… </p>
                    <span>24/05/2025</span>
                    <a href="post-Bloguero/post5.php">Leer más</a>
                </div>
                <!-- Repite el bloque div para más artículos -->
            </div>
        </section>

        <div class="container-footer">
            <footer>
                <div class="logo-footer">
                    <img src="imagenWeb/img9.png" alt="">
                </div>

                <div class="redes-footer">
                    <a href="https://www.facebook.com/share/193M2XwD2p/?mibextid=wwXIfr" target="_blank"><i class="fa-brands fa-facebook icon-redes-footer"></i></a>
                    <a href="https://www.instagram.com/salud_optimaa?igsh=MXJuNXlsZGdjNGpvaQ%3D%3D&utm_source=qr" target="_blank"><i class="fa-brands fa-instagram icon-redes-footer"></i></a>
                    <a href="https://x.com/VALERIACUE96463"><i class="fab fa-twitter icon-redes-footer"></i></a>
                </div>

                <hr>
                <h4>@ 2025 salud y bienestar - Todos los derechos reservados</h4>
            </footer>
        </div> 

    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Slick Carousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="js/script.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const iconMenu = document.getElementById("icon-menu");
        const navMenu = document.querySelector(".menu-contenido nav");

        iconMenu.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
    });
    document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("postModal");
    const modalContent = document.getElementById("modal-content");
    const closeBtn = document.getElementById("modalClose");

    // Escucha clics en los enlaces de las publicaciones
    document.querySelectorAll(".ver-publicacion").forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Evita el comportamiento por defecto del enlace
            const postId = this.dataset.id;

            // Hacer una solicitud AJAX para obtener el contenido de la publicación
            fetch(`get_publicacion.php?id=${postId}`)
                .then(response => response.json())
                .then(data => {
                    modalContent.innerHTML = `
                        <h2>${data.titulo}</h2>
                        <img src="../imagenWeb/${data.imagen}" alt="Imagen de la publicación">
                        <p><strong>Autor:</strong> ${data.autor}</p>
                        <p><strong>Contenido:</strong> ${data.contenido}</p>
                        <p><strong>Resumen:</strong> ${data.resumen}</p>
                        <p><strong>Fecha:</strong> ${data.fecha}</p>
                    `;
                    modal.style.display = "block"; // Muestra el modal
                })
                .catch(error => console.error('Error:', error));
        });
    });

    closeBtn.addEventListener("click", function () {
        modal.style.display = "none"; // Oculta el modal
    });

    window.addEventListener("click", function (event) {
        if (event.target == modal) {
            modal.style.display = "none"; // Oculta el modal si se hace clic fuera de él
        }
    });
});

</script>
<?php
if (isset($_SESSION['usuario']) && isset($_SESSION['tipo']) && $_SESSION['tipo'] === 'admin') {
    echo '<a href=" /crud/indexCrud.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #2c3e50; color: white; padding: 10px 15px; border-radius: 8px; text-decoration: none; box-shadow: 0 4px 6px rgba(0,0,0,0.2); z-index: 1000;">
    ⬅ Regresar al panel</a>';
}
?>

</body>
</html>
