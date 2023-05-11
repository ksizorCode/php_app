<?php
//obtener_edad_segun_fecha($fecha_nacimiento)
function obtener_edad_segun_fecha($fecha_nacimiento)
{
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}

//fechaBonita('2023-06-24'); // Imprime "Martes 24 de Junio de 2023"
function fechaBonita($fecha) {
    setlocale(LC_TIME, 'es_ES');

    // Convertir la fecha a un timestamp
    $timestamp = strtotime($fecha);
    
    // Formatear la fecha en el formato deseado
    return strftime('%A %e de %B de %Y', $timestamp); // Ejemplo: "Martes 24 de Junio de 2023"
  }



// calcularDias($fechaInicio, $fechaFin); // Imprime "60 días"
  function calcularDias($fechaInicio, $fechaFin) {
    // Convertir las fechas a objetos DateTime
    $inicio = new DateTime($fechaInicio);
    $fin = new DateTime($fechaFin);
    
    // Calcular la diferencia entre las fechas
    $diferencia = $inicio->diff($fin);
    
    // Obtener el número de días
    $dias = $diferencia->days;
    
    // Devolver el resultado
    return $dias . ' días'; // Ejemplo: "60 días"
  }

?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo;?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,100,1,200" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <nav>
        <?php include 'fragmentos/_menu.php';?>
    </nav>
</header>
<main>