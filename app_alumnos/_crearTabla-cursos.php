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
$sql = "CREATE TABLE IF NOT EXISTS cursos (
  id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  ref VARCHAR(255) NOT NULL,
  lugar VARCHAR(255) NOT NULL,
  fecha_comienzo DATE NOT NULL,
  fecha_fin DATE NOT NULL,
  texto LONGTEXT NOT NULL,
  img VARCHAR(255) NOT NULL
)";

// Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
    echo '<div class="alert">Tabla "cursos" dentro de la base de datos "dicampus" se ha creado correctamente, o ya existía.</div> <a href="install.php">Volver al index</a>';
} else {
  echo "Error al crear la tabla: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

<p>Siguiente paso:</p>
<a href="_crearDatos-cursos.php" class="btn">Llenar Tabla de datos</a>

<?php include 'fragmentos/_footer.php';?>