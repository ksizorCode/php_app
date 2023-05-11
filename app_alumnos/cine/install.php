<? include '_config.php';?>
<? include $dir_inc.'header.php';?>
<h1>Instalar sistema</h1>
<p>Se han realizado las siguientes consultas a la base de datos:</p>
<?php
// Conexión a la base de datos
$conexion = mysqli_connect($server, $user, $pass);

//Borrar base de datos
$sql = "DROP DATABASE IF EXISTS $db";
vcode($sql);



// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS $db";
vcode($sql);
mysqli_query($conexion, $sql);

// Seleccionar la base de datos
mysqli_select_db($conexion, $db);

// Crear la tabla de directores
$sql = "CREATE TABLE directores (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        pais VARCHAR(50) NOT NULL
        )";
mysqli_query($conexion, $sql);
vcode($sql);

// Insertar datos en la tabla de directores
$sql = "INSERT IGNORE INTO directores (nombre, pais)
VALUES
('James Cameron', 'Estados Unidos'),
('Steven Spielberg', 'Estados Unidos'),
('Christopher Nolan', 'Reino Unido'),
('Quentin Tarantino', 'Estados Unidos'),
('Colin Trevorrow', 'Estados Unidos'),
('Martin Scorsese', 'Estados Unidos'),
('Peter Jackson', 'Nuevazelanda'),
('Francis Ford Coppola', 'Estados Unidos'),
('George Lucas', 'Estados Unidos'),
('Tim Burton', 'Estados Unidos')";
mysqli_query($conexion, $sql);
vcode($sql);

// Crear la tabla de géneros
$sql = "CREATE TABLE IF NOT EXISTS generos (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        imagen VARCHAR(100) NOT NULL
        )";
mysqli_query($conexion, $sql);
vcode($sql);

// Insertar datos en la tabla de géneros
$sql = "INSERT INTO generos (nombre, imagen)
        VALUES
        ('Drama', 'drama.jpg'),
        ('Ciencia Ficción', 'ciencia_ficcion.jpg')";
mysqli_query($conexion, $sql);
vcode($sql);





// Crear la tabla de películas
$sql = "CREATE TABLE IF NOT EXISTS peliculas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    poster VARCHAR(100) NOT NULL,
    director_id INT(6) NOT NULL,
    genero_id INT(6) NOT NULL
    )";
mysqli_query($conexion, $sql);
vcode($sql);

// Insertar datos en la tabla de películas
$sql = "INSERT INTO peliculas (titulo, poster, director_id, genero_id)
    VALUES
    ('Titanic', 'titanic.jpg', 1, 2),
    ('Avatar', 'avatar.jpg', 1, 3),
    ('El Padrino', 'el_padrino.jpg', 8, 1),
    ('La Lista de Schindler', 'lista_schindler.jpg', 2, 1),
    ('El Señor de los Anillos: La Comunidad del Anillo', 'senor_anillos1.jpg', 7, 4),
    ('El Señor de los Anillos: Las Dos Torres', 'senor_anillos2.jpg', 7, 4),
    ('El Señor de los Anillos: El Retorno del Rey', 'senor_anillos3.jpg', 7, 4),
    ('Harry Potter y la Piedra Filosofal', 'harry_potter1.jpg', 8, 4),
    ('Harry Potter y la Cámara Secreta', 'harry_potter2.jpg', 8, 4),
    ('Harry Potter y el Prisionero de Azkaban', 'harry_potter3.jpg', 8, 4),
    ('Harry Potter y el Cáliz de Fuego', 'harry_potter4.jpg', 8, 4),
    ('Harry Potter y la Orden del Fénix', 'harry_potter5.jpg', 8, 4),
    ('Star Wars: Episodio IV - Una Nueva Esperanza', 'star_wars1.jpg', 9, 3),
    ('Star Wars: Episodio V - El Imperio Contraataca', 'star_wars2.jpg', 9, 3),
    ('Star Wars: Episodio VI - El Regreso del Jedi', 'star_wars3.jpg', 9, 3),
    ('Star Wars: Episodio I - La Amenaza Fantasma', 'star_wars4.jpg', 9, 3),
    ('Star Wars: Episodio II - El Ataque de los Clones', 'star_wars5.jpg', 9, 3),
    ('Star Wars: Episodio III - La Venganza de los Sith', 'star_wars6.jpg', 9, 3),
    ('Indiana Jones y los Cazadores del Arca Perdida', 'indiana_jones1.jpg', 10, 1),
    ('Indiana Jones y el Templo de la Perdición', 'indiana_jones2.jpg', 10, 1),
    ('Indiana Jones y la Última Cruzada', 'indiana_jones3.jpg', 10, 1),
    ('Jurassic Park', 'jurassic_park.jpg', 11, 3)";
mysqli_query($conexion, $sql);
vcode($sql);





// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
