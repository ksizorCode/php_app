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
$consulta_columnas = "SHOW COLUMNS FROM $table ";
$resultado_columnas = mysqli_query($conexion, $consulta_columnas);

// Crear un array con los nombres de las columnas
$nombre_columnas = array();
while ($fila_columnas = mysqli_fetch_assoc($resultado_columnas)) {
    $nombre_columnas[] = $fila_columnas['Field'];
}

// Obtener los datos del registro a visualizar
$consulta = "SELECT * FROM $table  WHERE id = $id";
$resultado = mysqli_query($conexion, $consulta);
$registro = mysqli_fetch_assoc($resultado);

// Mostrar la información detallada del registro
foreach ($nombre_columnas as $columna) {
    if (in_array($columna, array("nombre", "título", "producto", "curso", "centro", "profesor")) && isset($registro[$columna])) {
        echo "<h1>Datos de: " . $registro[$columna] . "</h1>";
    }
}

if (!isset($registro['nombre']) && !isset($registro['título']) && !isset($registro['producto']) && !isset($registro['curso']) && !isset($registro['centro']) && !isset($registro['profesor'])) {
    echo "<h1>Detalle del registro</h1>";
}

foreach ($nombre_columnas as $columna) {
    if (in_array($columna, array("img", "imagen", "portada", "poster", "foto")) && isset($registro[$columna])) {
        echo "<p><strong>" . ucfirst($columna) . ":</strong></p>";
        echo "<img src='../img/" . $registro[$columna] . "'>";
    } else {
        echo "<p><strong>" . ucfirst($columna) . ":</strong> " . $registro[$columna] . "</p>";
    }
}

// Cierre de la conexión a la base de datos
mysqli_close($conexion);

echo "<a href='index.php'><button>Volver a Lista</button></a>";
echo "<a href='editar.php?id=".$id."&table=".$table."'><button>Editar</button></a>";
?>