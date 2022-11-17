<?php
//These are the defined authentication environment in the db service

// The MySQL service named in the docker-compose.yml.
$host = 'db';

// Database use name
$user = 'root';
$bdd = 'app-data';

//database user password
$pass = 'secret';
$port = '3306';

try {
    //code...
    $conn = new PDO("mysql:host=$host; dbname=$bdd","$user","$pass");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:ERRMODE_EXCEPTION);
    echo "Connexion réussie";

} catch (PDOException $e) {
    echo "Echec de connection : $e->getMessage()";
}
?>
