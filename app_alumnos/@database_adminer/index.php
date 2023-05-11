
    <link rel="stylesheet" href="style.css">

<?php

// Datos de Conexión
$datos_conexion = ['server'=>'localhost','user'=>'root','pass'=>'root','db'=>'dicampus'];



// Conexión a la base de datos
$conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

// Obtener la lista de tablas en la base de datos
$consulta_tablas = "SHOW TABLES";
$resultado_tablas = mysqli_query($conexion, $consulta_tablas);

// Construir el menú desplegable (select) con la lista de tablas
echo "<form method='get'>";
echo "<label for='tabla'>Selecciona una tabla:</label>";
echo "<select name='table' id='tabla'>";

while ($fila_tablas = mysqli_fetch_row($resultado_tablas)) {
    $nombre_tabla = $fila_tablas[0];
    echo "<option value='$nombre_tabla'>$nombre_tabla</option>";
}
echo "</select>";
echo "<input type='submit' value='Cargar Tabla'>";
echo "<form>";

echo "<a href='crear_tabla.php'>Crear Nueva Tabla</a>";












function mostrar_tabla_mysql($nombre_tabla) {
    global $datos_conexion;
    $conexion = mysqli_connect($datos_conexion['server'],$datos_conexion['user'],$datos_conexion['pass'],$datos_conexion['db']);
    $consulta_columnas = "SHOW COLUMNS FROM $nombre_tabla";
    $resultado_columnas = mysqli_query($conexion,$consulta_columnas);
    $nombre_columnas = array();
    while ($fila_columnas = mysqli_fetch_assoc($resultado_columnas)) {$nombre_columnas[] = $fila_columnas['Field'];}
    $consulta_registros = "SELECT * FROM $nombre_tabla";
    $resultado_registros = mysqli_query($conexion,$consulta_registros);

    echo "<h1>$nombre_tabla</h1><table><thead><tr>";
    echo "<a href='insertar.php?table=".$nombre_tabla."'>Insertar Nuevo Registro</a>";
    foreach ($nombre_columnas as $columna) {echo "<th>$columna</th>";}
    echo "<th>Acciones</th></tr></thead><tbody>";
    while ($fila_registros = mysqli_fetch_assoc($resultado_registros)) {
        echo "<tr>";
        foreach ($nombre_columnas as $columna) {
            if (in_array($columna, ['img', 'imagen', 'foto', 'portada', 'poster'])) {
                echo "<td><img src='../img/" . $fila_registros[$columna] . "' width='30'></td>";
            } else {
                echo "<td>" . $fila_registros[$columna] . "</td>";
            }
        }
       // echo "<td><a href='ver.php?id=".$fila_registros['id']."&table=".$nombre_tabla."'>Ver</a> <a href='editar.php?id=" . $fila_registros['id'] . "&table=".$nombre_tabla."'>Editar</a> <a href='borrar.php?id=".$fila_registros['id']."&table=".$nombre_tabla."'>x</a></td>";
       echo "<td><a href='ver.php?id=".$fila_registros['id']."&table=".$nombre_tabla."'>Ver</a> <a href='editar.php?id=" . $fila_registros['id'] . "&table=".$nombre_tabla."'>Editar</a> <a href='borrar.php?id=".$fila_registros['id']."&table=".$nombre_tabla."'>x</a> <a href='duplicar.php?id=".$fila_registros['id']."&table=".$nombre_tabla."'>Duplicar</a></td>";

        echo "</tr>";
    }
    echo "</tbody></table>";
    mysqli_close($conexion);
}



if(isset($_GET['table'])){
    $table = $_GET['table'];
    mostrar_tabla_mysql($table);

}
else{
mostrar_tabla_mysql("alumnos");
}




