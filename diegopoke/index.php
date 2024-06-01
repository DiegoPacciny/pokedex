<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POKEDEX</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="icon" href="img/logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="titulo-inicial">
</div>
    <div class="todo">
        <form action="" method="GET">
            <input type="hidden" name="content"
                value="<?php echo isset($_GET['content']) ? htmlspecialchars($_GET['content']) : 'pokemon'; ?>">
            <input type="text" name="search" placeholder="Encuentra tu pokemon!" class="busquedad"
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <select name="order_by" class="selector">
                <option value="id_asc" <?php echo isset($_GET['order_by']) && $_GET['order_by'] == 'id_asc' ? 'selected' : ''; ?>>Número menor</option>
                <option value="id_desc" <?php echo isset($_GET['order_by']) && $_GET['order_by'] == 'id_desc' ? 'selected' : ''; ?>>Número mayor</option>
                <option value="name_asc" <?php echo isset($_GET['order_by']) && $_GET['order_by'] == 'name_asc' ? 'selected' : ''; ?>>A-Z</option>
                <option value="name_desc" <?php echo isset($_GET['order_by']) && $_GET['order_by'] == 'name_desc' ? 'selected' : ''; ?>>Z-A</option>
            </select>
            <button  class="botonnn">Encontrar</button>
            <div>

            <div class="elegir">
                <a href="?content=pokemon" class="pokemon">POKEMONES</a>
                <a href="?content=trainers" class="pokemon">ENTRENADORES</a>
</div>

        </div>
        </form>
        
    </div>

        <?php
        if (isset($_GET['content'])) {
            $content = $_GET['content'];
            if ($content === 'pokemon') {
                include 'pokemons.php';
            } elseif ($content === 'trainers') {
                include 'pokemons.php';
            } else {
                echo 'error';
            }
        } else {
            include 'pokemons.php';
        }
        ?>
    

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const images = document.querySelectorAll(".pokemon-image img");

            const options = {
                root: null,
                rootMargin: "0px",
                threshold: 0.1
            };

            const observer = new IntersectionObserver(function (entries, observer) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        const src = img.dataset.src;
                        img.src = src;
                        observer.unobserve(img);
                    }
                });
            }, options);

            images.forEach(image => {
                observer.observe(image);
            });
        });
    </script>
</body>

</html>