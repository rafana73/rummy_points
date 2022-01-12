<?php

class Rozgrywka {

    protected $pdo;
    public function __construct(object $pdo) {
        $this->pdo = $pdo;
    }
    
    public function getRozgrywka(int $get) {
        $obiektRemik = new Remik($this->pdo);
        $id_rozgrywki = $obiektRemik->ostaniID_rozgrywki();
        $ostaniID_rozgrywki = $get;#ostatni nr_rozgrywki
        
        $listaGraczy = $obiektRemik ->getGracze($ostaniID_rozgrywki);
        $listaPunktow = $obiektRemik ->getRozgrywka($ostaniID_rozgrywki);
        $sumaGraczy = count($listaGraczy);#ilość graczy

        #lista punktów na graczy
        echo '<table class="table table-striped table-dark table-bordered table-sm">';
            echo '<thead class="text-center"><tr>';
                echo '<th>id</th>';
                for($i=0;$i<$sumaGraczy;$i++) {
                    echo '<th>'.$listaGraczy[$i]['imie'].'</th>';#jacy gracze
                }
                echo '</tr></thead>';

                $grupowanie = [];
                foreach ($listaPunktow as $value) {
                    $name = $value['imie'];
                    $grupowanie[$name][] =  $value['punkty'];
                }

                $sumaRozgrywek = count($listaPunktow)/count($listaGraczy);#ilość rozgrywek
                for($i=0; $i<$sumaRozgrywek; $i++) {
                    echo '<tbody class="text-center"><tr>';
                    echo "<td>".$id = $id=$i+'1'."</td>";#pokazuje id
                    foreach ($grupowanie as $key => $v) {
                        echo "<td>".$grupowanie[$key][$i]."</td>";#pokazuje punkty
                    }
                    echo "</tr></tbody>";    
                }

            echo '<td class="text-info">SUMA</td>';
            foreach ($grupowanie as $key => $v) {
                echo '<td class="text-center text-info"><b>'.$podium[] = (array_sum($grupowanie[$key])).'</b></td>';#sumuje punkty po graczu
            }
        echo '</table>';

        #kto rozdaje
        if (!isset($_GET['id_rozgrywka'])) {
            if (!isset($id)) {
                $id = 0;
            }
            $idRozdania = intval($id)+1;
            $sumaGraczy = count($listaGraczy);
            if($idRozdania%$sumaGraczy == 0) {
                echo '<p>Rozdaje gracz: <b>'.$listaGraczy[$sumaGraczy-1]['imie'].'</b></p>';
            } else {
                $wynik = $idRozdania%$sumaGraczy;
                echo '<p>Rozdaje gracz: <b>'.$listaGraczy[$wynik-1]['imie'].'</b></p>';
            }
        }  

        #Lista które miejsce
        if (!empty($listaPunktow)) {
            for($i=0;$i<$sumaGraczy;$i++) {#pokazuje listę miejsc na podium
                $tabImie[] = $listaGraczy[$i]['imie'];
            }
            $podiumSort = array_combine($tabImie,$podium);#łączy dwie tablice
            natsort($podiumSort);

            $a = 1;
            foreach ($podiumSort as $key => $value) {
                echo "<h5 style='border-radius: 10px;' class='text-white bg-info p-1 text-center'>".$a++." miejsce - ".$key."</h5>";
            }
        }
    }
}