<link rel="stylesheet" href="style.css">

<?php
// Datos de Conexión
$datos_conexion = ['server'=>'localhost','user'=>'root','pass'=>'root','db'=>'dicampus'];

// Conexión a la base de datos
$conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

if (isset($_GET['table'])) {
    $table = $_GET['table'];

    // Obtener la lista de columnas (excluyendo 'id')
    $consulta_columnas = "SHOW COLUMNS FROM $table";
    $resultado_columnas = mysqli_query($conexion, $consulta_columnas);
    $columnas = [];
    while ($fila_columnas = mysqli_fetch_assoc($resultado_columnas)) {
        if ($fila_columnas['Field'] !== 'id') {
            $columnas[] = $fila_columnas['Field'];
        }
    }

    // Procesar el formulario cuando se envía
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $valores = [];
        foreach ($columnas as $columna) {
            $valores[] = "'" . mysqli_real_escape_string($conexion, $_POST[$columna]) . "'";
        }
        $columnas_str = implode(', ', $columnas);
        $valores_str = implode(', ', $valores);

        // Insertar el registro en la base de datos
        $consulta_insertar = "INSERT INTO $table ($columnas_str) VALUES ($valores_str)";
        if (mysqli_query($conexion, $consulta_insertar)) {
            // Redirigir a la página principal
            header("Location: index.php?table=$table");
        } else {
            echo "Error al insertar el registro: " . mysqli_error($conexion);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insertar Registro</title>
</head>
<body>
    <h1>Insertar Registro en <?php echo $table; ?></h1>
    <form method="post">
        <?php foreach ($columnas as $columna): ?>
            <label for="<?php echo $columna; ?>"><?php echo $columna; ?>:</label>
            <input type="text" name="<?php echo $columna; ?>" id="<?php echo $columna; ?>" required>
            <br>
        <?php endforeach; ?>
        <input type="submit" value="Insertar Registro">
    </form>
    <a href="index.php?table=<?php echo $table; ?>">Volver a la página principal</a>
</body>
</html>

<?php
} else {
    echo "Parámetro inválido.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
