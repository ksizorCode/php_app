<?php
// Datos de Conexión
$datos_conexion = [
    'server'=> 'localhost',
    'user'  => 'root',
    'pass'  => 'root',
    'db'    => 'dicampus'
];


function consultar_db($consulta) {
    global $datos_conexion;

    // Conexión a la base de datos
    $conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

    // Consulta SQL para obtener los datos
    $resultado = mysqli_query($conexion, $consulta);

    // Creación de un array con los datos
    $datos = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $datos[] = $fila;
    }

    // Cierre de la conexión a la base de datos
    mysqli_close($conexion);

    return $datos;
}

function montar_tabla($datos_tabla) {
    // Descomponer array
    $nombre_tabla = $datos_tabla['nombre'];
    $columnas = $datos_tabla['columnas'];
    #$consulta = $datos_tabla['consulta'];
    $consulta = "SELECT * FROM $nombre_tabla";

    // Obtener los datos de la base de datos
    $datos = consultar_db($consulta);

    // Creación de la tabla
    echo "<h1>".$nombre_tabla."<h1>";

    // Creación de la tabla
    echo "<table>";
    echo "<thead><tr>";
    foreach ($columnas as $columna => $tipo) {
        echo "<th>$columna</th>";
    }
    echo "</tr></thead>";

    echo "<tbody>";
    foreach ($datos as $fila) {
        echo "<tr>";
        foreach ($columnas as $columna => $tipo) {
            if ($tipo == 'img') {
                echo "<td><img src='img/" . $fila[$columna] . "' width='40'></td>";
            } else {
                echo "<td>" . $fila[$columna] . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

// Ejemplo de uso con un array multidimensional
$datos_tabla = array(
    "nombre" => "alumnos",
    "columnas" => array(
        "id" => "number",
        "foto" => "img",
        "nombre" => "text",
        "apellidos" => "text",
        "ciudad" => "text",
        "fecha_nacimiento" => "date"
    )
    //"consulta" => "SELECT * FROM alumnos"
);
montar_tabla($datos_tabla);
?>
