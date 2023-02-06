<?php

include_once( "template.php" );

class dokumentysou_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?dokumentysou/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?dokumentysou/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?dokumentysou/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Název</th><th class="tal">Označení</th><th class="tal">Platnost od</th><th class="tal">Platnost</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            $cesta = "./img/".$rad["sou"]->cesta."/".$rad["sou"]->id."_".$rad["sou"]->nazev.".".$rad["sou"]->pripona;
            echo '<tr><td>' . $rad["naz"]->nazev . '</td>';
            echo '<td>' . $rad["sou"]->puvodniNazev . '</td>';
            echo '<td>' . $rad["dok"]->platnostOd . '</td>';
            echo '<td>' . $rad["dok"]->platny . '</td>';
            echo '<td><div class="volbysez">';
            echo '<a href="?dokumentysou/polozka/id=' . $rad["dok"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>';
            echo '<a href="'.$cesta.'" target="_blank" class="iko"><img src="./img/iko_dokument.svg"></a>';
            echo '<a href="?dokumentysou/smazpolozka/id=' . $rad["dok"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>';
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
        echo '          <h2 class="col_tmavabarva">Dokument<a href="?dokumentysou/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Název dokumentu</div>';
        echo '              <select class="w100p" name="dok_nazevId" onchange="dokumentZmenNazev(this);" id="dokNazevVyb">';
        echo '              <option value="0" >--- nový název ---</option>';
        foreach ($param["nazvy"] as $nazev) {
            if ($nazev["naz"]->id == $param["data"][0]["dok"]->nazevId) {
                $sel = "SELECTED";
            } else {
                $sel = "";
            }
            echo '              <option value="' . $nazev["naz"]->id . '" ' . $sel . ' >' . $nazev["naz"]->nazev . '</option>';
        }
        echo '              </select>';

//        echo '              <div class="nav">Zadat nebo upravit název</div>';
//        echo '              <input class="w100p" type="text" name="naz_nazev" value="'.$param["data"][0]["naz"]->nazev.'" id="dokNazev" />';

        echo '              <div class="nav">Platnost Od</div>';
        echo '              <input type="date" name="dok_platnostOd" value="' . $param["data"][0]["dok"]->platnostOd . '" />';
        if($param["data"][0]["dok"]->platny == "A"){
            $checked = "checked";
        }else{
            $checked = "";
        }
        echo '              <div class="nav">Aktuálně platný</div>';
        echo '              <input type="checkbox" name="dok_platny" value="A" '.$checked.' />';


//        if($param["data"][0]["dok"]->id > 0){
            echo '<div class="upload" jmp="dokumentysou" pre="dokumentysou" fce="soubor" par="str='.$param["str"].',id='.$param["data"][0]["dok"]->id.'" ondrop="nahrajSoubor(event);"></div>';
//        }
        echo '              <input type="hidden" name="dok_souborId" value="'.$param["data"][0]["dok"]->souborId.'" id="dok_souborId" / >';
        echo '              <input type="hidden" name="dok_id" value="' . $param["data"][0]["dok"]->id . '"/ >';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="dokumentysou" pre="dokumentysou" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    public function pisHistorie($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

//        echo '<a href="./?dokumenty/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?dokumentysou/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?dokumentysou/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Název</th><th class="tal">Popis</th><th class="tal">Platnost od</th><th class="tar">Zobrazit</th></tr>';
        foreach ($param["data"] as $rad) {
            $cesta = "./img/".$rad["sou"]->cesta."/".$rad["sou"]->id."_".$rad["sou"]->nazev.".".$rad["sou"]->pripona;
            echo '<tr><td>' . $rad["naz"]->nazev . '</td>';
            echo '<td>' . $rad["naz"]->popis . '</td>';
            echo '<td>' . $this->datum($rad["dok"]->platnostOd) . '</td>';
//            echo '<td>' . $rad["dok"]->platny . '</td>';
            echo '<td><div class="volbysez">';
            echo '<a href="'.$cesta.'" target="_blank" class="iko" download="'.$rad["sou"]->puvodniNazev.'"><img src="./img/iko_dokument.svg"></a>';
            echo '</div></td></tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

}

