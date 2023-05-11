<?php $titulo="Reseteo"; ?>
<?php include 'fragmentos/_header.php';?>

    <h1><i class="fa-solid fa-arrow-rotate-right"></i>Reseteao / Instalación</h1>
    <p>Esta opción reseteará el espacio de trabajo creando una base de datos llamada dicampus e insertando dentro una tabla alumno con datos aleatorios de alumnos. Siga los siguientes pasos:</p>
    
    <p>Asegúrse de que: </p>
    <ul>
        <li>Servidor:loalhost</li>
        <li>Usuario:root</li>
        <li>Password:root</li>
    </ul>

    <ol>
        <li><a class="btn" href="_crearDB.php"><i class="fa-solid fa-calendar"></i>Crear DB Dicampus</a></li>
        <li><a class="btn" href="_crearTabla.php"><i class="fa-regular fa-calendar"></i>Crear Tabla alumnos</a></li>
        <li><a class="btn" href="_crearDatos.php"><i class="fa-regular fa-calendar-days"></i>Llenar Tabla Alumnos de datos (falsos)</a></li>
    </ol>
    
    <ol>
        <li><a class="btn" href="_crearTabla-cursos.php"><i class="fa-regular fa-calendar"></i>Crear Tabla Cursos</a></li>
        <li><a class="btn" href="_crearDatos-cursos.php"><i class="fa-regular fa-calendar-days"></i>Llenar Tabla Cursos de datos (falsos)</a></li>
    </ol>
<p>Hemos crado los 12 avatares que están en la carepta img gracias a <a href="https://getavataaars.com/">esta web</a></p>
    <p>También puedes <a class="btn" href="_borrarDB.php"><i class="fa-regular fa-trash-can"></i>Forzar el borrado de la base de datos Dicampus</a>.</p>

    <?php include 'fragmentos/_footer.php';?>
