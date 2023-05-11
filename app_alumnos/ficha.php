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

// Obtener el id actual de la fila
if (isset($_GET['id'])) {
  $id = $_GET['id'];
}
else {
  $id = 1;
}



// Obtener el número total de filas
$sql_count = "SELECT COUNT(*) as count FROM alumnos";
$result_count = $conn->query($sql_count);
$count = $result_count->fetch_assoc()['count'];

// Consulta SQL para obtener los datos de la tabla "alumnos"
$sql = "SELECT id, nombre, apellidos, ciudad, fecha_nacimiento, foto FROM alumnos WHERE id=$id";
// Ejecutar la consulta SQL
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
 
  // Recorrer los resultados y mostrarlos
  while($fila = $resultado->fetch_assoc()) {

?>
<?php $titulo=$fila["nombre"]." ".$fila["apellidos"]." ficha."; ?>
<?php include 'fragmentos/_header.php';?>


<div class="ficha">
<div class="foto">
 <img src='img/<? echo $fila["foto"];?>'>
</div>

<div class="datos">
  <h1><span><?echo $fila["nombre"]."</span> ".$fila["apellidos"]; ?></h1>
  
  <p><span>Fecha Nacimiento:</span> <? echo $fila["fecha_nacimiento"];?></p>
  <p><span>Ciudad:</span> <? echo $fila["ciudad"];?></p>
  <p><span>Edad:</span> <? echo obtener_edad_segun_fecha($fila["fecha_nacimiento"]);?></p>
  <p><span>ID:</span> <? echo $fila["id"];?></p>

</div>

<?php
  }
  
} else {
  echo "No se encontraron resultados";
}
?>

</div>
<div class="botonera">

<?php
// Comprobar si hay una fila anterior
$prev_id = $id - 1;
$sql_prev = "SELECT id FROM alumnos WHERE id=$prev_id";
$result_prev = $conn->query($sql_prev);
if ($result_prev->num_rows > 0) {
  echo "<a href='?id=$prev_id'><button>Anterior</button></a>";
}

// Cargar la siguiente fila disponible
$next_id = $id + 1;
$sql_next = "SELECT id FROM alumnos WHERE id=$next_id";
$result_next = $conn->query($sql_next);
while ($result_next->num_rows == 0 && $next_id <= $count) {
  $next_id++;
  $sql_next = "SELECT id FROM alumnos WHERE id=$next_id";
  $result_next = $conn->query($sql_next);
}
if ($next_id <= $count) {
  echo "<a href='?id=$next_id'><button>Siguiente</button></a>";
}

// Cerrar la conexión
$conn->close();
?>
</div>


<?php include 'fragmentos/_footer.php';?>