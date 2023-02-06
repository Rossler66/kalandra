<?php

include_once( "template.php" );

class menu_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?menu/novpolozka/id=0,str=' . $param["str"]. '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?menu/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?menu/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Menu</th><th class="tal">Text</th><th class="tal">Odkaz</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["men"]->menuKod . '</td><td>' . $rad["men"]->text . '</td><td>' . $rad["men"]->odkaz . '</td>'
            . '<td><div class="volbysez"><a href="?menu/polozka/id=' . $rad["men"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>'
            . '<a href="?menu/smazpolozka/id=' . $rad["men"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>'
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
        echo '          <h2 class="col_tmavabarva">Položka menu<a href="?menu/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Menu</div>';
        if ($param["data"][0]["men"]->menuKod == "H") {
            $sel = "CHECKED";
        } else {
            $sel = "";
        }
        echo '              <input type="radio" name="men_menuKod" value="H" ' . $sel . ' />Horní';
        if ($param["data"][0]["men"]->menuKod == "D") {
            $sel = "CHECKED";
        } else {
            $sel = "";
        }
        echo '              <input type="radio" name="men_menuKod" value="D" ' . $sel . ' />Dolní';
        if ($param["data"][0]["men"]->menuKod == "Z") {
            $sel = "CHECKED";
        } else {
            $sel = "";
        }
        echo '              <input type="radio" name="men_menuKod" value="Z" ' . $sel . '/>Zápatí';
        echo '              <div class="nav">Text</div>';
        echo '              <input class="w100p" type="text" name="men_text" value="' . $param["data"][0]["men"]->text . '" />';
        echo '              <div class="nav">Odkaz</div>';
        echo '              <select class="w100p" name="men_odkaz">';
        if ('' == $param["data"][0]["men"]->odkaz) {
            $sel = "SELECTED";
        } else {
            $sel = "";
        }
        echo '              <option value="" ' . $sel . ' >---</option>';
        foreach ($param["stranky"] as $stranka) {
            $odkaz="?stranka/obsah/id=".$stranka["str"]->id;
            if ($odkaz == $param["data"][0]["men"]->odkaz) {
                $sel = "SELECTED";
            } else {
                $sel = "";
            }
            echo '              <option value="' . $odkaz . '" ' . $sel . ' >' . $stranka["str"]->nazev . '</option>';
        }
/*
        $odkaz = "?provozovna/vypis/str=1";
        if ($odkaz == $param["data"][0]["men"]->odkaz) {
            $sel = "SELECTED";
        } else {
            $sel = "";
        }
        echo '              <option value="'.$odkaz.'" ' . $sel . ' >Pobočky</option>';

        $odkaz = "?spoluprace/vypis/str=1";
        if ($odkaz == $param["data"][0]["men"]->odkaz) {
            $sel = "SELECTED";
        } else {
            $sel = "";
        }
        echo '              <option value="'.$odkaz.'" ' . $sel . ' >Nabídka spolupráce</option>';
*/

        $odkaz = "?clanek/vypis/str=1";
        if ($odkaz == $param["data"][0]["men"]->odkaz) {
            $sel = "SELECTED";
        } else {
            $sel = "";
        }
        echo '              <option value="'.$odkaz.'" ' . $sel . ' >Články</option>';

        $odkaz = "?koncert/vypis/str=1";
        if ($odkaz == $param["data"][0]["men"]->odkaz) {
            $sel = "SELECTED";
        } else {
            $sel = "";
        }
        echo '              <option value="'.$odkaz.'" ' . $sel . ' >Koncerty</option>';


        echo '              </select>';
        echo '              <div class="nav">URL adresa nebo název pole</div>';
        echo '              <input class="w100p" type="text" name="men_url" value="' . $param["data"][0]["men"]->url . '" />';


        echo '              <input type="hidden" name="men_id" value="' . $param["data"][0]["men"]->id . '" />';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="menu" pre="menu" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

}
