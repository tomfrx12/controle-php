<?php

$localhost = "localhost";
$username = "root";
$password = "";
$database = "ma_collection_jeux";

$dsn = "mysql:host=$localhost;dbname=$database;charset=utf8mb4";

try {
    $connection = new PDO(
        $dsn, 
        $username, 
        $password, 
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    echo "Connexion échouée: " . $e->getMessage();
}

?>