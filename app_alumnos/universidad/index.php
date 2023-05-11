<?php

function ejecutarConsulta($consulta) {
    // Conexión a la base de datos
    $host = "localhost";
    $user = "root";
    $password = "root";
    $database = "universidad";

    $conn = mysqli_connect($host, $user, $password, $database);

    // Ejecutar la consulta SQL
    $resultado = mysqli_query($conn, $consulta);

    // Crear un array asociativo con los resultados de la consulta
    $filas = array();
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $filas[] = $fila;
        }
    }

    // Cerrar la conexión a la base de datos y devolver el array de resultados
    mysqli_close($conn);
    return $filas;
}






// Ejemplo de uso de la función ejecutarConsulta
$consulta = "SELECT * FROM estudiantes";
$resultado = ejecutarConsulta($consulta);
if (count($resultado) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Grupo</th></tr>";
    foreach ($resultado as $fila) {
        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["grupo"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}



// Ejemplo de uso de la función ejecutarConsulta
$consulta = "SELECT * FROM materias";
$resultado = ejecutarConsulta($consulta);
if (count($resultado) > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th></tr>";
    foreach ($resultado as $fila) {
        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}



// Ejemplo de uso de la función ejecutarConsulta
$consulta = "SELECT * FROM notas_estudiantes_materias";
$resultado = ejecutarConsulta($consulta);
if (count($resultado) > 0) {
    //echo print_r($resultado);

    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th></tr>";
    foreach ($resultado as $fila) {
        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["id_estudiante"] . "</td>";
        echo "<td>" . $fila["id_materia"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}






// Ejemplo de uso de la función ejecutarConsulta
$consulta = "SELECT estudiantes.nombre as estudiante, materias.nombre as materia, notas_estudiantes_materias.puntaje
FROM notas_estudiantes_materias
INNER JOIN estudiantes ON estudiantes.id = notas_estudiantes_materias.id_estudiante
INNER JOIN materias ON materias.id = notas_estudiantes_materias.id_materia
WHERE materias.nombre = 'matemáticas'";
$resultado = ejecutarConsulta($consulta);
if (count($resultado) > 0) {

   // echo print_r($resultado);
    echo "<table>";
    echo "<tr><th>Estudiante</th><th>Materia</th><th>Nota</th></tr>";
    foreach ($resultado as $fila) {
        echo "<tr>";
        echo "<td>" . $fila["estudiante"] . "</td>";
        echo "<td>" . $fila["materia"] . "</td>";
        echo "<td>" . $fila["puntaje"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

