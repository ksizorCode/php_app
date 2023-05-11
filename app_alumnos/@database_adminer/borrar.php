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

// Obtener la información del registro a eliminar
$consulta = "SELECT * FROM $table WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$registro = mysqli_fetch_assoc($resultado);

// Verificar si se eliminó el registro
if (isset($_POST['confirmado'])) {
    $consulta_eliminar = "DELETE FROM $table WHERE id = $id";
    $resultado_eliminar = mysqli_query($conexion, $consulta_eliminar);

    if ($resultado_eliminar) {
        echo "El registro se ha eliminado correctamente. <a href='index.php'>Volver a Lista</a>";
    } else {
        echo "Error: no se pudo eliminar el registro.";
    }
} else {
    echo "<p>¿Está seguro de que desea eliminar el siguiente registro?</p>";
    echo "<p><strong>id:</strong> " . $registro['id'] . "</p>";
    echo "<form method='post'>";
    echo "<input type='submit' name='confirmado' value='Sí'>";
    echo "<a href='index.php'>No</a>";
    echo "</form>";
}

// Cierre de la conexión a la base de datos
mysqli_close($conexion);
?>
