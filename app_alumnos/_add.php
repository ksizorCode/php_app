<?php $titulo="Inserción de Datos"; ?>
<?php include 'fragmentos/_header.php';?>
<h1><?php echo $titulo;?></h1>

<form action="procesar_formulario.php" method="post">
  <label for="nombre">Nombre:</label>
  <input type="text" name="nombre" id="nombre" required>

  <label for="apellidos">Apellidos:</label>
  <input type="text" name="apellidos" id="apellidos" required>

  <label for="ciudad">Ciudad:</label>
  <input type="text" name="ciudad" id="ciudad" required>

  <label for="fecha_nacimiento">Fecha de nacimiento:</label>
  <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" required>

  <label for="foto">Foto:</label>
  <input type="file" name="foto" id="foto" accept="image/*" required>

  <button type="submit">Agregar alumno</button>
</form>

<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dicampus";

// Establecer la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar si se estableció la conexión correctamente
if ($conn->connect_error) {
  die("Error al conectarse a la base de datos: " . $conn->connect_error);
}

// Verificar si se enviaron los datos del formulario
if (isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["ciudad"]) && isset($_POST["fecha_nacimiento"]) && isset($_FILES["foto"])) {
  // Obtener los datos del formulario
  $nombre = $_POST["nombre"];
  $apellidos = $_POST["apellidos"];
  $ciudad = $_POST["ciudad"];
  $fecha_nacimiento = $_POST["fecha_nacimiento"];

  // Procesar la imagen del formulario
  $foto_nombre = $_FILES["foto"]["name"];
  $foto_temporal = $_FILES["foto"]["tmp_name"];
  $foto_tipo = $_FILES["foto"]["type"];

  // Mover la imagen a la carpeta "img" del servidor
  move_uploaded_file($foto_temporal, "img/" . $foto_nombre);

  // Crear la consulta SQL para insertar los datos
  $sql = "INSERT INTO alumnos (nombre, apellidos, ciudad, fecha_nacimiento, foto) 
          VALUES ('$nombre', '$apellidos', '$ciudad', '$fecha_nacimiento', '$foto_nombre')";
/*
$sql="INSERT INTO `alumnos` (`nombre`, `apellidos`, `ciudad`, `fecha_nacimiento`, `foto`)
VALUES ('asdf', 'asdf', 'asdf', '2023-11-11', 'asdf.png');"
*/

echo $sql;
  // Ejecutar la consulta SQL
  if ($conn->query($sql) === TRUE) {
    // Si la inserción se realizó correctamente, redirigir al usuario a la página de la tabla de alumnos
    header("Location: read.php");
  } else {
    // Si hubo un error en la inserción, mostrar un mensaje de error
    echo "Error al agregar el alumno: " . $conn->error;
  }
} else {
  // Si no se enviaron los datos del formulario, mostrar un mensaje de error
  echo "Error: faltan datos del formulario";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>






<?php include 'fragmentos/_footer.php';?>