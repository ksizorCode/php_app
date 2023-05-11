<?php

// Datos de Conexión
$datos_conexion = [
    'server'=> 'localhost',
    'user'  => 'root',
    'pass'  => 'root',
    'db'    => 'dicampus'
];

function mostrar_tabla_mysql($nombre_tabla) {
    global $datos_conexion;
     // Conexión a la base de datos
     $conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

    // Obtener el nombre de las columnas
    $consulta_columnas = "SHOW COLUMNS FROM $nombre_tabla";
    $resultado_columnas = mysqli_query($conexion, $consulta_columnas);

    // Crear un array con el nombre de las columnas
    $nombre_columnas = array();
    while ($fila_columnas = mysqli_fetch_assoc($resultado_columnas)) {
        $nombre_columnas[] = $fila_columnas['Field'];
    }

    // Obtener todos los registros
    $consulta_registros = "SELECT * FROM $nombre_tabla";
    $resultado_registros = mysqli_query($conexion, $consulta_registros);

    // Crear la tabla en HTML
    echo "<h1>$nombre_tabla</h1>";
    echo "<table>";
    echo "<thead><tr>";
    foreach ($nombre_columnas as $columna) {
        echo "<th>$columna</th>";
    }
    echo "</tr></thead>";
    echo "<tbody>";
    while ($fila_registros = mysqli_fetch_assoc($resultado_registros)) {
        echo "<tr>";
        foreach ($nombre_columnas as $columna) {
            echo "<td>" . $fila_registros[$columna] . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    // Cierre de la conexión a la base de datos
    mysqli_close($conexion);
}

// Ejemplo de uso
mostrar_tabla_mysql("alumnos");
?>
