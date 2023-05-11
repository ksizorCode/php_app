<?php include 'cachinos/header.php'; ?>


    <h1>Listado de Animales</h1>


    <div class="toolbar">
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
    <div class="botonera">
      <button onclick="changeView(grid1)"><i class="fa-solid fa-grip"></i></button>
      <button onclick="changeView(grid1)"><i class="fa-solid fa-grip-vertical"></i></button>
      <button onclick="changeView(list)"><i class="fa-solid fa-list"></i></button>
      <button onclick="changeView(table)"><i class="fa-solid fa-table-cells-large"></i></button>
      <button onclick="changeView(table2)"><i class="fa-solid fa-table-list"></i></button>
    </div>
    </div>
    
    <ul id="myUL" class="tarjetas">
    <?php

      //leer contenido de json
      $datosjson= file_get_contents("JSON/datos.json");
  
      //convertir json en array php
      $animales= json_decode($datosjson,true);

      //mostrar contenido de contenedor
      //   var_dump($animales);

      //recorrer el array y mostrar datos
      foreach($animales as $animal){
        echo '<li class="cosa" dato="'.$animal['nombre'].'">';
      echo '<img src="img/'.$animal['img'].'" alt="'.$animal['nombre'].'">';
        echo '<h2>'.$animal['nombre'].'</h2>';
        echo '<ul>';
            echo '<li>'.$animal['raza'].'</li>';
            echo '<li>'.$animal['comida'].'</li>';
            echo '<li>'.$animal['habitad'].'</li>';
            echo '</ul>';
        echo '<a class="btn" href="ficha.php?animal='.$animal['nombre'].'">+ info</a>';

        echo '</li>';
        
      }    
    ?>
    </ul>
    

    <script>
function myFunction() {
    var input, filter, ul, li, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    li = document.getElementById("myUL").getElementsByClassName("cosa");
    for (i = 0; i < li.length; i++) {
        txtValue = li[i].getAttribute("dato");
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>

<?php include 'cachinos/footer.php'; ?>