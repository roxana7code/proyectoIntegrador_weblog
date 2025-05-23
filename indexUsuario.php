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
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, 
    minimum-scale=1.0">
     <!-- Estilos del selector de idioma -->
    <link rel="stylesheet" href="css/idioma.css">
</head>
<body>
    <div id="overlay-menu"></div>

    <header>
        <div class="contenido-heder">
            <div class="menu-tips">
                <div class="logo-ods"> 
                    <img src="imagenWeb/img9.png" alt="">
                </div>
               <!-- Botón de idioma -->
<div class="language-toggle" onclick="toggleLanguage()">
  <img id="flag-icon" src="img/esp.png" alt="Idioma" />
</div>

<h1>
  <a href="indexUsuario.php">
    <span data-es="Salud y " data-en="Health and ">Salud y </span><b><span data-es="bienestar" data-en="well-being">bienestar</span></b>
  </a>
</h1>
                <button class="menu-toggle" id="menu-toggle">
        <i class="fas fa-bars"></i>
</button>

                <div class="menu-contenido" id="menu-contenido">
                    <nav style="display: flex; align-items: center;">
                        <ul style="display: flex; margin: 0; padding: 0;">
                           <li><a href="indexUsuario.php" class="lang-inicio"><i class="fas fa-home"></i> Inicio</a></li>
<li><a href="https://www.youtube.com/" class="lang-tutoriales"><i class="fab fa-youtube"></i> Tutoriales</a></li>
<li><a href="nosotros.php" class="lang-nosotros"><i class="fas fa-users"></i> Nosotros</a></li>
<li><a href="/crud/cerrar_sesion.php" class="lang-cerrarSesion"><i class="fas fa-sign-in-alt"></i> Cerrar sesión</a></li>

                        </ul>

                    <form id="searchForm" class="search-form" action="buscar.php" method="GET" style="margin-left: 20px; display: flex;">
  <input type="text" name="q" 
         placeholder="Buscar..." 
         data-placeholder-es="Buscar..." 
         data-placeholder-en="Search..."
         required 
         style="padding: 5px;">
  <button type="submit" style="padding: 5px;"><i class="fas fa-search"></i></button>
</form>

                        <!-- Saludo al usuario -->
                    <div class="perfil-usuario" style="margin-left: 20px; color: white;">
<?php
if (isset($_SESSION['usuario'])) {
    echo '<span style="color:rgb(0, 0, 0);"><i class="fas fa-user-circle"></i> <span class="lang-bienvenido">Bienvenido</span>, ' . htmlspecialchars($_SESSION['usuario']) . '</span>';
}
?>
</div>
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
<h1 class="slider-title lang-publicaciones">Publicaciones Recientes</h1>
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
            echo '<h4><a href="/post-Bloguero/post' . $fila['publicacion'] . '.php">' . htmlspecialchars($fila['titulo']) . '</a></h4>';            echo '<i class="far fa-user"> ' . htmlspecialchars($fila['autor']) . '</i> &nbsp;';
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
<h1 class="lang-pasoTitulo">Pasos para una alimentación saludable</h1>
            </div>
            <article>
                <div class="contenido">
                    <nav>
                        <ul>
                            <h1 class="lang-pasoTitulo">Pasos para una alimentación saludable</h1>

                            <li><a href="#"><i class="fas fa-calendar-alt"></i></a> <span class="lang-paso1">Planificas tus comidas</span></li>
                            <p class="lang-paso1desc">Organiza tus comidas saludables para asegurar una dieta balanceada</p>

                            <li><a href="#"><i class="fas fa-apple-alt"></i></a> <span class="lang-paso2">Incluye mas frutas y verduras</span></li>
                            <p class="lang-paso2desc">Aumenta el consumo de alimentos frescos y naturales en tu dieta diaria</p>

                            <li><a href="#"><i class="fas fa-tint"></i></a> <span class="lang-paso3">Hidratate adecuadamente</span></li>
                            <p class="lang-paso3desc">Mantén tu cuerpo hidratado bebiendo suficiente agua a lo largo del día</p>

                                                    </ul>
                                                </nav>
                            <a href="post-tips.php" style="display: inline-block; padding: 10px 20px; background-color: #2c3e50; color: whitesmoke; text-decoration: none; border-radius: 5px; font-weight: bold;">
                            <span data-es="Leer más" data-en="Read more">Leer más</span>
                            </a>
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
    <img src="post_Img/post1.jpg" alt="Salud y bienestar">
    <h3>¿Cómo debe de ser la dieta para deportistas?</h3>
    <p>La dieta para deportistas de alto rendimiento...</p>
    <span>24/05/2025</span>
    <a href="/post-Bloguero/post1.php" class="lang-leer-mas">Leer más</a>
</div>

<div class="articulo-item">
    <img src="post_Img/post2.jpg" alt="Salud y bienestar">
    <h3>Dieta antiinflamatoria</h3>
    <p>Elegir una dieta antiinflamatoria es clave...</p>
    <span>24/05/2025</span>
    <a href="/post-Bloguero/post2.php" class="lang-leer-mas">Leer más</a>
</div>

<!-- Repite para post3.php a post6.php -->
    <!-- Artículo 1 -->
<div class="articulo-item">
    <img src="/post_Img/post1.jpg" alt="Salud y bienestar">
    <h3>¿Cómo debe de ser la dieta para deportistas?</h3>
    <p>La dieta para deportistas de alto rendimiento...</p>
    <span>24/05/2025</span>
    <a href="/post-Bloguero/post1.php" class="lang-leer-mas">Leer más</a>
</div>

<!-- Artículo 2 -->
<div class="articulo-item">
    <img src="/post_Img/post2.jpg" alt="Salud y bienestar">
    <h3>Dieta antiinflamatoria</h3>
    <p>Elegir una dieta antiinflamatoria es clave...</p>
    <span>24/05/2025</span>
    <a href="/post-Bloguero/post2.php" class="lang-leer-mas">Leer más</a>
</div>
    <div class="articulo-item">
      <img src="post_Img/post4.jpg" alt="Salud y bienestar">
      <h3 data-es="Smoothie de Frutas y Avena" data-en="Fruit and Oat Smoothie"></h3>
      <p data-es="Este smoothie es una excelente manera de comenzar el…" data-en="This smoothie is an excellent way to start your…"></p>
      <span>24/05/2025</span>
      <a href="post-Bloguero/post4.php" data-es="Leer más" data-en="Read more"></a>
    </div>
    <div class="articulo-item">
      <img src="post_Img/post5.png" alt="Salud y bienestar">
      <h3 data-es="Ensalada con naranja, queso y pistachos" data-en="Salad with orange, cheese and pistachios"></h3>
      <p data-es="Esta ensalada con naranja, queso de cabra y pistachos, aportan…" data-en="This salad with orange, goat cheese, and pistachios provides…"></p>
      <span>24/05/2025</span>
      <a href="post-Bloguero/post5.php" data-es="Leer más" data-en="Read more"></a>
    </div>
  </div>
</section>


<script>
// Función para cambiar textos según el idioma
function cambiarIdioma(idioma) {
  document.querySelectorAll('[data-es]').forEach(el => {
    el.textContent = el.getAttribute('data-' + idioma);
  });
}

// Detectar idioma guardado o usar español por defecto
const idiomaGuardado = localStorage.getItem('language') || 'es';
cambiarIdioma(idiomaGuardado);

// Botones para cambiar idioma y guardar la elección
document.getElementById('btn-es').addEventListener('click', () => {
  localStorage.setItem('language', 'es');
  cambiarIdioma('es');
});
document.getElementById('btn-en').addEventListener('click', () => {
  localStorage.setItem('language', 'en');
  cambiarIdioma('en');
});
</script>


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
<h4>
  <span data-es="@ 2025 salud y bienestar - Todos los derechos reservados"
        data-en="@ 2025 health and well-being - All rights reserved">
    @ 2025 salud y bienestar - Todos los derechos reservados
  </span>
</h4>
            </footer>
        </div> 

    </div>

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Slick Carousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script src="js/script.js"></script>

<!-- Script del selector de idioma -->
    <script src="js/idioma.js"></script>

    <script>

    document.addEventListener("DOMContentLoaded", function () {
        const iconMenu = document.getElementById("icon-menu");
        const navMenu = document.querySelector(".menu-contenido nav");

        iconMenu.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
        
        // Cargar idioma al iniciar
        loadLanguage();
    });
    
    // Función para cambiar el idioma
    function toggleLanguage() {
        const flagIcon = document.getElementById('flag-icon');
        const currentLang = flagIcon.src.includes('esp.png') ? 'es' : 'en';
        
        if (currentLang === 'es') {
            flagIcon.src = 'img/eng.png';
            localStorage.setItem('language', 'en');
            applyLanguage('en');
        } else {
            flagIcon.src = 'img/esp.png';
            localStorage.setItem('language', 'es');
            applyLanguage('es');
        }
    }
    
    // Función para cargar el idioma guardado
    function loadLanguage() {
        const savedLang = localStorage.getItem('language') || 'es';
        const flagIcon = document.getElementById('flag-icon');
        
        flagIcon.src = savedLang === 'en' ? 'img/eng.png' : 'img/esp.png';
        applyLanguage(savedLang);
    }
    
  
        // Aplicar las traducciones a todos los elementos con clases lang-*
        Object.keys(translations[lang]).forEach(key => {
            const elements = document.querySelectorAll(`.lang-${key}`);
            elements.forEach(element => {
                element.textContent = translations[lang][key];
            });
        });

document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu-contenido");

  toggleBtn.addEventListener("click", function () {
    menu.classList.toggle("active");
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
