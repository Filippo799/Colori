<?php
    if (isset($_GET['cod_esadecimale'])) {
        $codModificaColore = $_GET['cod_esadecimale'];
        $connection = mysqli_connect("localhost", "root", "", "UtentiDB");
        $rsColore = mysqli_query($connection, "SELECT * FROM colori WHERE cod_esadecimale = '$codModificaColore'");
        $colore = mysqli_fetch_assoc($rsColore);
        mysqli_close($connection);
    }
    if (count($_POST)) {
        $connection = mysqli_connect("localhost", "root", "", "UtentiDB");
        $nome = $_POST['nome'];
        $codEsadecimale = $_POST['cod_esadecimale'];

        function daHEXaRGB($esadecimale) {
            $primo = substr($esadecimale, 0, 1);
            $secondo = substr($esadecimale, 1, 1);
            $rgb_red = ($primo * 16) + $secondo;

            $primo = substr($esadecimale, 2, 1);
            $secondo = substr($esadecimale, 3, 1);
            $rgb_green = ($primo * 16) + $secondo;
        }
        
        $query = mysqli_query($connection, "UPDATE colori SET nome='$nome', cod_esadecimale='$codEsadecimale' WHERE cod_esadecimale='$codModificaColore'");
        if ($query) {
            mysqli_close($connection);
            header("Location: index.php");
            die();
        } else {
            echo var_dump(mysqli_error($connection));
        }
?>

<html>
    <head>
        <title>Modifica Colore</title>
    </head>
    <body>
    <h2>Modifica Colore con codice: <?=$codModificaColore?></h2>
        <form action="" method="POST">
            <label for="">Colore: </label>
            <input value=<?=$colore['nome']?> type="text" name="nome">
            
            <label for="">cod_esadecimale: </label>
            <input value="<?=$colore['cod_esadecimale']?>" name="cod_esadecimale" type="text">
            <input type="hidden" name="cod_esadecimale" value="<?=$codModificaColore?>">
            <input type="submit" value="Salva">
        </form>
    </body>
</html>