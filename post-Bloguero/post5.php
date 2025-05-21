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
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div class="todo-contenido-post">
        <div class="posts-contenido">
            <div class="titulo-posts">
                <h1>Ensalada con naranja, queso y pistachos    </h1>
            </div>
            <div class="inicio-posts">
                <p> Esta ensalada con naranja, queso de cabra y pistachos, estos aportan vitamina, minerales y proteínas. Si no tienes, sustitúyelos por otro fruto seco.   <p>
            </div>
            <div class="contenido-posts">
                <img src="../post_Img/post5.png" alt="">
                <h1>Ingredientes:</h1>
                <p><span class="post-2">•</span> 200 gramos de escarola    </p>
                <p><span class="post-2">•</span> 50 gramos de rúcula (sustituye escarola y rúcula por la lechuga que tengas)   </p>
                <p><span class="post-2">•</span> 2 naranjas    </p>
                <p><span class="post-2">•</span> 300 gramos de rulo de queso de cabra (rebaja calorías con queso fresco)  </p>
                <p><span class="post-2">•</span> 50 gramos de pistachos    </p>
                <p><span class="post-2">•</span> 5 cucharadas de aceite de oliva virgen   </p>
                <p><span class="post-2">•</span> 1 cucharada de vinagre de jerez    </p>
                <p><span class="post-2">•</span> Cebollino (opcional)    </p>
                <p><span class="post-2">•</span> Sal  </p>
                
                <h1>Pasos de preparación: </h1>
                <p><span class="post-2">1.</span> Trocea, lava y seca la escarola. Lava y seca la rúcula. </p>
                <p><span class="post-2">2.</span> Corta una naranja y media en gajos y retira la piel. Exprime la mitad restante para extraer el zumo. </p>
                <p><span class="post-2">3.</span> Lava, seca y pica el cebollino.   </p> 
                <p><span class="post-2">4.</span> Pela y pica los pistachos.  </p>
                <p><span class="post-2">5.</span> Prepara la vinagreta mezclando cuatro cucharadas de aceite con el vinagre, dos cucharadas de zumo de naranja, una pizca de sal y dos cucharadas de cebollino picado.    </p>
                <p><span class="post-2">6.</span> Retira la corteza del rulo de queso de cabra, corta el queso en trozos, úntate las manos con aceite para formar bolitas y rebózalas con los pistachos picados.    </p>
                <p><span class="post-2">7.</span> Reparte los ingredientes en los platos y aliña con la vinagreta.    </p>
                <img src="../post_Img/pistachos-naranja.webp" alt="">
            
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