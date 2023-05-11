<?php $titulo="Instalación de Tabla"; ?>
<?php include 'fragmentos/_header.php';?>
<h1><?php echo $titulo;?></h1>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dicampus";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para crear la tabla "alumnos" si no existe previamente
$sql = "CREATE TABLE IF NOT EXISTS alumnos (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    ciudad VARCHAR(30) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    foto VARCHAR(100) NOT NULL
  )";

// Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
    echo '<div class="alert">Tabla "alumnos" dentro de la base de datos "dicampus" se ha creado correctamente, o ya existía.</div> <a href="install.php">Volver al index</a>';
} else {
  echo "Error al crear la tabla: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

<p>Siguiente paso:</p>
<a href="_crearDatos.php" class="btn">Llenar Tabla de datos</a>

<?php include 'fragmentos/_footer.php';?>