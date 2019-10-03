<?php
    if (count($_POST)) {
        $connection = mysqli_connect("localhost", "root", "", "UtentiDB");
        $rsUtenti = mysqli_query($connection, "SELECT * FROM utenti");
        $utenti = mysqli_fetch_all($rsUtenti, MYSQLI_ASSOC);
        $rsColori = mysqli_query($connection, "SELECT * FROM colori");
        $colori = mysqli_fetch_all($rsColori, MYSQLI_ASSOC);
        mysqli_close($connection);

        $username = $_POST['username'];
        $password = $_POST['password'];
        $trovato = false;
        foreach ($utenti as $utente) {
            if ($username == $utente['username'] && $password == $utente['chiave']) {
                $trovato = true;
            }
        }
    }   
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php if ($trovato) { ?>
            <h2><?=$username?></h2>
        <?php } else { ?>
            <h2>Accesso non autorizzato</h2>
        <?php } ?>

        <table>
            <tr>
                <th>Nome</th>
                <th>codice esadecimale</th>
                <th>RGB_red</th>
                <th>RGB_Green</th>
                <th>RGB_Blue</th>
                <th>Colore</th>
                <?php if ($trovato) { ?>
                    <th>Modifica RGB</th>
                <?php } ?>
                <?php if ($trovato) { ?>
                    <th>Modifica Codice Esadecimale</th>
                <?php } ?>
            </tr>
            <?php foreach($colori as $colore) { ?>
            <tr>
                <td><?=$colore['nome']?></td>
                <td><?=$colore['cod_esadecimale']?></td>
                <td><?=$colore['rgb_rosso']?></td>
                <td><?=$colore['rgb_verde']?></td>
                <td><?=$colore['rgb_blu']?></td>
                <td style="background-color:<?=$colore['cod_esadecimale']?>;"></td>
                <?php if ($trovato) { ?>
                    <td><a href="modificaRGB.php?rgb_rosso=<?=$colore['rgb_rosso']?>">Modifica</a></td>
                <?php } ?>
                <?php if ($trovato) { ?>
                    <td><a href="modificaHEX.php?cod_esadecimale=<?=$colore['cod_esadecimale']?>">Modifica</a></td>
                <?php } ?>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>