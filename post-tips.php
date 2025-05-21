<?php
session_start();
include 'conexion.php';  // ajusta ruta si es necesario
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
    <title>Mejor salud</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="stylesheet" href="estilosPost.css">

    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, 
    minimum-scale=1.0">

</head>
<body id="body-recetas">
    <header>
        <div class="contenido-heder">
            <div class="menu-tips">
                <div class="logo-ods"> 
                    <img src="imagenWeb/img9.png" alt="">
                </div>
                <h1><a href="indexUsuario.php">Salud y <b>bienestar</b></a></h1>
                <div class="menu-contenido">
                    <nav>
                        <ul>
                            <li><a href="indexUsuario.php"><i class="fas fa-home"></i> Inicio</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
        <div class="contenido-todo">
            <article>
                <div class="informacion">
                    <div class="titulo">
                        <h1>
                            Los mejores tips de alimentacion
                        </h1>
                    </div>
                    <div class="sub-titulo">
                        <h2>
                            10 Tips para una alimentación saludable
                        </h2>
                    </div>
                    <div class="tip-recetas">
                        <p> <span class="tip-titulo">1. Come variedad de alimentos: </span>
                            Asegúrate amplia gama de alimentos, como frutas, verduras, cereales integrales, proteínas magras (pollo, pescado, tofu) 
                            y grasas saludables (aguacate, frutos secos, aceite de oliva).
                            Esto te garantiza que tu cuerpo reciba todos los nutrientes esenciales.</p>
                        <p> <span class="tip-titulo">2. Hidrátate bien: </span>
                            El agua es clave para el buen funcionamiento del cuerpo. Intenta beber al menos 8 vasos de agua al día, y más si realizas actividad física intensa o 
                            v de incluir en tu dieta unaives en un clima cálido.</p>
                        <p> <span class="tip-titulo"> 3. Controla las porciones: </span>
                            Aunque los alimentos sean saludables, comer en exceso puede contribuir al aumento de peso. Presta atención a las porciones y escucha las señales de 
                            hambre y saciedad de tu cuerpo.</p>
                        <p> <span class="tip-titulo">4. Come porciones adecuadas: </span>
                            Prestar atención a las porciones ayuda a mantener un equilibrio calórico. Comer en exceso, incluso alimentos saludables, puede ser perjudicial.</p>   
                            <img src="imagenWeb/img18.jpeg" alt="">
                    </div>
                    <div class="tip-recetas">
                        <p> <span class="tip-titulo">5. Evita las dietas muy restrictivas: </span>
                            Las dietas extremadamente bajas en calorías o de eliminación pueden ser insostenibles a largo plazo y afectar la salud. Es mejor adoptar un 
                            enfoque equilibrado y sostenible.</p> 
                        <p> <span class="tip-titulo">6. Ingiere fibra suficiente: </span>
                            La fibra es esencial para la digestión y la salud intestinal. Consúmela a través de frutas, verduras, legumbres y cereales integrales.</p>     
                            
                        <p> <span class="tip-titulo">7. Prioriza las grasas saludables: </span>
                            Elige grasas saludables como las del aceite de oliva, aguacate, frutos secos y pescado. Estas grasas son importantes para la salud cardiovascular
                            y el funcionamiento del cerebro.</p>  
                        <p> <span class="tip-titulo">8. Planifica tus comidas: </span>8. Planifica tus comidas
                            Planificar tus comidas con anticipación te ayuda a evitar tomar decisiones impulsivas. Además, te permite incluir una variedad de alimentos en tu dieta.</p> 
                        <p> <span class="tip-titulo">9. Controla el consumo de sal: </span>
                            Reducir la sal ayuda a mantener una presión arterial saludable y prevenir enfermedades cardiovasculares. Cocina con hierbas y especias para agregar sabor
                            sin exceso de sodio.</p>  
                            <img src="imagenWeb/img19.jpeg" alt=""> 
                        <p> <span class="tip-titulo">10. Escucha a tu cuerpo: </span>
                            Aprende a reconocer las señales de hambre y saciedad. Comer conscientemente te ayudará a disfrutar de la comida y evitar el exceso.</p>
                            
                    </div>
                </div>
            </article>
        </div>
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
                <a href="#"><i class="fab fa-twitter icon-redes-footer"></i></a>
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