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
<?php include_once "headeradmin.php"; ?>

<div class="popular-items-carousel">
    <h1>COMPRAS MAS POPULARES</h1>
    <div class="carousel" id="popularCarousel">
        <div class="carousel-item" data-index="0">
            <img src="https://m.media-amazon.com/images/I/71xdSLvi8ML._AC_UF894,1000_QL80_.jpg" alt="Producto 1">
            <h2>Jeans de hombre</h2>
            <button class="details-button" onclick="toggleDetails(0)">Ver más detalles</button>
            <div class="product-details" id="details0">
                <p>Talla: M</p>
                <p>Color: Azul</p>
                <p>Stock: Disponible</p>
                <!-- Más detalles aquí -->
            </div>
        </div>
        <div class="carousel-item" data-index="1">
            <img src="https://img.freepik.com/fotos-premium/plantilla-maqueta-maqueta-hombre-camiseta-negra-sus-disenos_398492-4748.jpg" alt="Producto 2">
            <h2>Camiseta negra</h2>
            <button class="details-button" onclick="toggleDetails(0)">Ver más detalles</button>
            <div class="product-details" id="details0">
                <p>Talla: M</p>
                <p>Color: Azul</p>
                <p>Stock: Disponible</p>
                <!-- Más detalles aquí -->
            </div>
        </div>
        <div class="carousel-item" data-index="2">
            <img src="https://media.rpctv.com/p/927388232b42346a148b3aca0efae546/adjuntos/314/imagenes/018/167/0018167218/1200x675/smart/camiseta-panama-nueva.jpeg" alt="Producto 1">
            <h2>Camiseta de Panamá</h2>
            <button class="details-button" onclick="toggleDetails(2)">Ver más detalles</button>
            <div class="product-details" id="details2">
                <p>Talla: M</p>
                <p>Color: Roja</p>
                <p>Stock: Disponible</p>
                <!-- Más detalles aquí -->
            </div>
        </div>
        <div class="carousel-item" data-index="3">
            <img src="https://phantom-expansion.unidadeditorial.es/be8f77e4a9d02a0a552403f67497009f/resize/828/f/jpg/assets/multimedia/imagenes/2022/11/23/16691993780157.jpg" alt="Producto 2">
            <h2>Zapatos de hombre</h2>
            <button class="details-button" onclick="toggleDetails(3)">Ver más detalles</button>
            <div class="product-details" id="details3">
                <p>Talla: 44</p>
                <p>Color: Negro</p>
                <p>Stock: Disponible</p>
                <!-- Más detalles aquí -->
            </div>
        </div>
        <!-- Agrega más elementos de carrusel según sea necesario -->
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

        // Si llegamos al final, volvemos al principio
        if (carousel.scrollLeft + carousel.clientWidth >= carousel.scrollWidth) {
            carousel.scrollTo({ left: 0, behavior: 'smooth' });
        }
    } else {
        carousel.scrollBy({ left: -scrollAmount, behavior: 'smooth' });

        // Si estamos al principio, nos movemos al final
        if (carousel.scrollLeft === 0) {
            carousel.scrollTo({ left: carousel.scrollWidth, behavior: 'smooth' });
        }
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