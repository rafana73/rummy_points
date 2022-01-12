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
        <div class="container">
            <?php if(!isset($_SESSION['zalogowanyR'])) { ?>
                <div class="form-control-lg mt-5">
                    <form action="remik.php" method="POST">
                        <label for="logowanie">Podaj hasło:</label>
                        <input id="logowanie" class="form-control form-control-lg mb-3" type="password" name="hasloR" value="" />      
                        <input class="btn btn-primary btn-lg btn-block mb-5" type="submit" value="zaloguj" name="zaloguj" />
                    </form>
                </div>
            <?php } ?>

            <?php if(!isset($_POST['iloscGraczy']) && isset($_SESSION['zalogowanyR'])) { ?>
                <div class="row">
                    <div class="col mt-5">
                        <form action="" method="POST">
                            <div class="form-group">
                                <h2><label for="iloscG">Wybierz ilość graczy:</label></h2>
                                <select class="form-control form-control-lg" id="iloscG" name="iloscGraczy">
                                    <option value="2">dwóch</option>
                                    <option value="3">trzech</option>
                                    <option value="4" selected>czterech</option>
                                    <option value="5">pięciu</option>
                                    <option value="6">sześciu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-success btn-lg btn-block" type="submit" value="dodaj" />
                            </div>
                        </form>
                        <div>
                            <a class="btn btn-secondary btn-lg btn-block" href="rozgrywka.php">Bieżąca rozgrywka</a>
                        </div>
                    </div>
                <div class="w-100"></div>
                    <div class="col mt-5">
                        <hr>
                        <h3>Rozgrywki historycznie.</h3>
                        <form name="dataRozgrywki" action="remik.php">
                            <div class="form-group">
                                <label for="data">wybierz datę:</label>
                                <select class="form-control form-control-lg" name="id_rozgrywka">
                                    <?php $data = $obiektRemik ->dataRozgrywek();
                                        foreach ($data as $value) { ?>
                                        <option value="<?php echo $value['id_rozgrywka'];?>"><?php echo $value['data'];?></option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-lg btn-block" type="submit" value="pokaż" />
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>

            <?php if(isset($_POST['iloscGraczy']) && isset($_SESSION['zalogowanyR'])) { ?>
                <div class="col mt-5">
                    <form action="remik.php" method="POST">
                        <div class="form-group">
                            <h2><label for="imieG">Podaj imiona graczy:</label></h2>
                            <?php
                                for($i=0;$i<$_POST['iloscGraczy'];$i++) { ?>
                                <input class="form-control form-control-lg mb-3" id="imieG" type="text" name="gracz[]" value="" required=""/>
                                <?php } ?>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-danger btn-lg btn-block mt-5" type="submit" value="zaczynamy" />
                        </div>
                    </form>
                </div>
            <?php } ?>
            
        </div>
    </body>
</html>