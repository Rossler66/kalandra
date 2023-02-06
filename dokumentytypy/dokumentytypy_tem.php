<?php

include_once("template.php");

class dokumentytypy_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?dokumentytypy/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?dokumentytypy/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?dokumentytypy/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Název</th><th class="tal">Soubor</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["naz"]->nazev . '</td>';
            echo '<td>' . $rad["naz"]->soubor . '</td>';
            echo '<td><div class="volbysez">';
            echo '<a href="?dokumentytypy/polozka/id=' . $rad["naz"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>';
            echo '<a href="?dokumentytypy/smazpolozka/id=' . $rad["naz"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>';
            echo '</div></td></tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function pisPolozku($param) {

        echo '<div class="block  block_standard">';
        echo '  <div class="container" ondragover="nastavDrag(event);">';
        echo '      <div class="pole pole3 poleL bcg_svetlabarva stin formular">';
        echo '          <h2 class="col_tmavabarva">Typ dokumentu<a href="?dokumentytypy/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';

        echo '              <div class="nav">Název dokumentu</div>';
        echo '              <input class="w100p" type="text" name="naz_nazev" value="'.$param["data"][0]["naz"]->nazev.'" />';

        echo '              <div class="nav">Cesty s názvy uložení aktuálního dokumenu</div>';
        echo '              <textarea class="w100p" type="textarea" name="naz_soubor">'.$param["data"][0]["naz"]->soubor.'</textarea>';

        echo '              <div class="nav">Popis</div>';
        echo '              <textarea class="w100p"  name="naz_popis">'.$param["data"][0]["naz"]->popis.'</textarea>';



        echo '              <input type="hidden" name="naz_id" value="' . $param["data"][0]["naz"]->id . '"/ >';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="dokumentytypy" pre="dokumentytypy" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }


}

