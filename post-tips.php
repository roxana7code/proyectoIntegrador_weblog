<?php
session_start();
include 'conexion.php';
$con = connection();

$id = 1;

if (isset($_SESSION['usuario_id'])) {
    $usuario_id = $_SESSION['usuario_id'];
} else {
    $usuario_id = 1;
}

$sql = "SELECT * FROM publicaciones WHERE publicacion = '$id'";
$query = mysqli_query($con, $sql);
if (!$query) {
    die("Error en la consulta: " . mysqli_error($con));
}
$post = mysqli_fetch_assoc($query);
if (!$post) {
    die("Publicación no encontrada.");
}

$sql_comments = "SELECT c.*, u.nombre AS nombre_usuario 
                FROM comentarios c
                JOIN usuarios u ON c.usuario_id = u.id
                WHERE c.publicacion_id = '$id'
                ORDER BY c.fecha DESC";
$query_comments = mysqli_query($con, $sql_comments);

$sql_like = "SELECT * FROM likes WHERE publicacion_id = '$id' AND usuario_id = '$usuario_id'";
$query_like = mysqli_query($con, $sql_like);
$has_liked = mysqli_num_rows($query_like) > 0;

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

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="estilosPost.css">
    <link rel="stylesheet" href="css/idioma.css">
</head>
<body id="body-recetas">
<header>
    <div class="contenido-heder">
        <div class="menu-tips">
            <div class="logo-ods"> 
                <img src="imagenWeb/img9.png" alt="">
            </div>
            <div class="language-toggle" onclick="toggleLanguage()">
                <img id="flag-icon" src="img/esp.png" alt="Idioma" />
            </div>
            <h1><a href="indexUsuario.php"><span data-es="Salud y " data-en="Health and "></span><b data-es="bienestar" data-en="Well-being"></b></a></h1>
            <div class="menu-contenido">
                <nav>
                    <ul>
                        <li><a href="indexUsuario.php"><i class="fas fa-home"></i> <span data-es="Inicio" data-en="Home"></span></a></li>
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
                <h1><span data-es="Los mejores tips de alimentacion" data-en="The best nutrition tips"></span></h1>
            </div>
            <div class="sub-titulo">
                <h2><span data-es="10 Tips para una alimentación saludable" data-en="10 Tips for Healthy Eating"></span></h2>
            </div>
            <div class="tip-recetas">
    <p>
        <span class="tip-titulo" data-es="1. Come variedad de alimentos:" data-en="1. Eat a variety of foods:"></span>
        <span data-es="Asegúrate amplia gama de alimentos, como frutas, verduras, cereales integrales, proteínas magras (pollo, pescado, tofu) y grasas saludables (aguacate, frutos secos, aceite de oliva). Esto te garantiza que tu cuerpo reciba todos los nutrientes esenciales." 
              data-en="Ensure a wide variety of foods, such as fruits, vegetables, whole grains, lean proteins (chicken, fish, tofu), and healthy fats (avocado, nuts, olive oil). This ensures your body gets all essential nutrients."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="2. Hidrátate bien:" data-en="2. Stay hydrated:"></span>
        <span data-es="El agua es clave para el buen funcionamiento del cuerpo. Intenta beber al menos 8 vasos de agua al día, y más si realizas actividad física intensa o vives en un clima cálido." 
              data-en="Water is essential for proper body function. Try to drink at least 8 glasses a day, more if you exercise intensely or live in a warm climate."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="3. Controla las porciones:" data-en="3. Control your portions:"></span>
        <span data-es="Aunque los alimentos sean saludables, comer en exceso puede contribuir al aumento de peso. Presta atención a las porciones y escucha las señales de hambre y saciedad de tu cuerpo." 
              data-en="Even healthy foods can contribute to weight gain if overeaten. Pay attention to portions and listen to your body's hunger and fullness signals."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="4. Come porciones adecuadas:" data-en="4. Eat proper portions:"></span>
        <span data-es="Prestar atención a las porciones ayuda a mantener un equilibrio calórico. Comer en exceso, incluso alimentos saludables, puede ser perjudicial." 
              data-en="Paying attention to portions helps maintain caloric balance. Overeating, even healthy foods, can be harmful."></span>
    </p>
    <img src="imagenWeb/img18.jpeg" alt="">
</div>

<div class="tip-recetas">
    <p>
        <span class="tip-titulo" data-es="5. Evita las dietas muy restrictivas:" data-en="5. Avoid very restrictive diets:"></span>
        <span data-es="Las dietas extremadamente bajas en calorías o de eliminación pueden ser insostenibles a largo plazo y afectar la salud. Es mejor adoptar un enfoque equilibrado y sostenible." 
              data-en="Extremely low-calorie or elimination diets can be unsustainable long-term and affect health. It’s better to adopt a balanced, sustainable approach."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="6. Ingiere fibra suficiente:" data-en="6. Consume enough fiber:"></span>
        <span data-es="La fibra es esencial para la digestión y la salud intestinal. Consúmela a través de frutas, verduras, legumbres y cereales integrales." 
              data-en="Fiber is essential for digestion and gut health. Consume it through fruits, vegetables, legumes, and whole grains."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="7. Prioriza las grasas saludables:" data-en="7. Prioritize healthy fats:"></span>
        <span data-es="Elige grasas saludables como las del aceite de oliva, aguacate, frutos secos y pescado. Estas grasas son importantes para la salud cardiovascular y el funcionamiento del cerebro." 
              data-en="Choose healthy fats like olive oil, avocado, nuts, and fish. These fats are important for cardiovascular health and brain function."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="8. Planifica tus comidas:" data-en="8. Plan your meals:"></span>
        <span data-es="Planificar tus comidas con anticipación te ayuda a evitar tomar decisiones impulsivas. Además, te permite incluir una variedad de alimentos en tu dieta." 
              data-en="Planning your meals ahead helps avoid impulsive decisions. It also allows including a variety of foods in your diet."></span>
    </p>
    <p>
        <span class="tip-titulo" data-es="9. Controla el consumo de sal:" data-en="9. Control salt intake:"></span>
        <span data-es="Reducir la sal ayuda a mantener una presión arterial saludable y prevenir enfermedades cardiovasculares. Cocina con hierbas y especias para agregar sabor sin exceso de sodio." 
              data-en="Reducing salt helps maintain healthy blood pressure and prevent cardiovascular diseases. Cook with herbs and spices to add flavor without excess sodium."></span>
    </p>
    <img src="imagenWeb/img19.jpeg" alt="">
    <p>
        <span class="tip-titulo" data-es="10. Escucha a tu cuerpo:" data-en="10. Listen to your body:"></span>
        <span data-es="Aprende a reconocer las señales de hambre y saciedad. Comer conscientemente te ayudará a disfrutar de la comida y evitar el exceso." 
              data-en="Learn to recognize hunger and fullness signals. Mindful eating helps you enjoy food and avoid overeating."></span>
    </p>
            </div>
        </div>
    </article>
</div>
<div class="comentarios-likes">
    <h2><span data-es="Comentarios" data-en="Comments"></span></h2>
    <div class="comentarios-container">
        <?php while ($comment = mysqli_fetch_assoc($query_comments)): ?>
            <div class="comentario">
                <h4><?php echo htmlspecialchars($comment['nombre_usuario']); ?></h4>
                <p><?php echo htmlspecialchars($comment['comentario']); ?></p>
                <p class="fecha-comentario"><?php echo htmlspecialchars($comment['fecha']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>

    <h2><span data-es="Likes" data-en="Likes"></span></h2>
    <div class="likes-container">
        <button id="like-button" class="<?php echo $has_liked ? 'liked' : ''; ?>">
            <i class="fas fa-heart"></i> <span id="like-count"><?php echo $total_likes; ?></span>
        </button>
    </div>

    <h2><span data-es="Deja un comentario" data-en="Leave a comment"></span></h2>
    <form id="comment-form">
        <textarea name="comment" placeholder="Escribe tu comentario..." data-es="Escribe tu comentario..." data-en="Write your comment..."></textarea>
        <button type="submit"><span data-es="Enviar" data-en="Send"></span></button>
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
        <h4>@ 2025 <span data-es="salud y bienestar - Todos los derechos reservados" data-en="health and well-being - All rights reserved"></span></h4>
    </footer>
</div>
<script>
    function applyLanguage(lang) {
        document.querySelectorAll('[data-es]').forEach(el => {
            el.textContent = el.getAttribute(`data-${lang}`);
        });
        document.getElementById('flag-icon').src = lang === 'es' ? 'img/esp.png' : 'img/eng.png';
    }

    function toggleLanguage() {
        const currentLang = localStorage.getItem('lang') || 'es';
        const newLang = currentLang === 'es' ? 'en' : 'es';
        localStorage.setItem('lang', newLang);
        applyLanguage(newLang);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedLang = localStorage.getItem('lang') || 'es';
        applyLanguage(savedLang);
    });

    $('#comment-form').submit(function(event) {
        event.preventDefault();
        var commentInput = $('textarea[name="comment"]');
        var comment = commentInput.val().trim();

        if (comment !== '') {
            $.ajax({
                url: '../comment_handler.php',
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
            url: '../like_handler.php',
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

</html>