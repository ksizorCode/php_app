<?php $titulo="Instalación de Base de Datos"; ?>
<?php include 'fragmentos/_header.php';?>
<h1><?php echo $titulo;?></h1>


<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar si hay errores de conexión
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS dicampus";
if ($conn->query($sql) === TRUE) {
  echo '<div class="alert">Base de datos "dicampus" se ha creado correctamente, o ya existía.</div> <a href="install.php">Volver al index</a>';
} else {
  echo "Error creando la base de datos: " . $conn->error;
}
// Cerrar la conexión
$conn->close();

?>
<p>Siguiente paso:</p>
<a href="_crearTabla.php" class="btn">Crear Tabla alumnos</a>

<?php include 'fragmentos/_footer.php';?>

