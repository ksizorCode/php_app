<link rel="stylesheet" href="style.css">

<?php
// Datos de Conexión
$datos_conexion = ['server'=>'localhost','user'=>'root','pass'=>'root','db'=>'dicampus'];

// Conexión a la base de datos
$conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_tabla = $_POST['nombre_tabla'];
    $cantidad_columnas = intval($_POST['cantidad_columnas']);

    // Construir la consulta de creación de tabla
    $consulta_crear_tabla = "CREATE TABLE $nombre_tabla (id INT AUTO_INCREMENT PRIMARY KEY";
    for ($i = 1; $i <= $cantidad_columnas; $i++) {
        $nombre_columna = $_POST["nombre_columna_$i"];
        $tipo_dato = $_POST["tipo_dato_$i"];
        $consulta_crear_tabla .= ", $nombre_columna $tipo_dato";
    }
    $consulta_crear_tabla .= ")";

    // Ejecutar la consulta de creación de tabla
    if (mysqli_query($conexion, $consulta_crear_tabla)) {
        // Redirigir a la página principal
        header("Location: index.php");
    } else {
        echo "Error al crear la tabla: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Tabla</title>
</head>
<body>
    <h1>Crear Tabla</h1>
    <form method="post">
        <label for="nombre_tabla">Nombre de la tabla:</label>
        <input type="text" name="nombre_tabla" id="nombre_tabla" required>
        <br>
        <label for="cantidad_columnas">Cantidad de columnas:</label>
        <input type="number" name="cantidad_columnas" id="cantidad_columnas" min="1" required>
        <p>La columan id autoicremental se generará automáticamente</p>
        <br>
        <div id="columnas"></div>
        <input type="submit" value="Crear Tabla">
    </form>
    <a href="index.php">Volver a la página principal</a>

    <script>
        const cantidadColumnasInput = document.getElementById('cantidad_columnas');
        const columnasDiv = document.getElementById('columnas');

        cantidadColumnasInput.addEventListener('change', () => {
            columnasDiv.innerHTML = '';
            const cantidadColumnas = parseInt(cantidadColumnasInput.value);
            for (let i = 1; i <= cantidadColumnas; i++) {
                columnasDiv.innerHTML += `
                    <label for="nombre_columna_${i}">Nombre de la columna ${i}:</label>
                    <input type="text" name="nombre_columna_${i}" id="nombre_columna_${i}" required>
                    <label for="tipo_dato_${i}">Tipo de dato:</label>
                    <select name="tipo_dato_${i}" id="tipo_dato_${i}" required>
                        <option value="INT">INT</option>
                        <option value="VARCHAR(255)">VARCHAR(255)</option>
                        <option value="TEXT">TEXT</option>
                        <option value="DATE">DATE</option
                    </select>
                <br>
            `;
        }
    });
</script>
</body>
</html>
<?php
// Cerrar la conexión
mysqli_close($conexion);
?>