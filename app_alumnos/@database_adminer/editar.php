<link rel="stylesheet" href="style.css">

<?php
// Datos de Conexión
$datos_conexion = [
    'server'=> 'localhost',
    'user'  => 'root',
    'pass'  => 'root',
    'db'    => 'dicampus'
];

// Verificar si se recibió un id por GET
if (!isset($_GET['id'])) {
    echo "Error: no se ha especificado un ID de registro.";
    exit();
}

$id = $_GET['id'];
$table = $_GET['table'];

// Conexión a la base de datos
$conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

// Obtener el nombre de las columnas de la tabla
$consulta_columnas = "SHOW COLUMNS FROM $table";
$resultado_columnas = mysqli_query($conexion, $consulta_columnas);

// Crear un array con los nombres de las columnas
$nombre_columnas = array();
while ($fila_columnas = mysqli_fetch_assoc($resultado_columnas)) {
    $nombre_columnas[] = $fila_columnas['Field'];
}

// Obtener los datos del registro a editar
$consulta = "SELECT * FROM $table WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$registro = mysqli_fetch_assoc($resultado);

// Si se recibió un formulario para actualizar el registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear la consulta para actualizar los valores del registro
    $consulta_actualizar = "UPDATE $table SET ";
    $i = 0;
    foreach ($nombre_columnas as $columna) {
        $valor = $_POST[$columna];
        if ($i > 0) {
            $consulta_actualizar .= ", ";
        }
        $consulta_actualizar .= "$columna = '$valor'";
        $i++;
    }
    $consulta_actualizar .= " WHERE id = $id";

    // Actualizar el registro en la base de datos
    $resultado_actualizar = mysqli_query($conexion, $consulta_actualizar);

    // Redirigir a la página de visualización del registro actualizado
    header("Location: ver.php?id=$id&table=$table");
    exit();
}

// Mostrar el formulario para editar el registro
?>
<h1>Editar Registro de <? echo $table?></h1>
<form method="POST">
    <?php foreach ($nombre_columnas as $columna) { ?>
        <label><?php echo $columna ?>:</label>
        <input type="text" name="<?php echo $columna ?>" value="<?php echo $registro[$columna] ?>"><br>
    <?php } ?>
    <input type="hidden" name="table" value="<?php echo $table ?>">
    <input type="submit" value="Actualizar">
</form>
<?php
// Cierre de la conexión a la base de datos
mysqli_close($conexion);
?>
