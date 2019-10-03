<?php
    $connection = mysqli_connect("localhost", "root", "", "UtentiDB");
    $rsColori = mysqli_query($connection, "SELECT * FROM colori");
    $colori = mysqli_fetch_all($rsColori, MYSQLI_ASSOC);
    mysqli_close($connection);
?>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        Accedi o <a href="nuovoUtente.php">crea nuovo utente</a>
        <form action="accedi.php" method="POST">
            <label for="username">Username: </label>
            <input type="text" name="username" id="username"><br>
            <label for="password">Password: </label>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Conferma">
        </form>

        <table>
            <tr>
                <th>Nome</th>
                <th>codice esadecimale</th>
                <th>RGB_red</th>
                <th>RGB_Green</th>
                <th>RGB_Blue</th>
                <th>Colore</th>
            </tr>
            <?php foreach($colori as $colore) { ?>
            <tr>
                <td><?=$colore['nome']?></td>
                <td><?=$colore['cod_esadecimale']?></td>
                <td><?=$colore['rgb_rosso']?></td>
                <td><?=$colore['rgb_verde']?></td>
                <td><?=$colore['rgb_blu']?></td>
                <td style="background-color:<?=$colore['cod_esadecimale']?>;"></td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>