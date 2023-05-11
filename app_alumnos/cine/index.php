<? include '_config.php';?>
<? include $dir_inc.'header.php';?>
<h1>Peliculinas</h1>


<?php
// Conexión a la base de datos
$conexion = mysqli_connect($server, $user, $pass, $db);

// Consulta para obtener todas las películas
$consulta = "SELECT p.id, p.titulo, p.poster, d.nombre AS director, g.nombre AS genero
             FROM peliculas p
             JOIN directores d ON p.director_id = d.id
             JOIN generos g ON p.genero_id = g.id
             ORDER BY p.id ASC";

$resultado = mysqli_query($conexion, $consulta);

// Comprobar si hay resultados
if (mysqli_num_rows($resultado) > 0) {
    // Imprimir la lista de películas
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<div>";
        echo "<h3>" . $fila["titulo"] . "</h3>";
        echo "<img src='" . $fila["poster"] . "' alt='" . $fila["titulo"] . "'>";
        echo "<p>Director: " . $fila["director"] . "</p>";
        echo "<p>Género: " . $fila["genero"] . "</p>";
        echo "</div>";
    }
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>







<? include $dir_inc.'footer.php';?>
