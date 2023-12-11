<?php
session_start(); // Inicia la sesión
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <title>GlamGrid Store</title>
</head>
<body>
<?php include_once "headerregistrado.php"; ?>

<?php
$urlApi = 'http://localhost/Semestral-ingenieriaweb/backend/api/indexapi.php';
$jsonData = file_get_contents($urlApi);
$data = json_decode($jsonData, true);
$productos = $data['success'] ? $data['data'] : [];
?>

<div class="popular-items-carousel">
    <h1>Compras Más Populares</h1>
    <div class="carousel" id="popularCarousel">
        <?php foreach ($productos as $index => $producto): ?>
            <div class="carousel-item" data-index="<?= $index ?>">
                <img src="../img/<?= htmlspecialchars($producto['Nombre']) ?>.jpg">
                <h2><?= htmlspecialchars($producto['Nombre']) ?></h2>
                <button class="details-button" onclick="toggleDetails(<?= $index ?>)">Ver más detalles</button>
                <div class="product-details" id="details<?= $index ?>">
                    <p>Descripción: <?= htmlspecialchars($producto['Descripcion']) ?></p>
                    <p>Precio: $<?= htmlspecialchars($producto['Precio']) ?></p>
                    <p>Tamaño: <?= htmlspecialchars($producto['Tamano']) ?></p>
                    <p>Color: <?= htmlspecialchars($producto['Color']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control prev" onclick="moveCarousel('prev')">❮</button>
    <button class="carousel-control next" onclick="moveCarousel('next')">❯</button>
</div>

<section class="testimonials-section">
    <h2>Lo Que Dicen Nuestros Clientes</h2>
    <div class="testimonial">
        <blockquote>"El servicio fue excepcional y los productos son de alta calidad. ¡Definitivamente volveré a comprar aquí!"</blockquote>
        <p class="client-name">- Juan Pérez</p>
    </div>
    <div class="testimonial">
        <blockquote>"Una experiencia de compra maravillosa. La selección de productos es fantástica y el envío es rápido."</blockquote>
        <p class="client-name">- María Gómez</p>
    </div>
    <div class="testimonial">
        <blockquote>"Increíble variedad y calidad excepcional. Cada compra ha superado mis expectativas. ¡Totalmente recomendado!"</blockquote>
        <p class="client-name">- Carlos Rodríguez</p>
    </div>
    <div class="testimonial">
        <blockquote>"La atención al cliente es de primera. Tuve un problema con mi pedido y lo solucionaron de inmediato. Muy satisfecha."</blockquote>
        <p class="client-name">- Lucía Martínez</p>
    </div>
    <div class="testimonial">
        <blockquote>"La mejor tienda online para mis necesidades de moda. Los estilos son modernos y siempre encuentro lo que busco."</blockquote>
        <p class="client-name">- Sofía Hernández</p>
    </div>
    <div class="testimonial">
        <blockquote>"Precios competitivos y calidad inmejorable. He recomendado esta tienda a todos mis amigos."</blockquote>
        <p class="client-name">- Diego Alonso</p>
    </div>
    <div class="testimonial">
        <blockquote>"Cada temporada espero con ansias las nuevas colecciones. Nunca dejan de sorprenderme con sus diseños innovadores."</blockquote>
        <p class="client-name">- Gabriela López</p>
    </div>

    <!-- Añade más testimonios según sea necesario -->
</section>








<?php include_once "../usuario/footer.php"; ?>


<script>
    function moveCarousel(direction) {
        var carousel = document.getElementById('popularCarousel');
        var scrollAmount = carousel.offsetWidth;
        if (direction === 'next') {
            carousel.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        } else {
            carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        }
    }
    function toggleDetails(index) {
        var detailsDiv = document.getElementById('details' + index);
        if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
    }

</script>
</body>


</html>