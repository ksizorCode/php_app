<?php $titulo="Inicio"; ?>
<?php include 'fragmentos/_header.php';?>
<h1>Bienvenidos</h1>
<div class="grid">
    <section>
        <p>Este es un sistema de testeo de Base de datos.</p>
        <p>Si es la primera vez que utilizas esto quizás tengas que realizar la instalación: en tal caso <a href="install.php">Haz Click aquí</a>.</p>
        <h2>Aquí podrás:</h2>
        <ul>
            <li><a class="btn" href="read_list.php">Ver la Lista de Alumnos</a></li>
            <li><a class="btn" href="insertar.php">Añadir nuevos alumnos</a></li>
            <li><a class="btn" href="ficha.php">Ver ficha de alumnos</a></li>
            <li><a class="btn" href="install.php">Resetear el sistema</a></li>
        </ul>
    </section>

    <section>
        <h2>Últimos 20 Alumnos insertados</h2>
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
    $sql = "SELECT * FROM alumnos ORDER BY id DESC LIMIT 20";

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
            <th>Foto</th>
            <th onclick="sortTable(2)"><span id="arrow2"></span>Nombre y Apellidos</th>
            <th onclick="sortTable(4)"><span id="arrow4"></span>Ciudad</th>
            <th onclick="sortTable(6)"><span id="arrow6"></span>Edad</th>
            </tr>
            </thead>
            <tbody>

        ';
    
    // Recorrer los resultados y mostrarlos en la tabla HTML
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td><img src='img/" . $fila["foto"] . "'></td>
                <td><a href='ficha.php?id=".$fila["id"]."'>".$fila["nombre"]." ".$fila["apellidos"] . "</td>
                <td>" . $fila["ciudad"] . "</td>
                <td>" . obtener_edad_segun_fecha($fila["fecha_nacimiento"]) . "</td>
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
    </section>
   

</div> 



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