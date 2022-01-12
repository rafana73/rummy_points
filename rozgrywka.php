<?php
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
        <div class="container">
            <div class="row">
                <div class="col">
                <?php
                    $id_rozgrywki = $obiektRemik->ostaniID_rozgrywki();
                    if ($id_rozgrywki == false) {
                        exit("<h3>BRAK ROZGRYWKI, GO BACK!<h3>");
                    }
                    $ostaniID_rozgrywki = $id_rozgrywki['id_rozgrywka'];#ostatni nr_rozgrywki
                    $listaGraczy = $obiektRemik ->getGracze($ostaniID_rozgrywki);

                    #dodaj punkty graczom
                    echo '<form method="POST" action="remik.php">';
                        echo '<div class="form-group">';
                            echo '<div class="row">';
                                foreach ($listaGraczy as $value) {
                                    echo '<div class="col">';
                                        echo $value['imie'].":";
                                        echo '<input type="hidden" name="id_gracza[]" value="'.$value['id_gracza'].'" />
                                            <input type="hidden" name="id_rozgrywka[]" value="'.$value['id_rozgrywka'].'" />
                                            <input class="form-control form-control-md" type="number" name="punkty[]" min="0" value="" required style="width: 8em;"/>';
                                    echo '</div>';
                                }
                            echo '</div>';
                            echo '<input class="btn btn-success btn-md btn-block mt-3" type="submit" value="zapisz" />';
                        echo '</div>';
                    echo '</form>';
                ?>
                </div>
            <div class="w-100"></div>
                <div class="col"> 
                    <?php
                        $obiektRozgrywka ->getRozgrywka($ostaniID_rozgrywki);
                    ?>
                </div>
            </div>
            <div>
                <p><a class="btn btn-danger btn-md btn-block mt-5 mb-5" href="index.php">Nowa rozgrywka</a></p>
            </div>
        </div>
    </body>
</html>