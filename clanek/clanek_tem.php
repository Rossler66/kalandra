<?php

include_once("template.php");

class clanek_tem extends template
{

    public function pisSeznam($param)
    {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?clanek/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?clanek/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?clanek/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Datum</th><th class="tal">Nadpis</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["cla"]->datum . '</td><td>' . $rad["cla"]->nadpis . '</td>'
                . '<td><div class="volbysez"><a href="?clanek/polozka/id=' . $rad["cla"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>'
                . '<a href="?clanek/smazpolozka/id=' . $rad["cla"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>'
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
        echo '          <h2 class="col_tmavabarva">Provozovna<a href="?clanek/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Nadpis</div>';
        echo '              <input type="text" class="w100p" name="cla_nadpis" value="' . $param["data"][0]["cla"]->nadpis . '" />';
        echo '              <div class="nav">Datum</div>';
        echo '              <input type="date" class="w100p" name="cla_datum" value="' . $param["data"][0]["cla"]->datum . '" />';
        echo '              <div class="nav">Clanek</div>';
        echo '              <textarea name="cla_clanek">' . $param["data"][0]["cla"]->clanek . '</textarea>';
        echo '              <div class="upload" jmp="clanek" pre="clanek" fce="obrazekpole" ondrop="nahrajSoubor(event);"></div>';
        echo '              <div class="fotoclanekedi" id="fotoclanek">';
        foreach ($param["foto"] as $foto) {
            echo '<img src="img/' . $foto["sou"]->celaCesta . '" fotoid="' . $foto["sou"]->id . '">';
        }
        echo '              </div>';
        echo '              <input type="hidden" name="cla_id" value="' . $param["data"][0]["cla"]->id . '" />';
        echo '              <input type="hidden" id="fotoClanekId" name="cla_foto" value="' . $param["data"][0]["cla"]->foto . '" />';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="clanek" pre="clanek" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
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
//        echo '<h1 class="col_tmavomodra">Aktuality</h1>';
//        echo '<div class="clanky">';
        /*
                echo '<div class="provnab">';
                foreach ($param["kraje"] as $kraj){
                    echo '<a href="#kraj'.$kraj["kra"]->id.'">'.$kraj["kra"]->nazev.'</a>';

                }
                echo '</div>';
        */
        foreach ($param["data"] as $rad) {
            echo '<div class="pole pole2 poleL bcg_bila stin zoom pole_v4">';
            if (is_array($rad["cla"]->fotky)) {
                echo '<div class="clanek" style="background-image: url(img/' . $rad["cla"]->fotky[0]["sou"]->celaCesta . ')">';
            } else {
                echo '<div class="clanek" >';
            }
            echo '<a href = "?clanek/vypisdet/id=' . $rad["cla"]->id . '"></a>';
            echo '<h2>' . $rad["cla"]->nadpis . '</h2>';
            echo '<div class="anotace">' . $rad['cla']->clanek . '</div>';
            echo '</div>';
            echo '</div>';
        }
//        echo '</div>';
        echo '<div class="strankovac">';
        if($param["str"] > 1){
            echo '<a href="?clanek/vypis/str='.($param["str"]-1).'#oblasti">PŘEDCHOZÍ</a>';
        }
        echo '<a href="?clanek/vypis/str='.($param["str"]+1).'#oblasti">DALŠÍ</a>';
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
            echo '<div class="clanekdet" >';
            if (is_array($rad["cla"]->fotky)) {
                echo '<img src="img/' . $rad["cla"]->fotky[0]["sou"]->celaCesta . '" />';
            }

            echo '<h2>' . $rad["cla"]->nadpis . '</h2>';
            echo '<div class="text">' . $rad['cla']->clanek . '</div>';

            if (is_array($rad["cla"]->fotky)) {
                foreach ($rad["cla"]->fotky as $fotka)
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
