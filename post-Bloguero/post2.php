<?php
session_start();
include '../conexion.php';  // ajusta ruta si es necesario
$con = connection();

// Aquí defines el id de la publicación, por ejemplo 1 para este post
$id = 1;  // si usas varias publicaciones, hazlo dinámico con GET

// Usuario logueado (simula o redirige)
if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
} else {
    // Para prueba, podrías definir un usuario, o redirigir a login
    $usuario_id = 1; // solo para ejemplo, cambia según tu sistema
    // header('Location: inicioSesion.php');
    // exit;
}

// Consulta para obtener la publicación
$sql = "SELECT * FROM publicaciones WHERE publicacion = '$id'";
$query = mysqli_query($con, $sql);
if (!$query) {
    die("Error en la consulta: " . mysqli_error($con));
}
$post = mysqli_fetch_assoc($query);
if (!$post) {
    die("Publicación no encontrada.");
}

// Obtener comentarios de la publicación
$sql_comments = "SELECT c.*, u.nombre AS nombre_usuario 
                FROM comentarios c
                JOIN usuarios u ON c.usuario_id = u.id
                WHERE c.publicacion_id = '$id'
                ORDER BY c.fecha DESC";
$query_comments = mysqli_query($con, $sql_comments);

// Obtener like si el usuario ya dio like
$sql_like = "SELECT * FROM likes WHERE publicacion_id = '$id' AND usuario_id = '$usuario_id'";
$query_like = mysqli_query($con, $sql_like);
$has_liked = mysqli_num_rows($query_like) > 0;

// Total de likes para esta publicación
$sql_total_likes = "SELECT COUNT(*) AS total FROM likes WHERE publicacion_id = '$id'";
$query_total_likes = mysqli_query($con, $sql_total_likes);
$total_likes = 0;
if ($row = mysqli_fetch_assoc($query_total_likes)) {
    $total_likes = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>post1</title>
    <link rel="stylesheet" href="post-blogero.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body id="body-posts">
    <header>
        <div class="contenido-heder">
            <div class="menu-tips">
                <div class="logo-ods"> 
                    <img src="imagenWeb/img9.png" alt="">
                </div>
                <h1><a href="/indexUsuario.php">Salud y <b>bienestar</b></a></h1>
                <div class="menu-contenido">
                    <nav>
                        <ul>
                            <li><a href="/indexUsuario.php"><i class="fas fa-home"></i> Inicio</a></li>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="todo-contenido-post">
        <div class="posts-contenido">
            <div class="titulo-posts">
                <h1>Dieta antiinflamatoria: alimentos recomendados y cuáles evitar  </h1>
            </div>
            <div class="inicio-posts">
                <p >Elegir una dieta antiinflamatoria es clave para prevenir y combatir la inflamación que, a la larga, puede derivar en la aparición de 
                    enfermedades crónicas como la artritis, el asma o la diabetes, patologías cardíacas o cáncer. A continuación, vamos a ver cuáles son 
                    los alimentos antiinflamatorios que son aliados para tener una buena salud y los que se deben evitar. <p>
            </div>
            <div class="contenido-posts">
                <img src="../post_Img/post2.jpg" alt="">
                <h1>¿Qué es una alimentación antiinflamatoria? </h1> 
                <p>La alimentación antiinflamatoria se basa en la ingesta de nutrientes que ayudan a evitar procesos inflamatorios en el organismo. Esto no solo engloba 
                la típica hinchazón, sino también las inflamaciones crónicas originadas por enfermedades más graves como la diabetes, la fibromialgia o incluso el cáncer.  </p>
                
                <h1>¿En qué casos se indica una dieta antiinflamatoria? </h1>
                <p>Seguir una dieta antiinflamatoria es una forma de alimentación recomendable para prevenir diferentes patologías y alteraciones como son las siguientes: </p>
                
                <p><span class="post-2">• 💪 Dolor crónico</span>si se padecen dolores crónicos en las articulaciones, como la artritis, la dieta antiinflamatoria puede ayudar a reducir la 
                inflamación y aliviar las molestias.  </p>
                <p><span class="post-2">• ❤️ Enfermedades cardíacas</span> la inflamación crónica puede contribuir a generar enfermedades cardíacas y la dieta ayuda reducir el riesgo. </p>
                <p><span class="post-2">• 🥦 Problemas digestivos</span> la inflamación en el tracto digestivo puede causar problemas como el sobrecrecimiento bacteriano del intestino delgado (SIBO),
                el síndrome del intestino irritable y la colitis ulcerosa.  </p>
                <p><span class="post-2">• ⚖️ Sobrepeso u obesidad </span> el exceso de peso produce inflamación en el cuerpo y consumir alimentos antiinflamatorios puede ayudar a reducir el peso y mejorar la salud. </p>
                <p><span class="post-2">• 🌸 Problemas de piel </span>la inflamación también se refleja en la piel, con problemas como el acné y el eccema.  </p>
                <p><span class="post-2">• 🧘 Depresión y ansiedad</span>una inflamación cronificada se ha relacionado también con problemas psicológicos, como la depresión y la ansiedad y, en estos casos, la dieta antiinflamatoria favorece la salud mental. </p>
                
                <h1>🥗 Alimentos antiinflamatorios </h1> 
                <p>Existen varios alimentos que se consideran antiinflamatorios por su aporte de nutrientes y compuestos específicos: </p> 
                <p><span class="post-2">1.Frutas y verduras  </span>piña, manzana, papaya, cerezas, frutas cítricas (naranja y limón), frutos rojos, espinacas, brócoli, apio, entre otras.  </p>
                <p><span class="post-2">2.🐟Pescado azul: </span> especialmente el salmón, el atún y las sardinas, ricos en ácidos grasos omega-3.  </p>
                <p><span class="post-2">3.🥜Frutos secos y semillas: </span> pistachos, nueces, almendras y semillas de chía y lino. </p> 
                <p><span class="post-2">4.🍵Té verde: </span>es rico en antioxidantes y catequinas, compuestos antiinflamatorios. </p>
                <p><span class="post-2">5.🌿Especias:</span>jengibre, cúrcuma y canela. </p>
                <p><span class="post-2">6.🦠Probióticos:</span>como los que contienen el yogur y el kéfir, que ayudan a equilibrar la flora intestinal y reducir la inflamación.  </p>
                <p>✅ Es importante incluir este conjunto de alimentos cuyos efectos antiinflamatorios contribuyen a una dieta sana, nutritiva y variada.  </p>
                <img src="../post_Img/alimentos-inflamatorios_2.webp" alt="">
                
                <h1>🚫Alimentos para evitar en una dieta antiinflamatoria  </h1>
                <p>Tan importante es saber qué comer en una dieta antiinflamatoria como tener claro qué productos evitar para prevenir la inflamación a corto y a largo plazo, como serían estos: </p> 
                <p><span class="post-2">•🥩Alimentos procesados: </span> embutidos, productos precocinados y alimentos con aditivos artificiales.  </p>
                <p><span class="post-2">•🍩Alimentos fritos y procesados: </span> •	Alimentos fritos y procesados:  </p>
                <p><span class="post-2">•🍬Azúcar </span> y alimentos con azúcares añadidos. </p>
                <p><span class="post-2">•🍔Grasas saturadas: </span> presentes en los productos ultraprocesados y en las carnes rojas. </p>
                <p><span class="post-2">•🍞Alimentos refinados:  </span> : pan blanco, arroz blanco y pasta refinada.  </p>
                <p><span class="post-2">•🍷Alcohol:  </span> su consumo aumenta la inflamación y el riesgo de enfermedades crónicas.  </p>
                <p><span class="post-2">•☕Cafeína:  </span>tomarla en exceso también contribuye a inflamar el cuerpo.  </p>
                <p>Esto no significa que se deban eliminar estos productos y alimentos por completo, la idea es reducir y evitar su consumo habitual para beneficiar la salud y, a la vez, adquirir buenos hábitos. ¡Todo es cuestión de equilibrio!  </p>
            </div>
        </div>
        <section id="aside">
            <div class="columna-aside">
                <div class="articulo-item">
                    <img src="../post_Img/post6.jpg" alt="Salud y bienestar">
                    <h3>Galletas de avena y platano </h3>
                    <p>Estas son unas galletas de avena muy saludables y fáciles, ideales…  </p>
                    <span>24/05/2025</span>
                    <a href="../post-Bloguero/post6.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="../post_Img/post1.jpg" alt="Salud y bienestar">
                    <h3>¿Cómo debe de ser la dieta para deportistas de alto rendimiento? </h3>
                    <p>La dieta para deportistas de alto rendimiento juega un papel crucial para… </p>
                    <span>24/05/2025</span>
                    <a href="../post-Bloguero/post1.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="../post_Img/post2.jpg" alt="Salud y bienestar">
                    <h3>Dieta antiinflamatoria: alimentos recomendados y cuáles evitar </h3>
                    <p>Elegir una dieta antiinflamatoria es clave para prevenir y combatir la inflamación que… </p>
                    <span>24/05/2025</span>
                    <a href="../post-Bloguero/post2.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="../post_Img/post3.jpg" alt="Salud y bienestar">
                    <h3>Galletas de calabaza para el desayuno  </h3>
                    <p>Estas galletas de calabaza se han vuelto una de mis recetas favoritas. Te prometo que te van a encantar… </p>
                    <span>24/05/2025</span>
                    <a href="../post-Bloguero/post3.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="../post_Img/post4.jpg" alt="Salud y bienestar">
                    <h3>Smoothie de Frutas y Avena </h3>
                    <p>Este smoothie es una excelente manera de comenzar el… </p>
                    <span>24/05/2025</span>
                    <a href="../post-Bloguero/post4.php">Leer más</a>
                </div>
                <div class="articulo-item">
                    <img src="../post_Img/post5.png" alt="Salud y bienestar">
                    <h3>Ensalada con naranja, queso y pistachos </h3>
                    <p>Esta ensalada con naranja, queso de cabra y pistachos, aportan… </p>
                    <span>24/05/2025</span>
                    <a href="../post-Bloguero/post5.php">Leer más</a>
                </div>
                <!-- Repite el bloque div para más artículos -->
            </div>
        </section>
    </div>

    <div class="comentarios-likes">
    <h2>Comentarios</h2>
    <div class="comentarios-container">
        <?php while ($comment = mysqli_fetch_assoc($query_comments)): ?>
            <div class="comentario">
                <h4><?php echo htmlspecialchars($comment['nombre_usuario']); ?></h4>
                <p><?php echo htmlspecialchars($comment['comentario']); ?></p>
                <p class="fecha-comentario"><?php echo htmlspecialchars($comment['fecha']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <h2>Likes</h2>
    <div class="likes-container">
        <button id="like-button" class="<?php echo $has_liked ? 'liked' : ''; ?>">
            <i class="fas fa-heart"></i> <span id="like-count"><?php echo $total_likes; ?></span>
        </button>
    </div>

    <h2>Deja un comentario</h2>
    <form id="comment-form">
        <textarea name="comment" placeholder="Escribe tu comentario..."></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>

    
    <div class="container-footer">
            <footer>
                <div class="logo-footer">
                    <img src="imagenWeb/img9.png" alt="">
                </div>

                <div class="redes-footer">
                    <a href="https://www.facebook.com/share/193M2XwD2p/?mibextid=wwXIfr"><i class="fa-brands fa-facebook icon-redes-footer"></i></a>
                    <a href="https://www.instagram.com/salud_optimaa?igsh=MXJuNXlsZGdjNGpvaQ%3D%3D&utm_source=qr"><i class="fa-brands fa-instagram icon-redes-footer"></i></a>
                    <a href="https://x.com/VALERIACUE96463"><i class="fab fa-twitter icon-redes-footer"></i></a>
                </div>

                <hr>
                <h4>@ 2025 salud y bienestar - Todos los derechos reservados</h4>
            </footer>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#comment-form').submit(function(event) {
        event.preventDefault();
        var commentInput = $('textarea[name="comment"]');
        var comment = commentInput.val().trim();

        if (comment !== '') {
            $.ajax({
                url: '../comment_handler.php',  // ajusta ruta
                type: 'POST',
                data: {
                    publicacion_id: '<?php echo $id; ?>',
                    usuario_id: '<?php echo $usuario_id; ?>',
                    comentario: comment
                },
                success: function(response) {
                    commentInput.val('');
                    location.reload();
                },
                error: function() {
                    alert('Ocurrió un error al enviar el comentario.');
                }
            });
        }
    });

    $('#like-button').click(function() {
        var likeButton = $(this);

        $.ajax({
            url: '../like_handler.php', // ajusta ruta
            type: 'POST',
            data: {
                publicacion_id: '<?php echo $id; ?>',
                usuario_id: '<?php echo $usuario_id; ?>'
            },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.status === 'liked') {
                    likeButton.addClass('liked');
                } else if (data.status === 'unliked') {
                    likeButton.removeClass('liked');
                }
                $('#like-count').text(data.total_likes);
            },
            error: function() {
                alert('Ocurrió un error al procesar el like.');
            }
        });
    });
</script>

</body>
</html>