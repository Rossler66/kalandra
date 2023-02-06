<?php

include_once( "service.php" );

class stranka_ser extends service{
    //put your code here
    
    public function stranka($param){
        $qHla = "SELECT * FROM web_stranka_zaz WHERE ";
        
        $odd = "";
        if($param["typ"] != ""){
            $qHla .= $odd." typ='".$param["typ"]."'";
            $odd = " AND ";
        }
        if($param["id"] > 0){
            $qHla .= $odd."id='".$param["id"]."'";
            $odd = " AND ";
        }
        $pHla = db::query($qHla);
        $dHla = $pHla->fetch_assoc();
        return $dHla;
        
    }
    
    public function nabStranky($param) {
        $qStr = "SELECT * FROM web_stranka_zaz WHERE typ='T' OR typ='S' ORDER BY nazev ";
        $pStr = db::query($qStr);


        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Editace stránky<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';

        $vys .= '<table>';
        while ($dStr = $pStr->fetch_assoc()) {
            $vys .= '<tr><td><a href="?stranka/editor/id='.$dStr["id"].'" class="tlacitko">' . $dStr["nazev"] . '</td></tr>';
        }
        $vys .= '</table>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }


    public function nabOdkazy($param) {
        $qStr = "SELECT * FROM web_stranka_zaz WHERE typ='T' OR typ='S' ORDER BY nazev ";
        $pStr = db::query($qStr);


        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Odkaz na stránku<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';

        $vys .= '<table>';
        while ($dStr = $pStr->fetch_assoc()) {
            $odkaz = '?stranka/obsah/id='.$dStr["id"];
            $vys .= '<tr><td><a   onclick="vlozOdkaz(event,\''.$odkaz.'\');" class="tlacitko">' . $dStr["nazev"] . '</a></td></tr>';
        }

        $odkaz = '?provozovna/vypis/str=1';
        $vys .= '<tr><td><a   onclick="vlozOdkaz(event,\''.$odkaz.'\');" class="tlacitko">Pobočky</a></td></tr>';

        $vys .= '<tr><td><input type="text" placeholder="URL jako odkaz" id="odkazURL"><a   onclick="vlozOdkazURL(event);" class="tlacitko">vlož URL jako odkaz</a></td></tr>';
        $vys .= '</table>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

    public function ulozstranku($param) {
        if ($param["id"] > 0) {
            $asQ = 'UPDATE web_stranka_zaz SET nazev="' . db::escape($param["nazev"]) . '", obsah="' . db::escape($param["obsah"]) . '" WHERE id = ' . db::escape($param["id"]);
            db::query($asQ);
            $id = $param["id"];
        } else {
            $asQ = 'INSERT INTO web_stranka_zaz (typ,nazev,obsah) values ("S","' . db::escape($param["nazev"]) . '","' . db::escape($param["obsah"]) . '")';
            db::query($asQ);
            $id = db::insertId();
            return $id;
        }
    }

    public function nactistranku($param){
        $qStr = "SELECT * FROM web_stranka_zaz WHERE id = ".db::escape($param["id"]);
        $pStr = db::query($qStr);
        
        $dStr = $pStr->fetch_assoc();
        $vystup["id"] = $dStr["id"];
        $vystup["nazev"] = $dStr["nazev"];
        $vystup["obsah"] = $dStr["obsah"];

        $vys = array('typ' => 'zobrazstranku', 'data' => $vystup);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
        
    }
}
