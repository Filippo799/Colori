<?php

// DATABASE
function getDBConnection() {
    return mysqli_connect("localhost", "root", "");
}

function createDatabase($connection, $name) {
    if (mysqli_query($connection, "CREATE DATABASE $name")) {
        echo "Database: $name creato<br>";
    } else if (mysqli_errno($connection) == 1007) {
        echo "Database $name già esistente<br>";
    } else {
        echo "Errore creazione del database $name";
    }
    mysqli_select_db($connection, $name);
}

function createTable($connection, $tableName, $sqlCreateTable) {
    if (mysqli_query($connection, $sqlCreateTable)) {
        echo "Tabella $tableName creata<br>";
    } else if (mysqli_errno($connection) == 1050) {
        echo "Tabella $tableName già esistente<br>";
    } else {
        echo "Errore creazione tabella $tableName";
    }
}

function connect() {
    $name = "colori";
    $connection = getDBConnection();
    mysqli_select_db($connection, $name);
    return $connection;
}

function insertUtente($connection, $username, $password) {
    $sqlInsertUtente = "INSERT INTO utenti (username, password)VALUES ('$username', '$password')";
    if (mysqli_query($connection, $sqlInsertUtente)) {
        echo "Utente inserito<br>";
    } else {
        echo "Errore inserimento";
    }
}

function insertColorByHEX($connection, $name, $hex) {
    if (strlen($hex) != 6) {
        echo "il codice deve essere di 6 caratteri";
        return false;
    }
    $rgb = HEXtoRGB($hex);
    $hex = "#" . $hex;
    $sqlInsertColor = "INSERT INTO colori(name, hex, red, green, blue)
    VALUES('$name', '$hex', " . $rgb[0] . ", " . $rgb[1] . ", " . $rgb[2] . ")";
    if (mysqli_query($connection, $sqlInsertColor)) {
        echo "Colore inserito<br>";
    } else {
        echo("Errore inserimento colore");
    }
}

function insertColorByRGB($connection, $name, $red, $green, $blue) {
    $hex = RGBtoHEX($red, $green, $blue);
    $sqlInsertColor = "INSERT INTO colori(name, hex, red, green, blue)
    VALUES('$name', '$hex', $red, $green, $blue)";
    if (mysqli_query($connection, $sqlInsertColor)) {
        echo "Colore inserito<br>";
    } else {
        echo("Errore inserimento colore");
    }
}

function RGBtoHEX($red, $green, $blue) {
    $hex = "#";
    $primo = $red / 16;
    $resto = $red % 16;
    $hex = $hex . $primo . $resto;
    $primo = $green / 16;
    $resto = $green % 16;
    $hex = $hex . $primo . $resto;
    $primo = $blue / 16;
    $resto = $blue % 16;
    $hex = $hex . $primo . $resto;
    return $hex;
}
function HEXtoRGB($hex) {
    $rgb = [];
    $red = hexdec(substr($hex, 0, 2));
    $green = hexdec(substr($hex, 2, 2));
    $blue = hexdec(substr($hex, 4, 2));
    array_push($rgb, $red, $green, $blue);
    return $rgb;
}

function allColors() {
    $connection = connectDB();
    $colors = [];
    $result = mysqli_query($connection, "SELECT * FROM colori");
    if ($result) {
        $colors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    return $colors;
}

function updateColorByHEX($connection, $name, $hex) {
    $rgb = HEXtoRGB($hex);
    $hex = "#" . $hex;
    $sqlQuery = "UPDATE utenti SET name = '$name', hex = '$hex', red = " . $rgb[0] . ", green = " . $rgb[1] . ", blue = " . $rgb[2] . " WHERE "
}


// LOGIN
function tryLogin($username, $password) {
    $connection = connect();
    $sqlQuery = "SELECT * FROM utenti WHERE username = '$username' AND password = '$password'";
  return mysqli_num_rows(mysqli_query($connection, $sqlQuery)) == 1;
}

function loginUser() {
    if (isset($_COOKIE['user'])) {
      return $_COOKIE['user'];
    }
    return null;
  }



?>