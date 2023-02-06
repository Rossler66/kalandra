<?php

include_once( "template.php" );

class provozovna_tem extends template {

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?provozovna/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?provozovna/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?provozovna/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Město</th><th class="tal">Ulice</th><th class="tal">Zástupce</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["pro"]->mesto . '</td><td>' . $rad["pro"]->ulice . '</td><td>' . $rad["pro"]->zastupce . '</td>'
            . '<td><div class="volbysez"><a href="?provozovna/polozka/id=' . $rad["pro"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>'
            . '<a href="?provozovna/smazpolozka/id=' . $rad["pro"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>'
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
        echo '          <h2 class="col_tmavabarva">Provozovna<a href="?provozovna/seznam/str=' . $param["str"] . '"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Zástupce (jméno a příjmení)</div>';
        echo '              <input type="text" class="w100p" name="pro_zastupce" value="' . $param["data"][0]["pro"]->zastupce . '" />';
        echo '              <div class="nav">Kraj</div>';
        echo '              <select name="pro_krajId" class="w100p" >';

        foreach ($param["kraje"] as $kraj) {
            if ($kraj["kra"]->id == $param["data"][0]["pro"]->krajId) {
                $sel = "SELECTED";
            } else {
                $sel = "";
            }
            echo '              <option value="' . $kraj["kra"]->id . '" ' . $sel . ' >' . $kraj["kra"]->nazev . '</option>';
        }
        echo '              </select>';


        echo '              <div class="nav">Město</div>';
        echo '              <input type="text" class="w100p" name="pro_mesto" value="' . $param["data"][0]["pro"]->mesto . '" />';
        echo '              <div class="nav">PSČ </div>';
        echo '              <input type="text" class="w100p" name="pro_psc" value="' . $param["data"][0]["pro"]->psc . '" />';
        echo '              <div class="nav">Ulice a číslo popisné</div>';
        echo '              <input type="text" class="w100p" name="pro_ulice" value="' . $param["data"][0]["pro"]->ulice . '" />';
        echo '              <div class="nav">Telefon</div>';
        echo '              <input type="text" class="w100p" name="pro_telefon" value="' . $param["data"][0]["pro"]->telefon . '" />';
        echo '              <div class="nav">Email </div>';
        echo '              <input type="text" class="w100p" name="pro_email" value="' . $param["data"][0]["pro"]->email . '" />';
        echo '              <div class="nav">Otevřeno PO</div>';
        echo '              <input type="text" class="w100p" name="pro_provozPo" value="' . $param["data"][0]["pro"]->provozPo . '" />';
        echo '              <div class="nav">Otevřeno ÚT</div>';
        echo '              <input type="text" class="w100p" name="pro_provozUt" value="' . $param["data"][0]["pro"]->provozUt . '" />';
        echo '              <div class="nav">Otevřeno ST</div>';
        echo '              <input type="text" class="w100p" name="pro_provozSt" value="' . $param["data"][0]["pro"]->provozSt . '" />';
        echo '              <div class="nav">Otevřeno ČT</div>';
        echo '              <input type="text" class="w100p" name="pro_provozCt" value="' . $param["data"][0]["pro"]->provozCt . '" />';
        echo '              <div class="nav">Otevřeno PÁ</div>';
        echo '              <input type="text" class="w100p" name="pro_provozPa" value="' . $param["data"][0]["pro"]->provozPa . '" />';
        echo '              <div class="nav">Otevřeno SO</div>';
        echo '              <input type="text" class="w100p" name="pro_provozSo" value="' . $param["data"][0]["pro"]->provozSo . '" />';
        echo '              <div class="nav">Otevřeno NE</div>';
        echo '              <input type="text" class="w100p" name="pro_provozNe" value="' . $param["data"][0]["pro"]->provozNe . '" />';
        echo '              <div class="nav">Poznámka</div>';
        echo '              <input type="text" class="w100p" name="pro_poznamka" value="' . $param["data"][0]["pro"]->poznamka . '" />';

        echo '              <input type="hidden" name="pro_id" value="' . $param["data"][0]["pro"]->id . '" />';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="provozovna" pre="provozovna" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

    public function vypis($param) {
        echo '<div class="block  block_standard bcg_pozadi">';
        echo '<div class="container" >';
        echo '<h1 class="col_tmavomodra">Pobočky Bohemika</h1>';
        echo '<div class="provnab">';
        foreach ($param["kraje"] as $kraj){
            echo '<a href="#kraj'.$kraj["kra"]->id.'">'.$kraj["kra"]->nazev.'</a>';

        }
        echo '</div>';
        $kraj = 0;
        foreach ($param["data"] as $rad) {
            if ($kraj != $rad["pro"]->krajId) {
                $kraj = $rad["pro"]->krajId;
                echo '<div class="pole pole1 poleL">';
                echo '<h2 class="col_tmavomodra nadpiskraj" id="kraj'.$rad["kra"]->id.'">kraj ' . $rad["kra"]->nazev . '</h2>';
                echo '</div>';
            }
            $adresa = 'https://www.google.cz/maps/dir//'.$rad["pro"]->ulice.'+'.$rad["pro"]->psc.'+'.$rad["pro"]->mesto;
            echo '<div class="pole pole3 poleL stin provozovna zoom">';
            echo '<a class="pro_trasa" href="'.$adresa.'" target="_blank">trasa</a>';
            echo '<div class="pro_mesto">' . $rad["pro"]->mesto . '</div>';
            echo '<div class="pro_ulice">' . $rad["pro"]->ulice . '</div>';
            echo '<div class="pro_zastupce">' . $rad["pro"]->zastupce . '</div>';
//            echo '<div class="pole pole2 poleL fl">';
            echo '<div class="pro_telefon"><a href="tel:http://'.$rad["pro"]->telefon.'">' . $rad["pro"]->telefon . '</a></div>';
            echo '<div class="pro_email"><a href="mailto:'.$rad["pro"]->email.'">' . $rad["pro"]->email . '</a></div>';
            if($rad["pro"]->poznamka > " ") {
                echo '<div class="pro_poznamka">' . $rad["pro"]->poznamka . '</div>';
            }
//            echo '</div>';
/*
            echo '<div class="pole pole2 poleL fl">';
            if(trim($rad["pro"]->provozPo)) {echo '<div class="pro_doba"><div>Po</div>' . $rad["pro"]->provozPo . '</div>';}
            if(trim($rad["pro"]->provozUt)) {echo '<div class="pro_doba"><div>Út</div>' . $rad["pro"]->provozUt . '</div>';}
            if(trim($rad["pro"]->provozSt)) {echo '<div class="pro_doba"><div>St</div>' . $rad["pro"]->provozSt . '</div>';}
            if(trim($rad["pro"]->provozCt)) {echo '<div class="pro_doba"><div>Čt</div>' . $rad["pro"]->provozCt . '</div>';}
            if(trim($rad["pro"]->provozPa)) {echo '<div class="pro_doba"><div>Pá</div>' . $rad["pro"]->provozPa . '</div>';}
            if(trim($rad["pro"]->provozSo)) {echo '<div class="pro_doba"><div>So</div>' . $rad["pro"]->provozSo . '</div>';}
            if(trim($rad["pro"]->provozNe)) {echo '<div class="pro_doba"><div>Ne</div>' . $rad["pro"]->provozNe . '</div>';}
            echo '</div>';
/*
            echo '<div class="tlacpas fc">';
            echo '<div><a href="'.$adresa.'" target="_blank">Trasa</a></div>';
            echo '<div><a href="#" jmp="provozovna" pre="provozovna" fce="napsat" par="id='.$rad["pro"]->id.'" onclick="posli(event);">Napište mi</a></div>';
            echo '</div>';
*/
            echo '</div>';
        }
        echo '</div>';
        echo '</div>';
    }

    
    public function napsat($param){
        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Napište mi<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <form name="zprava">';
        $vys .= '       <div class="nav">Váš e-mail</div>';
        $vys .= '       <input type="text" name="email" />';
        $vys .= '       <div class="nav">Váš telefon</div>';
        $vys .= '       <input type="text" name="telefon" />';
        $vys .= '       <div class="nav">Váše jméno</div>';
        $vys .= '       <input type="text" name="jmeno" />';
        $vys .= '       <div class="nav">Napiště prosím vzkaz</div>';
        $vys .= '       <textarea name="vzkaz" ></textarea>';
        $vys .= '       <input type="hidden" name="id" value="'.$param["id"].'" />';
        $vys .= '   </form>';
        $vys .= '   <div class="tlacpas">';
        $vys .= '       <input type="button" class="tlacitko" value="Odeslat" jmp="provozovna" pre="provozovna" fce="odeslat" form="zprava" onclick="posli(event);" />';
        $vys .= '   </div>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
        
    }
    
}

//https://www.google.cz/maps/dir//Divadeln%C3%AD+Restaurace+Benar,+Rooseveltova+279,+436+01+Litv%C3%ADnov/@50.6011573,13.6168698,15z/data=!4m9!4m8!1m0!1m5!1m1!1s0x4709f4f9e5567d4b:0x60b5a97f2c47c881!2m2!1d13.6112699!2d50.6005651!3e0?hl=cs&authuser=0
