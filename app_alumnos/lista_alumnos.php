<?php $titulo="Alumnos"; ?>
<?php include 'fragmentos/_header.php';?>


<header>
<h1><?php echo $titulo;?></h1>
  <a href="insertar.php" class="btn">Insertar Alumnos</a>
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
$sql = "SELECT id, nombre, apellidos, ciudad, fecha_nacimiento, foto FROM alumnos";

// Ejecutar la consulta SQL
$resultado = $conn->query($sql);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
?>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar.." title="Escriba el valor a buscar">

<?php
  // Crear la tabla HTML
  echo '<table id="myTable">
  <thead>

        <tr class="header">
        <th onclick="sortTable(0)"><span id="arrow0"></span>ID</th>
        <th>Foto</th>
        <th onclick="sortTable(2)"><span id="arrow2"></span>Nombre</th>
        <th onclick="sortTable(3)"><span id="arrow3"></span>Apellidos</th>
        <th onclick="sortTable(4)"><span id="arrow4"></span>Ciudad</th>
        <th onclick="sortTable(5)"><span id="arrow5"></span>Fecha nacim.</th>
        <th onclick="sortTable(6)"><span id="arrow6"></span>Edad</th>
          <th>Ver</th>
        </tr>
        </thead>
        <tbody>

      ';
  
  // Recorrer los resultados y mostrarlos en la tabla HTML
  while($fila = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>" . $fila["id"] . "</td>
            <td><img src='img/" . $fila["foto"] . "'></td>
            <td>" . $fila["nombre"] . "</td>
            <td>" . $fila["apellidos"] . "</td>
            <td>" . $fila["ciudad"] . "</td>
            <td>" . $fila["fecha_nacimiento"] . "</td>
            <td>" . obtener_edad_segun_fecha($fila["fecha_nacimiento"]) . "</td>
            <td> <a href='ficha.php?id=" . $fila["id"] . "'>Ver ficha</a></td>
          </tr>";
  }
  
  // Cerrar la tabla HTML
  echo "  </tbody>
  </table>";
} else {
  echo "No se encontraron resultados";
}

// Cerrar la conexión
$conn->close();
?>





<script>
  //Buscador 
function myFunction() {
  var input, filter, table, tr, td, td2, i, j, txtValue, existe;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    existe=false;
    for (j=0; j<td.length;j++){
      if (td[j].innerText.toUpperCase().indexOf(filter) > -1) {
        existe=true;
      }
    }
    if (existe){
       tr[i].style.display = "";
    } else {
       tr[i].style.display = "none";
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