<?php $titulo="Insertarción de datos" ?>
<?php include 'fragmentos/_header.php';?>


<?php

// Obtener datos POST en caso de que existan
if (isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['ciudad']) && isset($_POST['fnacim']) && isset($_POST['foto'])) {
  $nombre     = $_POST['nombre'];
  $apellidos  = $_POST['apellidos'];
  $ciudad     = $_POST['ciudad'];
  $fnacim     = $_POST['fnacim'];
  $foto       = $_POST['foto'];
 
  if (strlen($nombre) > 0 && strlen($apellidos) > 0 && strlen($ciudad) > 0 && strlen($fnacim) > 0 && strlen($foto) > 0) {
    // procesar los datos recibidos





  //Si hay datos conectarse a la base de datos
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


  // Consulta SQL para obtener los datos de la tabla "alumnos"
  $sql = "INSERT INTO alumnos (nombre, apellidos, ciudad, fecha_nacimiento, foto)
  VALUES ('$nombre','$apellidos','$ciudad','$fnacim','$foto');";
// echo $sql;

  // Ejecutar la consulta SQL
  $resultado = $conn->query($sql);

  //Mostramos lo insertado en una mini-ficha:
  ?>


  <div class="ficha">
  <div class="foto">
  <img src='img/<? echo $foto;?>'>
  </div>

  <div class="datos">
    <h1><span><?echo $nombre."</span> ".$apellidos; ?></h1>
    
    <p><span>Fecha Nacimiento:</span> <? echo $fnacim;?></p>
    <p><span>Ciudad:</span> <? echo $ciudad;?></p>
    <p><span>Edad:</span> <? echo obtener_edad_segun_fecha($fnacim);?></p>

  </div>
  </div>

<?php
  // Cerrar la conexión
  $conn->close();

} else {
  // mostrar un mensaje de error si alguno de los campos está vacío
 echo "Los datos del formulario están incompletos";
}


  } //fin de la comprobación if isset POST
  




  //Si no se da ese caso, significará que no hay datos POST
  // Por lo que mostramos el Formulario
  else {
?>


<h1>Insertar Datos de Alumno</h1>
<form action="" method="post">
  <div class="grid">
  <label for="nom">Nombre:</label>
  <input id="nom" type="text" name="nombre">

  <label for="ape">Apellidos:</label>
  <input id="ape" type="text" name="apellidos">

  <label for="city">Ciudad:</label>
  <input id="city" type="text" name="ciudad">

  <label for="fnacim">Nacimiento:</label>
  <input id="fnacim" type="date" name="fnacim">

  <label for="foto">Foto:</label>
  <input id="foto" type="text" name="foto">
  </div>

  <input type="submit" value="Guardar datos de Alumno" class="active">

</form>



<?php 


  } // fin de else

  include 'fragmentos/_footer.php';?>