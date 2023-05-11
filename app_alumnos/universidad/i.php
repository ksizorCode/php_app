<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "root";
$database = "universidad";
$conexion = mysqli_connect($servidor, $usuario, $password);

// Verificar si la conexión es exitosa
if (!$conexion) { die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());}

// Eliminar Base de datos anterior
$sql = "DROP DATABASE IF EXISTS $database";
mysqli_query($conexion, $sql);

// Crear base de datos
$sql = "CREATE DATABASE IF NOT EXISTS $database";
mysqli_query($conexion, $sql);

// Seleccionar la base de datos
mysqli_select_db($conexion, $database);

// Crear Tabla Estudiantes
$sql = "CREATE TABLE IF NOT EXISTS estudiantes(
    id bigint unsigned not null primary key auto_increment,
    nombre varchar(255) not null,
    grupo varchar(255) not null
)";
mysqli_query($conexion, $sql);

// Crear Tabla Materias
$sql = "CREATE TABLE IF NOT EXISTS materias(
    id bigint unsigned not null primary key auto_increment,
    nombre varchar(255) not null
)";
mysqli_query($conexion, $sql);

// Crear Tabla de relaciones
$sql = "CREATE TABLE IF NOT EXISTS notas_estudiantes_materias(
    id bigint unsigned not null primary key auto_increment,
    id_estudiante bigint unsigned not null,
    id_materia bigint unsigned not null,
    puntaje decimal(9,2) not null,
    foreign key (id_estudiante) references estudiantes(id) on delete cascade on update cascade,
    foreign key (id_materia) references materias(id) on delete cascade on update cascade
)";
mysqli_query($conexion, $sql);

// Insertar datos en la tabla de estudiantes
$sql = "INSERT INTO estudiantes (nombre, grupo)
        VALUES
        ('Juan', 'A'),
        ('Pedro', 'B'),
        ('María', 'C'),
        ('Ana', 'A')";
mysqli_query($conexion, $sql);

// Insertar datos en la tabla de materias
$sql = "INSERT INTO materias (nombre)
        VALUES
        ('Matemáticas'),
        ('Historia'),
        ('Ciencias'),
        ('Literatura')";
mysqli_query($conexion, $sql);

// Insertar datos en la tabla de notas_estudiantes_materias
$sql = "INSERT INTO notas_estudiantes_materias (id_estudiante, id_materia, puntaje)
        VALUES
        (1, 1, 8.5),
        (1, 2, 7.0),
        (1, 3, 9.2),
        (2, 1, 6.0),
        (2, 2, 7.5),
        (2, 4, 8.0),
        (3, 3, 9.5),
        (3, 4, 7.8),
        (4, 1, 8.0),
        (4, 2, 9.0),
        (4, 4, 7.5)";
mysqli_query($conexion, $sql);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
