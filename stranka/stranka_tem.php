<?php

class stranka_tem {

    public function hlavickaZacatek($param) {
        echo '<html>';
        echo '   <head>';
        echo '       <meta charset="utf-8">';
        echo '       <meta name="viewport" content="initial-scale=1, maximum-scale=1">';
        echo '       <link href="web.css" rel="stylesheet" type="text/css">';
        echo '       <link href="webakt.css" rel="stylesheet" type="text/css">';
        echo '       <title></title>';
    }

    public function hlavickaKonec($param) {
        echo '   </head>';
        echo '<body>';
    }

    public function zahlavi($param) {
        echo '<div class="zahlavi" id="zahlavi" nazev="Hlavička" idstr="1">';
        echo '  <div class="block logo">';
        echo '      <div class="container">';
        echo '          <div class="pole pole1 poleL">';
        echo '              <a href="?stranka/obsah/typ=T"><img src="./img/logo.png" class="logo" /></a>';
        echo '              <div class="menu_pas">';
        foreach ($param["menhor"] as $menu) {
            $target = "";
            if($menu["men"]->odkaz && $menu["men"]->url){
                $odkaz = $menu["men"]->odkaz."#".$menu["men"]->url;
            }elseif($menu["men"]->odkaz){
                $odkaz = $menu["men"]->odkaz;
            }else{
                $odkaz = $menu["men"]->url;
                $target = ' target="_blank" ';
            }

            echo '<a href="' . $odkaz . '" '.$target.'>' . $menu["men"]->text . '</a>';
        }
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '  <div class="block menu">';
        echo '      <div class="container">';
        echo '          <div class="pole pole1 poleL">';
        echo '              <div class="menu_pas">';
        foreach ($param["mendol"] as $menu) {
            echo '<a href="' . $menu["men"]->odkaz . '">' . $menu["men"]->text . '</a>';
        }

        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    public function obsah($param) {
        echo '<div class="' . $param["class"] . '" id="' . $param["obsahId"] . '" nazev="' . $param["nazev"] . '" idstr="' . $param["id"] . '">';
        echo $param["obsah"];
        echo '</div>';
    }

    public function zapati($param) {

        echo '<div class="block block_pata">';
        echo '  <div class="container">';
        echo '      <div class="pole pole4 poleS">';
        echo '          <img class="logopata" src="./img/logomale.gif">';
        echo '      </div>';

        echo '      <div class="pole pole4 poleS">';
        echo '          <h3>Nabídka</h3>';
        foreach ($param["nabidka"] as $pol) {
            echo '<a href="' . $pol["men"]->odkaz . '">' . $pol["men"]->text . '</a>';
        }
        echo '<a href="?'.$_SERVER['QUERY_STRING'].',cook=set">Cookies</a>';
        echo '      </div>';
        echo '      <div class="pole pole4 poleS">';
        echo '          <h3>Dokumenty</h3>';
/*
        foreach ($param["dokumenty"] as $pol) {
            $cesta = "./img/" . $pol["sou"]->cesta . "/" . $pol["sou"]->id . "_" . $pol["sou"]->nazev . "." . $pol["sou"]->pripona;
            echo '<a href="' . $cesta . '" target="_blank">' . $pol["naz"]->nazev . '</a>';
        }
*/
        echo '<a href="?dokumentysou/platne/str=0">Platné dokumenty</a>';
        echo '<a href="?dokumentysou/historie/str=0">Historie dokumentů</a>';
        echo '      </div>';
        echo '      <div class="pole pole4 poleS">';
        echo '          <h3>Sídlo společnosti</h3>';
        echo '          <a href="#">Volyňských Čechů 837,<br />Žatec 438 01</a>';
        echo '      </div>';
        echo '      <div class="pole pole4 poleS">';
        echo '          <h3>Kontakt</h3>';
        echo '          <a href="#">+420 810 888 900</a>';
        echo '          <a href="mailto:info@bohemika.eu">info@bohemika.eu</a>';
        echo '          <a href="https://www.facebook.com/BohemikaFinancniPoradenstvi/" target="_blank">FACEBOOK</a>';
        echo '          <a href="https://www.instagram.com/bohemika_cz/" target="_blank">INSTAGRAM</a>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    public function editorBlok($param) {
        echo '<div class="editpanel formular" id="editblock">';
        echo '<h2>Blok</h2>';
        echo '  <div class="barvapole">';
        echo '      <p class="txs_xs nadpis">Pozadí</p>';
        echo '      <div style="background-color:#FFFFFF00"; barva="transaprent" onclick="nastavBarvuPozadi(event);">X</div>';
        echo '      <div style="background-color:#FFFFFFFF"; barva="bila" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#ecebe8FF"; barva="seda" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#7bc2f5FF"; barva="bledemodra" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#005897FF"; barva="tmavomodra" onclick="nastavBarvuPozadi(event);"></div>';


        echo '  </div>';
        echo '<p class="txs_xs nadpis">Přetažením nahraj obrázek</p>';
        echo '<div class="upload" jmp="stranka" pre="stranka" fce="obrazekpole" ondrop="nahrajSoubor(event);"></div>';

        echo '  <p class="txs_xs nadpis">Typ bloku</p>';
        echo '  <div class="typ">';
        echo '      <p typ="hlava" onclick="nastavTypBloku(event);">Hlava</p>';
        echo '      <p typ="oblasti" onclick="nastavTypBloku(event);">Volby</p>';
        echo '      <p typ="info" onclick="nastavTypBloku(event);">Info</p>';
        echo '      <p typ="standard" onclick="nastavTypBloku(event);">Standard</p>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Název bloku pro odkaz</p>';
        echo '<input type="text" onblur="nastavNazevBloku();" id="nazevBloku">';

        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_nahoru.svg" onclick="blokNahoru(event);" />';
        echo '  <img src="img/iko_dolu.svg" onclick="blokDolu(event);" />';
        echo '  <img src="img/iko_smaz.svg" onclick="blokSmaz(event);" />';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="editpole">';
        echo '<h2>Pole</h2>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Pozadí</p>';
        echo '<div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuPozadi(event);">X</div>';
        echo '<div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuPozadi(event);"></div>';
        echo '<div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuPozadi(event);"></div>';
        echo '<div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuPozadi(event);"></div>';
        echo '<div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuPozadi(event);"></div>';

        echo '      <div style="background-color:#FFFFFFC0"; barva="bila3" onclick="nastavBarvuPozadi(event);" class="fc"></div>';
        echo '      <div style="background-color:#ecebe8C0"; barva="seda3" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#7bc2f5C0"; barva="bledemodra3" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#005897C0"; barva="tmavomodra3" onclick="nastavBarvuPozadi(event);"></div>';

        echo '      <div style="background-color:#FFFFFF80"; barva="bila2" onclick="nastavBarvuPozadi(event);" class="fc"></div>';
        echo '      <div style="background-color:#ecebe880"; barva="seda2" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#7bc2f580"; barva="bledemodra2" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#00589780"; barva="tmavomodra2" onclick="nastavBarvuPozadi(event);"></div>';

        echo '      <div style="background-color:#FFFFFF40"; barva="bila1" onclick="nastavBarvuPozadi(event);" class="fc"></div>';
        echo '      <div style="background-color:#ecebe840"; barva="seda1" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#7bc2f540"; barva="bledemodra1" onclick="nastavBarvuPozadi(event);"></div>';
        echo '      <div style="background-color:#00589740"; barva="tmavomodra1" onclick="nastavBarvuPozadi(event);"></div>';

        echo '</div>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Rámeček</p>';
        echo '<div style="background-color:#FFF"; barva="transaprent" onclick="nastavRamecek(event);">X</div>';
        echo '<div style="background-color:#FFF"; barva="bila" onclick="nastavRamecek(event);"></div>';
        echo '<div style="background-color:#ecebe8"; barva="seda" onclick="nastavRamecek(event);"></div>';
        echo '<div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavRamecek(event);"></div>';
        echo '<div style="background-color:#005897"; barva="tmavomodra" onclick="nastavRamecek(event);"></div>';
        echo '</div>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Stín</p>';
        echo '<div style="background-color:#FFF"; hodnota="---" onclick="nastavStin(event);">X</div>';
        echo '<div style="background-color:#333"; hodnota="stin" onclick="nastavStin(event);"></div>';
        echo '</div>';
        echo '<div class=barvapole>';
        echo '<p class="txs_xs nadpis">Zoom</p>';
        echo '<div style="background-color:#FFF"; hodnota="---" onclick="nastavZoom(event);">X</div>';
        echo '<div style="background-color:#FFF"; hodnota="zoom" onclick="nastavZoom(event);">A</div>';
        echo '</div>';

        echo '<div class=barvapole>';
        echo '<p class="txs_xs fc nadpis">Počet polí na šířku / šířka pole</p>';
        echo '<div typ="pole1" onclick="nastavPocetPole(event);">1</div>';
        echo '<div typ="pole2" onclick="nastavPocetPole(event);">2</div>';
        echo '<div typ="pole3" onclick="nastavPocetPole(event);">3</div>';
        echo '<div typ="pole4" onclick="nastavPocetPole(event);">4</div><p class="fl"> - </p>';
        echo '<div typ="poleS" onclick="nastavSirkaPole(event);">S</div>';
        echo '<div typ="poleM" onclick="nastavSirkaPole(event);">M</div>';
        echo '<div typ="poleL" onclick="nastavSirkaPole(event);">L</div>';
        echo '</div>';

        echo '<div class=barvapole>';
        echo '<p class="txs_xs fc nadpis">Výška pole</p>';
        echo '<div hodnota="---" onclick="nastavVyskaPole(event);">x</div>';
        echo '<div hodnota="pole_v1" onclick="nastavVyskaPole(event);">1</div>';
        echo '<div hodnota="pole_v2" onclick="nastavVyskaPole(event);">2</div>';
        echo '<div hodnota="pole_v3" onclick="nastavVyskaPole(event);">3</div>';
        echo '<div hodnota="pole_v4" onclick="nastavVyskaPole(event);">4</div>';
        echo '<div hodnota="pole_v5" onclick="nastavVyskaPole(event);">5</div>';
        echo '<div hodnota="pole_v6" onclick="nastavVyskaPole(event);">6</div>';
        echo '<div hodnota="pole_v7" onclick="nastavVyskaPole(event);">7</div>';
        echo '<div hodnota="pole_v8" onclick="nastavVyskaPole(event);">8</div>';
        echo '<div hodnota="pole_v9" onclick="nastavVyskaPole(event);">9</div>';
        echo '</div>';


        echo '<p class="txs_xs nadpis">Odkaz</p>';
        echo '<img src="img/iko_edit.svg" onclick="nabOdkazy(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="odkazSmaz(event);" />';

        echo '<p class="txs_xs nadpis">Posum / smazání</p>';
        echo '<img src="img/iko_nahoru.svg" onclick="blokNahoru(event);">';
        echo '<img src="img/iko_dolu.svg" onclick="blokDolu(event);">';
        echo '<img src="img/iko_smaz.svg" onclick="blokSmaz(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';


        echo '<div class="editpanel formular" id="pridejprvek">';
        echo '<h2>Přidat prvek</h2>';
        echo '  <p class="txs_xs nadpis">Typ prvku</p>';
        echo '  <div class="typ">';
        echo '      <p onclick="pridejObrazek(event);">Obrázek</p>';
        echo '      <p onclick="pridejNadpis(event);">Nadpis</p>';
        echo '      <p onclick="pridejText(event);">Text</p>';
        echo '      <p onclick="pridejMapu(event);">Mapa</p>';
        echo '      <p onclick="pridejInput(event);">Formulářovou položku</p>';
        echo '      <p onclick="pridejSelect(event);">Výběrovou nabídku</p>';
        echo '      <p onclick="pridejTlacitko(event);">Tlačítko odeslat</p>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="editobrazek">';
        echo '<h2>Obrázek</h2>';
        echo '<p class="txs_xs nadpis">Přetažením nahraj obrázek</p>';
        echo '<div class="upload" jmp="stranka" pre="stranka" fce="obrazek" ondrop="nahrajSoubor(event);"></div>';
        echo '<p class="txs_xs nadpis">Odkaz</p>';
        echo '<img src="img/iko_edit.svg" onclick="nabOdkazy(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="odkazSmaz(event);" />';
        echo '<p class="txs_xs nadpis">Posum / smazání</p>';
        echo '<img src="img/iko_nahoru.svg" onclick="blokNahoru(event);">';
        echo '<img src="img/iko_dolu.svg" onclick="blokDolu(event);">';
        echo '<img src="img/iko_smaz.svg" onclick="blokSmaz(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';


        echo '<div class="editpanel formular" id="editinput">';
        echo '    <h2>Form. položka</h2>';
        echo '    <p class="txs_xs nadpis">Typ položky</p>';
        echo '    <div class="typ">';
        echo '        <p hodnota="text" onclick="nastavTypInput(event);">Text</p>';
        echo '        <p hodnota="number" onclick="nastavTypInput(event);">Číslo</p>';
        echo '        <p hodnota="date" onclick="nastavTypInput(event);">Datum</p>';
        echo '        <p hodnota="email" onclick="nastavTypInput(event);">Email</p>';
        echo '        <p hodnota="password" onclick="nastavTypInput(event);">Heslo</p>';
        echo '        <p hodnota="checkbox" onclick="nastavTypInput(event);">ANO / NE</p>';
        echo '    </div>';
        echo '    <p class="txs_xs nadpis">Název položky</p>';
        echo '    <input type="text" onchange="inputnadpis(event);">';
        echo '    <div class=barvapole>';
        echo '        <p class="txs_xs nadpis">Povinné</p>';
        echo '        <div style="background-color:#FFF"; hodnota="N" onclick="nastavRequired(event);">X</div>';
        echo '        <div style="background-color:#FFF"; hodnota="A" onclick="nastavRequired(event);">A</div>';
        echo '    </div>';
        echo '    <p class="txs_xs nadpis">Šířka položky</p>';
        echo '    <div class="barvapole">';
        echo '        <div style="background-color:#FFF"; hodnota="w25po" onclick="nastavSirkuInput(event);">S</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w50po" onclick="nastavSirkuInput(event);">M</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w75po" onclick="nastavSirkuInput(event);">L</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w100po" onclick="nastavSirkuInput(event);">XL</div>';
        echo '    </div>';
        echo '    <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '    <img src="img/iko_nahoru.svg" onclick="blokNahoruInput(event);">';
        echo '    <img src="img/iko_dolu.svg" onclick="blokDoluInput(event);">';
        echo '    <img src="img/iko_smaz.svg" onclick="blokSmazInput(event);">';
        echo '    <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';


        echo '<div class="editpanel formular" id="editselect">';
        echo '    <h2>Form. položka</h2>';
        echo '    <p class="txs_xs nadpis">Název položky</p>';
        echo '    <input type="text" onchange="inputnadpis(event);">';
        echo '    <p class="txs_xs nadpis">Hodnoty</p>';
        echo '    <div id="optionshodnoty" onclick="deletehodnota(event);"></div>';
        echo '    <p class="txs_xs nadpis">Přidat hodnotu</p>';
        echo '    <input type="text" onchange="inputhodnota(event);">';
        echo '    <div class=barvapole>';
        echo '        <p class="txs_xs nadpis">Povinné</p>';
        echo '        <div style="background-color:#FFF"; hodnota="N" onclick="nastavRequired(event);">X</div>';
        echo '        <div style="background-color:#FFF"; hodnota="A" onclick="nastavRequired(event);">A</div>';
        echo '    </div>';
        echo '    <p class="txs_xs nadpis">Šířka položky</p>';
        echo '    <div class="barvapole">';
        echo '        <div style="background-color:#FFF"; hodnota="w25po" onclick="nastavSirkuInput(event);">S</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w50po" onclick="nastavSirkuInput(event);">M</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w75po" onclick="nastavSirkuInput(event);">L</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w100po" onclick="nastavSirkuInput(event);">XL</div>';
        echo '    </div>';
        echo '    <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '    <img src="img/iko_nahoru.svg" onclick="blokNahoruInput(event);">';
        echo '    <img src="img/iko_dolu.svg" onclick="blokDoluInput(event);">';
        echo '    <img src="img/iko_smaz.svg" onclick="blokSmazInput(event);">';
        echo '    <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';


        echo '<div class="editpanel formular" id="edittlacitko">';
        echo '    <h2>Form. tlačítko</h2>';
        echo '    <p class="txs_xs nadpis">Popis tlačítka</p>';
        echo '    <input type="text" onchange="tlacitkopopis(event);">';
        echo '    <p class="txs_xs nadpis">Šířka položky</p>';
        echo '    <div class="barvapole">';
        echo '        <div style="background-color:#FFF"; hodnota="w25po" onclick="nastavSirkuInput(event);">S</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w50po" onclick="nastavSirkuInput(event);">M</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w75po" onclick="nastavSirkuInput(event);">L</div>';
        echo '        <div style="background-color:#FFF"; hodnota="w100po" onclick="nastavSirkuInput(event);">XL</div>';
        echo '    </div>';
        echo '    <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '    <img src="img/iko_nahoru.svg" onclick="blokNahoruInput(event);">';
        echo '    <img src="img/iko_dolu.svg" onclick="blokDoluInput(event);">';
        echo '    <img src="img/iko_smaz.svg" onclick="blokSmazInput(event);">';
        echo '    <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="editform">';
        echo '    <h2>Formulář</h2>';
        echo '    <p class="txs_xs nadpis">Název formuláře</p>';
        echo '    <input type="text" onchange="formnazev(event);">';
        echo '    <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '    <img src="img/iko_nahoru.svg" onclick="blokNahoruInput(event);">';
        echo '    <img src="img/iko_dolu.svg" onclick="blokDoluInput(event);">';
        echo '    <img src="img/iko_smaz.svg" onclick="blokSmazInput(event);">';
        echo '    <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';



        echo '<div class="editpanel formular" id="editnadpis">';
        echo '<h2>Nadpis</h2>';
        echo '  <div class="barvapole">';
        echo '      <p class="txs_xs nadpis">Barva textu</p>';
        echo '      <div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuTextu(event);">X</div>';
        echo '      <div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Velikost nadpisu</p>';
        echo '  <div class="typ">';
        echo '      <p typ="H1" onclick="nastavTagPrvku(event);">H1</p>';
        echo '      <p typ="H2" onclick="nastavTagPrvku(event);">H2</p>';
        echo '      <p typ="H3" onclick="nastavTagPrvku(event);">H3</p>';
        echo '      <p typ="H4" onclick="nastavTagPrvku(event);">H4</p>';
        echo '      <p typ="H5" onclick="nastavTagPrvku(event);">H5</p>';
        echo '      <p typ="H6" onclick="nastavTagPrvku(event);">H6</p>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">zarování textu</p>';
        echo '  <img src="img/iko_textlevo.svg" typ="tal", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textstred.svg" typ="tac", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textpravo.svg" typ="tar", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_nahoru.svg" onclick="blokNahoru(event);" />';
        echo '  <img src="img/iko_dolu.svg" onclick="blokDolu(event);" />';
        echo '  <img src="img/iko_smaz.svg" onclick="blokSmaz(event);" />';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editpanel formular" id="edittext">';
        echo '<h2>Text</h2>';
        echo '  <div class="barvapole">';
        echo '      <p class="txs_xs nadpis">Barva textu</p>';
        echo '      <div style="background-color:#FFF"; barva="transaprent" onclick="nastavBarvuTextu(event);">X</div>';
        echo '      <div style="background-color:#FFF"; barva="bila" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#ecebe8"; barva="seda" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#7bc2f5"; barva="bledemodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '      <div style="background-color:#005897"; barva="tmavomodra" onclick="nastavBarvuTextu(event);"></div>';
        echo '  </div>';
        echo '  <p class="txs_xs nadpis">Zarování textu</p>';
        echo '  <img src="img/iko_textlevo.svg" typ="tal", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textstred.svg" typ="tac", onclick="nastavZarovnaniTextu(event);" />';
        echo '  <img src="img/iko_textpravo.svg" typ="tar", onclick="nastavZarovnaniTextu(event);" />';

        echo '  <p class="txs_xs nadpis">Velikost textu</p>';
        echo '  <div class="barvapole">';
        echo '      <div style="background-color:#FFF"; hodnota="txs_xs" onclick="nastavVelikostTextu(event);">XS</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_s" onclick="nastavVelikostTextu(event);">S</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_m" onclick="nastavVelikostTextu(event);">M</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_l" onclick="nastavVelikostTextu(event);">L</div>';
        echo '      <div style="background-color:#FFF"; hodnota="txs_xl" onclick="nastavVelikostTextu(event);">XL</div>';
        echo '  </div>';

        echo '<p class="txs_xs nadpis">Odkaz</p>';
        echo '<img src="img/iko_edit.svg" onclick="nabOdkazy(event);">';
        echo '  <img src="img/iko_zavrit.svg" onclick="odkazSmaz(event);" />';

        echo '  <p class="txs_xs nadpis">Posum / smazání</p>';
        echo '  <img src="img/iko_nahoru.svg" onclick="blokNahoru(event);" />';
        echo '  <img src="img/iko_dolu.svg" onclick="blokDolu(event);" />';
        echo '  <img src="img/iko_smaz.svg" onclick="blokSmaz(event);" />';
        echo '  <img src="img/iko_zavrit.svg" onclick="zavriPanel(event);" />';
        echo '</div>';

        echo '<div class="editstranka formular" id="editstranka">';
        echo '  <p class="txs_xs nadpis">Název stránky</p>';
        echo '<input type="text">';
        echo '  <div class="barvapole">';
        echo '  <img src="img/iko_strankaseznam.svg" onclick="strankaSeznam(event);" class="fc"/>';
        echo '  <img src="img/iko_strankapridej.svg" onclick="strankaPridej(event);" />';
        echo '  <img src="img/iko_strankakopy.svg" onclick="strankaKopy(event);" />';
        echo '  <img src="img/iko_strankauloz.svg" onclick="strankaUloz(event);" />';
        echo '</div>';
        echo '</div>';

        echo '<div class="nabidka stin" id="nabidka"></div>';
    }

}
