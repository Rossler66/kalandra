<?php

include_once( "template.php" );

class form_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        if ($param["str"] > 0) {
            echo '<a href="./?form/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?form/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Odesláno</th><th class="tal">Název</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["frm"]->odeslano . '</td><td>' . $rad["frm"]->nazev . '</td>'
                . '<td><div class="volbysez"><a href="?form/polozka/id=' . $rad["frm"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>'
                . '</div></td></tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function pisPolozku($param) {
        echo '<div class="block  block_standard">';
        echo '  <div class="container">';
        echo '      <div class="pole pole3 poleL bcg_svetlabarva stin formular">';
        echo '          <h2 class="col_tmavabarva">Zpráva<a href="?form/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav col_bledemodra">Odesláno</div>';
        echo '              <div class="hod">'.$param["data"][0]["frm"]->odeslano.'</div>';
        echo '              <div class="nav col_bledemodra">Název</div>';
        echo '              <div class="hod">'.$param["data"][0]["frm"]->nazev.'</div>';
        echo '              <div class="nav col_bledemodra">Obsah</div>';
        $obsah = substr($param["data"][0]["frm"]->obsah,1,99999);
        $obsah[strlen($obsah)-1] = " ";
        $polozky = explode('","',$obsah);
        echo '<table class="w100po hod">';
        foreach ($polozky as $polozka){
            $hod = explode('":"',$polozka);
            echo '<tr><td>'.$hod[0].'</td><td>'.$hod[1].'</td></tr>';
        }
        echo '</table>';

        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="form" pre="form" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }


}

//https://www.google.cz/maps/dir//Divadeln%C3%AD+Restaurace+Benar,+Rooseveltova+279,+436+01+Litv%C3%ADnov/@50.6011573,13.6168698,15z/data=!4m9!4m8!1m0!1m5!1m1!1s0x4709f4f9e5567d4b:0x60b5a97f2c47c881!2m2!1d13.6112699!2d50.6005651!3e0?hl=cs&authuser=0
