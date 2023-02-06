<?php

include_once("template.php");

class spoluprace_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?spoluprace/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?spoluprace/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?spoluprace/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Datum</th><th class="tal">Pobočka</th><th class="tal">Pozice</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["spo"]->datum . '</td>';
            echo '<td>' . $rad["pro"]->zastupce . '</td>';
            echo '<td>' . $rad["spo"]->pozice . '</td>';
            echo '<td><div class="volbysez">';
            echo '<a href="?spoluprace/polozka/id=' . $rad["spo"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>';
            echo '<a href="?spoluprace/smazpolozka/id=' . $rad["spo"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>';
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
        echo '          <h2 class="col_tmavabarva">Nabídka spolupráce<a href="?spoluprace/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';


        echo '              <div class="nav">Provozovna</div>';
        echo '              <select class="w100p" name="spo_provozovnaId" >';
        foreach ($param["provozovny"] as $prov) {
            if ($prov["pro"]->id == $param["data"][0]["spo"]->provozovnaId) {
                $sel = "SELECTED";
            } else {
                $sel = "";
            }
            echo '              <option value="' . $prov["pro"]->id . '" ' . $sel . ' >' . $prov["pro"]->mesto." ".$prov["pro"]->zastupce . '</option>';
        }
        echo '              </select>';


        echo '              <div class="nav">Datum zveřejnění</div>';
        echo '              <input class="w50p" type="date" name="spo_datum" value="'.$param["data"][0]["spo"]->datum.'" />';

        echo '              <div class="nav">Nabízená pozice</div>';
        echo '              <input class="w100p" type="text" name="spo_pozice" value="'.$param["data"][0]["spo"]->pozice.'" />';

        echo '              <div class="nav">Popis</div>';
        echo '              <textarea class="w100p"  name="spo_popis">'.$param["data"][0]["spo"]->popis.'</textarea>';



        echo '              <input type="hidden" name="spo_id" value="' . $param["data"][0]["spo"]->id . '"/ >';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="spoluprace" pre="spoluprace" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }


    public function vypis($param)
    {
        echo '<div class="block block_standard bcg_pozadi">';
        echo '    <div class="container">';
        echo '      <h1 class="col_tmavomodra">Nabídka spolupráce</h1>';
        echo '<div class="pole pole1 poleS">';
        echo '<p>Pomáháme lidem plnit cíle a sny. Chcete s námi? Hledáme spolehlivé kolegy do našeho kolektivu.</p>';
        echo '</div>';
        foreach ($param["data"] as $rad) {
            $adresa = 'https://www.google.cz/maps/dir//'.$rad["pro"]->ulice.'+'.$rad["pro"]->psc.'+'.$rad["pro"]->mesto;
            echo '<div class="pole pole3 poleL stin provozovna zoom">';
            echo '<div class="pro_pozice">' . $rad["spo"]->pozice . '</div>';
            if($rad["spo"]->popis > " ") {
                echo '<div class="pro_popis">' . $rad["spo"]->popis . '</div>';
            }
//            echo '<a class="pro_trasa" href="'.$adresa.'" target="_blank">trasa</a>';
            echo '<div class="pro_mesto">' . $rad["pro"]->mesto . '</div>';
            echo '<div class="pro_ulice">' . $rad["pro"]->ulice . '</div>';
            echo '<div class="pro_telefon"><a href="tel:http://'.$rad["pro"]->telefon.'">' . $rad["pro"]->telefon . '</a></div>';
            echo '<div class="pro_email"><a href="mailto:'.$rad["pro"]->email.'">' . $rad["pro"]->email . '</a></div>';
//            echo '<div class="pro_zastupce">' . $rad["pro"]->zastupce . '</div>';
            echo '</div>';

/*
        foreach ($param["data"] as $spo) {
            echo '        <div class="pole pole1 poleM pole_v4 bcg_bila stin">';

            echo '            <p class="pro_ulice">'.$this->datum($spo["spo"]->datum).'</p>';
            echo '            <p class="pro_mesto">'.$spo["spo"]->pozice.'</p>';
            echo '            <p class="">'.$spo["spo"]->popis.'</p>';
            echo '            <p class="pro_ulice">'.$spo["pro"]->mesto.' '.$spo["pro"]->ulice.'</p>';
            echo '            <p class="pr">'.$spo["pro"]->zastupce.'</p>';
            echo '            <p class="pro_telefon">'.$spo["pro"]->telefon.'</p>';
            echo '            <p class="pro_email">'.$spo["pro"]->email.'</p>';
            echo '        </div>';
*/
        }
        echo '    </div>';
        echo '</div>';
    }

}

