<?php

$host = 'localhost'; 
$dbname = 'gestion_stock'; 
$username = 'root';
$password = ''; 

try {
   
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

   
    $connexion = new PDO($dsn, $username, $password);

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connexion->exec("SET NAMES 'utf8mb4'");
    $connexion->exec("SET CHARACTER SET utf8mb4");


} catch (PDOException $e) {
    echo 'Échec de la connexion : ' . $e->getMessage();
}
