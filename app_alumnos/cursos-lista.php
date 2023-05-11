<?php $titulo="Cursos en vista de Retícula:"; ?>
<?php include 'fragmentos/_header.php';?>

<header>
<h1><?php echo $titulo;?></h1>
  <a href="cursos-reticula.php" class="btn">Ver en Modo Retícula</a>
</header>

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

// Consulta SQL para obtener los datos de la tabla "alumnos"
$sql = "SELECT * FROM cursos";

// Ejecutar la consulta SQL
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
?>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar.." title="Escriba el valor a buscar">

<div class="grid-cursos" id="myTable">
<?php
 
  // Recorrer los resultados y mostrarlos
  while($fila = $resultado->fetch_assoc()) {

?>


<div class="ficha">
<div class="foto">
 <img src='img/cursos-img/<? echo $fila["img"];?>'>
</div>

<div class="datos">
  <p><? echo $fila["ref"];?> <span><? echo $fila["id"];?></span></p>
  <h3><span><?echo $fila["nombre"]?></h3>
  <p><span>del</span> <? echo fechaBonita($fila["fecha_comienzo"]);?> <span>al</span> <? echo fechaBonita($fila["fecha_fin"]);?></p>
  <p><span>en:</span> <? echo $fila["lugar"];?></p>
  <a class="btn" href='curso-ficha.php?id=<? echo $fila["id"]?>'>Ver Ficha</a>

</div>
</div> <!-- ficha -->
<?php
  } //end while
  
} else {
  echo "No se encontraron resultados";
}




// Cerrar la conexión
$conn->close();
?>
</div> <!-- grid-cursos -->




<script>
  //Buscador 
  function myFunction() {
  var input, filter, container, fichas, i, j, existe, datos, textoFicha;
  input = document.getElementById("myInput");
  filter = input.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
  container = document.getElementById("myTable");
  fichas = container.getElementsByClassName("ficha");
  
  for (i = 0; i < fichas.length; i++) {
    datos = fichas[i].getElementsByClassName("datos")[0].getElementsByTagName("p");
    textoFicha = fichas[i].innerText.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    existe = false;
    if (textoFicha.indexOf(filter) > -1) {
      existe = true;
    }
    if (existe) {
      fichas[i].style.display = "";
    } else {
      fichas[i].style.display = "none";
    }
  }
}




//--- Ordenar por título
let sortOrder = 1; // 1 for ascending, -1 for descending
let sortColumn = null;

function sortTable(colIndex) {
  const table = document.getElementById("myTable");
  const tbody = table.getElementsByTagName("tbody")[0];
  const rows = tbody.getElementsByTagName("tr");
  const sortedRows = Array.from(rows);

  sortedRows.sort((a, b) => {
    let aCol = a.getElementsByTagName("td")[colIndex].textContent.trim();
    let bCol = b.getElementsByTagName("td")[colIndex].textContent.trim();
    if (colIndex === 0) { // ID column
      aCol = parseInt(aCol, 10);
      bCol = parseInt(bCol, 10);
    } else { // other columns
      aCol = aCol.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
      bCol = bCol.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
    }
    if (aCol === bCol) {
      return 0;
    }
    return aCol > bCol ? sortOrder : -sortOrder;
  });

  for (let row of sortedRows) {
    tbody.appendChild(row);
  }

  // update arrow direction
  const arrow = document.getElementById(`arrow${colIndex}`);
  if (sortOrder === 1) {
    arrow.innerText = "▲";
  } else {
    arrow.innerText = "▼";
  }

  // reverse sort order for next click
  if (colIndex === sortColumn) {
    sortOrder = -sortOrder;
  } else {
    sortOrder = 1;
    sortColumn = colIndex;
  }
}




</script>

<?php include 'fragmentos/_footer.php';?>