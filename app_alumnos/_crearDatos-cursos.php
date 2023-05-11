<?php $titulo="Inserción de Datos en Tabla"; ?>
<?php include 'fragmentos/_header.php';?>

<h1><?php echo $titulo;?></h1>

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


$ejemplos_cursos = [
  "Programación web",
  "Diseño gráfico",
  "Marketing digital",
  "Certificado de profesionalidad en Desarrollo de aplicaciones con tecnología web",
  "Certificado de profesionalidad en Montaje y mantenimiento de sistemas microinformáticos",
  "Certificado de profesionalidad en Marketing y compraventa internacional",
  "Curso de Prevención de riesgos laborales en el sector de la construcción",
  "Curso de Manipulador de alimentos",
  "Curso de Inglés B1",
  "Curso de Gestión de proyectos con Microsoft Project",
  "Curso de Excel avanzado",
  "Curso de Comunicación efectiva en el entorno laboral",
  "Curso de Atención al cliente",
  "Curso de Contabilidad básica",
  "Curso de Habilidades directivas",
  "Curso de Social Media Marketing",
  "Curso de Diseño de páginas web con Wordpress",
  "Curso de Fotografía digital",
  "Curso de Cocina italiana",
  "Curso de Soldadura MIG/MAG",
  "Curso de Carpintería en madera",
  "Curso de Jardinería y paisajismo",
  "Curso de Primeros auxilios",
  "Curso de Manipulación de productos fitosanitarios",
  "Curso de Cuidado de personas mayores",
  "Curso de Técnico en administración de redes",
  "Curso de Administración y gestión de empresas",
  "Curso de Maquetación con Adobe InDesign",
  "Curso de Diseño gráfico con Adobe Illustrator",
  "Curso de Community Manager",
  "Curso de Coaching y liderazgo",
  "Curso de Marketing online y e-commerce",
  "Curso de Inglés para negocios",
  "Curso de Prevención de blanqueo de capitales y financiación del terrorismo",
  "Curso de Protección de datos personales",
  "Curso de Desarrollo web con PHP y MySQL"
];

$lugares = [
  "Dicampus Intra",
  "Dicampus La Calzada",
  "Oviedo",
  "FADE",
  "Avilés"
];


// Generar datos aleatorios y ejecutar las consultas SQL para insertar las filas
for ($i = 1; $i <= 10; $i++) {
  // Generar datos aleatorios para los campos
  $nombre =$ejemplos_cursos[rand(0,count($ejemplos_cursos)-1)];
  $ref = "REF" . rand(100, 999);
  $lugar = $lugares[rand(0, count($lugares)-1)];
  $fecha_comienzo = date('Y-m-d', strtotime('+'.rand(1,30).' days'));
  $fecha_fin = date('Y-m-d', strtotime($fecha_comienzo. ' + '.rand(1,30).' days'));
  $texto = "Descripción del curso " . $i;
  $img = "curso" . rand(0, 9) . ".jpg";
  
  // Consulta SQL para insertar una fila en la tabla "cursos"
  $sql = "INSERT INTO cursos (nombre, ref, lugar, fecha_comienzo, fecha_fin, texto, img)
  VALUES ('$nombre', '$ref', '$lugar', '$fecha_comienzo', '$fecha_fin', '$texto', '$img')";
  
  // Ejecutar la consulta SQL
  if ($conn->query($sql) === TRUE) {
    echo "Fila $i insertada correctamente con $nombre, $ref, $lugar, $fecha_comienzo, $fecha_fin, $texto, $img <br>";
  } else {
    echo "Error al insertar la fila $i: " . $conn->error . "<br>";
  }
}

// Cerrar la conexión
$conn->close();
?>


<?php include 'fragmentos/_footer.php';?>