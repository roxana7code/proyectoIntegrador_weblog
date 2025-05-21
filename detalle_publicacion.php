<?php
session_start();

include 'conexion.php';
$con = connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['usuario_id'])) {
        $usuario_id = $_SESSION['usuario_id'];
    } else {
        // Si no hay sesión activa, rediriges al login
        header('Location: inicioSesion.php');
        exit;
    }

    // Consulta para obtener la publicación
    $sql = "SELECT * FROM publicaciones WHERE publicacion = '$id'";
    $query = mysqli_query($con, $sql);

    if (!$query) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    $post = mysqli_fetch_assoc($query);

    if ($post) {
        $sql_recent = "SELECT * FROM publicaciones ORDER BY fecha DESC LIMIT 5";
        $query_recent = mysqli_query($con, $sql_recent);

        $sql_comments = "SELECT c.*, u.nombre AS nombre_usuario 
                        FROM comentarios c
                        JOIN usuarios u ON c.usuario_id = u.id
                        WHERE c.publicacion_id = '$id'
                        ORDER BY c.fecha DESC";
        $query_comments = mysqli_query($con, $sql_comments);

        $sql_like = "SELECT * FROM likes WHERE publicacion_id = '$id' AND usuario_id = '$usuario_id'";
        $query_like = mysqli_query($con, $sql_like);
        $has_liked = mysqli_num_rows($query_like) > 0;

        mysqli_close($con);
    } else {
        echo "Publicación no encontrada.";
        exit;
    }
} else {
    echo "ID de publicación no proporcionado.";
    exit;
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Detalle</title>
    <link rel="stylesheet" href="detallepublicacion.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
</head>
<body id="body-posts">
    <header>
        <div class="contenido-header">
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

<main class="posts-contenido">
    <div class="post-slider">
    <div class="slider-title">
        <h2>Publicaciones Recientes</h2>
    </div>
    <div class="post-wrapper">
        <div class="slick-slider">
            <?php while ($recent_post = mysqli_fetch_assoc($query_recent)): ?>
                <div class="post">
                    <a href="detalle_publicacion.php?id=<?php echo $recent_post['publicacion']; ?>">
                        <img src="../imagenWeb/<?php echo htmlspecialchars($recent_post['imagen']); ?>" alt="Imagen de la publicación" class="slider-image" />
                        <div class="post-info">
                            <h3><?php echo htmlspecialchars($recent_post['titulo']); ?></h3>
                            <p><?php echo htmlspecialchars($recent_post['autor']); ?></p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="prev">▲</div> <!-- Flecha hacia arriba -->
    <div class="next">▼</div> <!-- Flecha hacia abajo -->
</div>


    <div class="contenido-publicacion">
        <h1><?php echo htmlspecialchars($post['titulo']); ?></h1>
        <p><strong>Autor:</strong> <?php echo htmlspecialchars($post['autor']); ?></p>
        <p><strong>Fecha:</strong> <?php echo htmlspecialchars($post['fecha']); ?></p>
        <img src="../imagenWeb/<?php echo htmlspecialchars($post['imagen']); ?>" alt="Imagen de la publicación" />
        <p><?php echo nl2br(htmlspecialchars($post['contenido'])); ?></p>
    </div>
</main>

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
            <i class="fas fa-heart"></i> <span id="like-count"><?php echo mysqli_num_rows($query_like); ?></span>
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
                <a href="https://www.facebook.com/share/193M2XwD2p/?mibextid=wwXIfr" target="_blank"><i class="fa-brands fa-facebook icon-redes-footer"></i></a>
                <a href="https://www.instagram.com/salud_optimaa?igsh=MXJuNXlsZGdjNGpvaQ%3D%3D&utm_source=qr" target="_blank"><i class="fa-brands fa-instagram icon-redes-footer"></i></a>
                <a href="https://x.com/VALERIACUE96463"><i class="fab fa-twitter icon-redes-footer"></i></a>
            </div>
            <hr>
            <h4>@ 2025 salud y bienestar - Todos los derechos reservados</h4>
        </footer>
    </div>
<script>
$(document).ready(function(){
    $('.slick-slider').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 5,
        slidesToScroll: 5,
        vertical: true, // Habilita el desplazamiento vertical
        prevArrow: $('.prev'),
        nextArrow: $('.next'),
    });
});
</script>
<script>
    // Manejo del formulario de comentarios
    $('#comment-form').submit(function(event) {
        event.preventDefault();
        var commentInput = $('textarea[name="comment"]');
        var comment = commentInput.val().trim();

        if (comment !== '') {
            $.ajax({
                url: 'comment_handler.php',
                type: 'POST',
                data: {
                    publicacion_id: '<?php echo $id; ?>',
                    usuario_id: '<?php echo $usuario_id; ?>',
                    comentario: comment
                },
                success: function(response) {
                    commentInput.val('');
                    location.reload(); // Recargar la página para mostrar el nuevo comentario
                },
                error: function() {
                    alert('Ocurrió un error al enviar el comentario.');
                }
            });
        }
    });
$(document).ready(function() {
    $('#like-button').click(function() {
        var likeButton = $(this);

        $.ajax({
            url: 'like_handler.php',
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
});

</script>
</body>
</html>

