<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diseño web tipo blog - para practica</title>

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
<li>
  <a href="inicioSesion.php">
    <i class="fas fa-sign-in-alt"></i>
    <span data-es="Iniciar sesión" data-en="Log in">Iniciar sesión</span>
  </a>
</li>
<script src="js/idioma.js"></script>

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
            echo '<h4><a href="/inicioSesion.php">' . htmlspecialchars($fila['titulo']) . '</a></h4>';
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
      <img src="post_Img/post6.jpg" alt="Salud y bienestar">
      <h3 data-es="Galletas de avena y plátano" data-en="Oatmeal and Banana Cookies"></h3>
      <p data-es="Estas son unas galletas de avena muy saludables y fáciles, ideales…" data-en="These are very healthy and easy oatmeal cookies, perfect…"></p>
      <span>24/05/2025</span>
      <a href="post-Bloguero/post6.php" data-es="Leer más" data-en="Read more"></a>
    </div>
    <div class="articulo-item">
      <img src="post_Img/post1.jpg" alt="Salud y bienestar">
      <h3 data-es="¿Cómo debe de ser la dieta para deportistas de alto rendimiento?" data-en="What should the diet be like for high-performance athletes?"></h3>
      <p data-es="La dieta para deportistas de alto rendimiento juega un papel crucial para…" data-en="The diet for high-performance athletes plays a crucial role in…"></p>
      <span>24/05/2025</span>
      <a href="post-Bloguero/post1.php" data-es="Leer más" data-en="Read more"></a>
    </div>
    <div class="articulo-item">
      <img src="post_Img/post2.jpg" alt="Salud y bienestar">
      <h3 data-es="Dieta antiinflamatoria: alimentos recomendados y cuáles evitar" data-en="Anti-inflammatory diet: recommended foods and which to avoid"></h3>
      <p data-es="Elegir una dieta antiinflamatoria es clave para prevenir y combatir la inflamación que…" data-en="Choosing an anti-inflammatory diet is key to preventing and fighting inflammation that…"></p>
      <span>24/05/2025</span>
      <a href="post-Bloguero/post2.php" data-es="Leer más" data-en="Read more"></a>
    </div>
    <div class="articulo-item">
      <img src="post_Img/post3.jpg" alt="Salud y bienestar">
      <h3 data-es="Galletas de calabaza para el desayuno" data-en="Pumpkin cookies for breakfast"></h3>
      <p data-es="Estas galletas de calabaza se han vuelto una de mis recetas favoritas. Te prometo que te van a encantar…" data-en="These pumpkin cookies have become one of my favorite recipes. I promise you'll love them…"></p>
      <span>24/05/2025</span>
      <a href="post-Bloguero/post3.php" data-es="Leer más" data-en="Read more"></a>
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
                    <a href="inicioSesion.php" target="_blank"><i class="fa-brands fa-facebook icon-redes-footer"></i></a>
                    <a href="inicioSesion.php" target="_blank"><i class="fa-brands fa-instagram icon-redes-footer"></i></a>
                    <a href="inicioSesion.php"><i class="fab fa-twitter icon-redes-footer"></i></a>
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



</script>
    
</body>
</html>
