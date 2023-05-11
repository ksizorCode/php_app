<?php
// Datos de Conexión
$datos_conexion = ['server'=>'localhost','user'=>'root','pass'=>'root','db'=>'dicampus'];

// Conexión a la base de datos
$conexion = mysqli_connect($datos_conexion['server'], $datos_conexion['user'], $datos_conexion['pass'], $datos_conexion['db']);

// Comprobar si se recibieron los parámetros id y table
if (isset($_GET['id']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $table = $_GET['table'];

    // Obtener el registro a duplicar
    $consulta_registro = "SELECT * FROM $table WHERE id = $id";
    $resultado_registro = mysqli_query($conexion, $consulta_registro);
    $registro = mysqli_fetch_assoc($resultado_registro);

    if ($registro) {
        // Duplicar el registro
        // Primero, obtener los nombres de las columnas
        $consulta_columnas = "SHOW COLUMNS FROM $table";
        $resultado_columnas = mysqli_query($conexion, $consulta_columnas);
        $columnas = [];
        while ($fila_columnas = mysqli_fetch_assoc($resultado_columnas)) {
            if ($fila_columnas['Field'] !== 'id') { // Excluir la columna 'id'
                $columnas[] = $fila_columnas['Field'];
            }
        }

        // Construir la consulta de inserción
        $columnas_str = implode(', ', $columnas);
        $valores = [];
        foreach ($columnas as $columna) {
            $valores[] = "'" . mysqli_real_escape_string($conexion, $registro[$columna]) . "'";
        }
        $valores_str = implode(', ', $valores);
        $consulta_duplicar = "INSERT INTO $table ($columnas_str) VALUES ($valores_str)";

        // Ejecutar la consulta de inserción
        if (mysqli_query($conexion, $consulta_duplicar)) {
            // Redirigir a la página principal
            header("Location: index.php?table=$table");
        } else {
            echo "Error al duplicar el registro: " . mysqli_error($conexion);
        }
    } else {
        echo "Registro no encontrado.";
    }
} else {
    echo "Parámetros inválidos.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
