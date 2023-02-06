<?php

include_once("template.php");

class koncert_tem extends template
{

    public function pisSeznam($param)
    {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?koncert/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?koncert/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?koncert/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Datum</th><th class="tal">Misto</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["kon"]->datum . '</td><td>' . $rad["kon"]->misto . '</td>'
                . '<td><div class="volbysez"><a href="?koncert/polozka/id=' . $rad["kon"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>'
                . '<a href="?koncert/smazpolozka/id=' . $rad["kon"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>'
                . '</div></td></tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function pisPolozku($param)
    {
        echo '<div class="obsah" id="obsah">';
        echo '<div class="block  block_standard">';
        echo '  <div class="container">';
        echo '      <div class="pole pole3 poleL bcg_svetlabarva stin formular">';
        echo '          <h2 class="col_tmavabarva">Provozovna<a href="?koncert/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Datum</div>';
        echo '              <input type="date" class="w100p" name="kon_datum" value="' . $param["data"][0]["kon"]->datum . '" />';
        echo '              <div class="nav">Čas</div>';
        echo '              <input type="text" class="w100p" name="kon_cas" value="' . $param["data"][0]["kon"]->cas . '" />';
        echo '              <div class="nav">Místo</div>';
        echo '              <input type="text" class="w100p" name="kon_misto" value="' . $param["data"][0]["kon"]->misto . '" />';
        echo '              <div class="nav">Popis</div>';
        echo '              <textarea name="kon_text">' . $param["data"][0]["kon"]->text . '</textarea>';
        echo '              <div class="upload" jmp="koncert" pre="koncert" fce="obrazekpole" ondrop="nahrajSoubor(event);"></div>';
        echo '              <div class="fotoclanekedi" id="fotoclanek">';
        if(!array_key_exists("foto",$param)){$param["foto"] = array();}
        foreach ($param["foto"] as $foto) {
            echo '<img src="img/' . $foto["sou"]->celaCesta . '" fotoid="' . $foto["sou"]->id . '">';
        }
        echo '              </div>';
        echo '              <input type="hidden" name="kon_id" value="' . $param["data"][0]["kon"]->id . '" />';
        echo '              <input type="hidden" id="fotoClanekId" name="kon_foto" value="' . $param["data"][0]["kon"]->foto . '" />';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="koncert" pre="koncert" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
        echo '</div>';
    }

    public function vypis($param)
    {
        echo '<div class="obsah" id="obsah">';
        echo '<div class="block  block_standard bcg_pozadi">';

        echo '<div class="container" >';
        echo '<h1 class="col_tmavomodra">Koncerty</h1>';
        echo '</div>';
        echo '<div class="container" >';
//        echo '<div class="clanky">';
        /*
                echo '<div class="provnab">';
                foreach ($param["kraje"] as $kraj){
                    echo '<a href="#kraj'.$kraj["kra"]->id.'">'.$kraj["kra"]->nazev.'</a>';

                }
                echo '</div>';
        */
        foreach ($param["data"] as $rad) {
            echo '<div class="pole pole1 poleM bcg_bila stin pole_v4">';

            echo '<div class="koncert" >';
            echo '<a href = "?koncert/vypisdet/id=' . $rad["kon"]->id . '"></a>';
            echo '<div class="texty">';
            echo '<h2>' . $rad["kon"]->datum .' '.$rad["kon"]->cas. '</h2>';
            echo '<div class="misto">' . $rad['kon']->misto . '</div>';

            echo '<div class="text">' . $rad['kon']->text . '</div>';
            echo '</div>';
            if (is_array($rad["kon"]->fotky)) {
                echo '<img src="img/' . $rad["kon"]->fotky[0]["sou"]->celaCesta . '" />';
            }
            echo '<div class="fc"></div>';
            echo '</div>';
            echo '</div>';
        }
//        echo '</div>';
        echo '<div class="strankovac">';
        if($param["str"] > 1){
            echo '<a href="?koncert/vypis/str='.($param["str"]-1).'#oblasti">PŘEDCHOZÍ</a>';
        }
        echo '<a href="?koncert/vypis/str='.($param["str"]+1).'#oblasti">DALŠÍ</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function vypisdet($param)
    {
        echo '<div class="obsah" id="obsah">';
        echo '<div class="block  block_standard bcg_pozadi">';
        echo '<div class="container" >';
        echo '<div class="pole pole1 poleS pole_oblast stin">';
        echo '<div class="clanky">';
        /*
                echo '<div class="provnab">';
                foreach ($param["kraje"] as $kraj){
                    echo '<a href="#kraj'.$kraj["kra"]->id.'">'.$kraj["kra"]->nazev.'</a>';

                }
                echo '</div>';
        */
        foreach ($param["data"] as $rad) {
            echo '<div class="koncertdet" >';
            if (is_array($rad["cla"]->fotky)) {
                echo '<img src="img/' . $rad["kon"]->fotky[0]["sou"]->celaCesta . '" />';
            }

            echo '<h2>' . $rad["kon"]->nadpis . '</h2>';
            echo '<div class="text">' . $rad['kon']->clanek . '</div>';

            if (is_array($rad["kon"]->fotky)) {
                foreach ($rad["kon"]->fotky as $fotka)
                    echo '<img src="img/' . $fotka["sou"]->celaCesta . '" />';
            }

            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

    }

}

//https://www.google.cz/maps/dir//Divadeln%C3%AD+Restaurace+Benar,+Rooseveltova+279,+436+01+Litv%C3%ADnov/@50.6011573,13.6168698,15z/data=!4m9!4m8!1m0!1m5!1m1!1s0x4709f4f9e5567d4b:0x60b5a97f2c47c881!2m2!1d13.6112699!2d50.6005651!3e0?hl=cs&authuser=0
