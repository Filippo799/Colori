<?php
require "functions.php";
$sqlCreateTableUtenti = "CREATE TABLE utenti (
    id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(30) NOT NULL, 
    password VARCHAR(30) NOT NULL)";
$sqlCreateTableColori = "CREATE TABLE colori (
    id INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    name VARCHAR(30) NOT NULL, 
    hex VARCHAR(30) NOT NULL, 
    red INT(3) NOT NULL, 
    green INT(3) NOT NULL, 
    blue INT(3) NOT NULL)";

$connection = getDBConnection();
createDatabase($connection, "colori");
createTable($connection, "utenti", $sqlCreateTableUtenti);
createTable($connection, "colori", $sqlCreateTableColori);
insertUtente($connection, "admin", "admin");
insertColorByHEX($connection, "rosso", "ff0000");
?>