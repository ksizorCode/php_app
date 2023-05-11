<?php $titulo="Borrar Base de Datos"; ?>
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

// Consulta SQL para borrar la base de datos "dicampus" y todo su contenido
$sql = "DROP DATABASE IF EXISTS dicampus";

// Ejecutar la consulta SQL
if ($conn->query($sql) === TRUE) {
  echo "<div class='alert'>Base de datos 'dicampus' eliminada correctamente</div>";
} else {
  echo "Error al eliminar la base de datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

<a href="install.php" class="btn">Ir a Instalar</a>
<p>para volver a instalar con los valores de fábrica.</p>

