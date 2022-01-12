<?php
session_start();
require_once './class/Baza.php';
require_once './db.php';

require_once './class/Remik.php';
require_once './class/Rozgrywka.php';

$obiektRemik = new Remik($pdo);
$obiektRozgrywka = new Rozgrywka($pdo);
?>
<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        <link rel="stylesheet" href="csv/style.css">
        <title>REMIK punktacja</title>
    </head>
    <body class="text-white bg-dark">
        <div class="container-fluid mt-5">
            <?php          
                if (isset($_POST['hasloR'])) {
                    if (($_POST['hasloR']) === 'raf') {
                        $_SESSION['zalogowanyR'] = TRUE; 
                        header('Location: index.php');
                        exit;
                    } else {
                        header('Location: index.php');
                        exit;
                    }
                }
            
                if(isset($_POST['gracz'])) {
                    $tabGracze = $_POST['gracz'];
                    $id_rozgrywki = $obiektRemik->ostaniID_rozgrywki();
                    $nowyID_rozgrywki = ++$id_rozgrywki['id_rozgrywka'];#dodaje nowy nr_rozgrywki
                    foreach ($tabGracze as $value) {
                        $dodajGraczy = $obiektRemik->dodajGracza($value, $nowyID_rozgrywki);
                    }
                    header('Location: rozgrywka.php');
                    exit;

                } elseif (isset($_POST['punkty'])) {
                    $sumaGraczy = count($_POST['punkty']);
                    for($i=0;$i<$sumaGraczy;$i++) {
                        $obiektRemik ->dodajPunkty($_POST['id_gracza'][$i], $_POST['id_rozgrywka'][$i], $_POST['punkty'][$i]);
                    }
                    header('Location: rozgrywka.php');
                    exit;

                } elseif ($_GET['id_rozgrywka']) {
                    $obiektRozgrywka ->getRozgrywka($_GET['id_rozgrywka']);
                    echo '<div>
                        <p><a class="btn btn-danger btn-lg btn-block mt-5 mb-5" href="index.php">Wróć</a></p>
                    </div>';
                    
                } else {
                    header('Location: index.php');
                    exit;
                }
            ?>
        </div>
    </body>
</html>