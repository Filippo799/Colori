<?php
    if (count($_POST)) {
        $connection = mysqli_connect("localhost", "root", "", "UtentiDB");
        $username = $_POST['username'];
        $password = $_POST['password'];
        $result = mysqli_query($connection, "INSERT INTO utenti (username, chiave) VALUES ('$username', '$password')");
        if ($result) {
            mysqli_close($connection);
            header("Location: index.php");
            die();
        } else {
            echo var_dump(mysqli_error($connection));
        }
    }
?>

<html>
    <head>
        <title>Crea Nuovo Utente</title>
    </head>
    <body>
        <h1>Aggiungi Utente</h1>
        <form action="accedi.php" method="POST">
            <label for="username">Username: </label>
            <input name="username" type="text" id="username" required> <br>
            <label for="password">Password: </label>
            <input name="password" id="password" type="password" required> <br>
            <input type="submit" value="Crea Utente">
        </form>
    </body>
</html>