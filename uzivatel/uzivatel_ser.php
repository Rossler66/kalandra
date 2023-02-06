<?php

include_once( "service.php" );

class uzivatel_ser extends service {

    public function prihlasit($param) {
//        $_SESSION["uzivId"] = 1;
//        $_SESSION["opravneni"] = "AAAAAAAAAA";
//        return 1;
        $asQ = 'SELECT * FROM uzi_uzivatel_zaz WHERE  login = "' . $param["jmeno"] . '"';

        $qUzi = db::query($asQ);
        if ($pUzi = $qUzi->fetch_assoc()) {
            $log = true;
        }else{
            return -1;
        }

        if ($pUzi == null) {
            return -2;
        }

        if ($qUzi->num_rows != 1) {
            return -3;
        }
        $heslo = $this->hesloCrypt($param["heslo"]);
        
        if ($heslo != $pUzi["heslo"]) {
            return -4;
        }
        $_SESSION["uzivId"] = $pUzi["id"];
        $_SESSION["opravneni"] = $pUzi["opravneni"];
        return 1;
    }

    public function seznam($param) {
        $sezPar["order"] = "jmeno";
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }
        return $this->nactiSeznam("uzivatel", "uzivatel_rep", "uzi_uzivatel_zaz_rep", $sezPar);
    }

    public function ctiPolozku($param) {
        $sezPar["where"] = "uzi.id = " . $param["id"];
        return $this->nactiSeznam("uzivatel", "uzivatel_rep", "uzi_uzivatel_zaz_rep", $sezPar);
    }

    public function novPolozka($param) {
        $polozkaRep = $this->vratObjekt("uzivatel", "uzivatel_rep", "uzi_uzivatel_zaz_rep");
        return $polozkaRep->vratEntitu(null);
    }

    private function hesloCrypt($heslo) {
        return crypt($heslo, '$6$rounds=5000$JUxtHKlCXN5YvvKr6qrlXCPYpR74ZE4pIwfwjrT1iWKFH1ouWALt13zRUPaUJiTvqCHtmizjIJC6bMhz1ZRQoyu5EqNCp5SbJIqCzf8');
    }

    public function uloz($param) {
        $polozkaRep = $this->vratObjekt("uzivatel", "uzivatel_rep", "uzi_uzivatel_zaz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);

        $opravneni = "";
        if(array_key_exists("opr_uzivatele",$param)){$opravneni .= $param["opr_uzivatele"];}
        if(array_key_exists("opr_dokumenty",$param)){$opravneni .= $param["opr_dokumenty"];}
        if(array_key_exists("opr_stranky",$param)){$opravneni .= $param["opr_stranky"];}
        if(array_key_exists("opr_pobocky",$param)){$opravneni .= $param["opr_pobocky"];}
        if(array_key_exists("opr_pobocka",$param)){$opravneni .= $param["opr_pobocka"];}

        $polozkaEnt[0]["uzi"]->opravneni = $opravneni;

        if ($polozkaEnt[0]["uzi"]->heslo != "") {
            $polozkaEnt[0]["uzi"]->heslo = $this->hesloCrypt($polozkaEnt[0]["uzi"]->heslo);
            $polozky = array("login", "heslo", "jmeno", "opravneni", "email");
        } else {
            $polozky = array("login", "jmeno", "opravneni", "email");
        }
        $polozkaRep->uloz($polozkaEnt[0]["uzi"], "uzi",$polozky);
        return $polozkaEnt;
    }

    public function obnheslo($param) {
        $asQ = 'SELECT * FROM uzi_uzivatel_zaz WHERE  email = "' . $param["email"] . '"';
        $qUzi = db::query($asQ);
        $pUzi = $qUzi->fetch_assoc();

        if ($pUzi == null) {
            return -2;
        }

        if ($qUzi->num_rows != 1) {
            return -3;
        }
        $tiket = $pUzi["id"]."*";
        for ($ii = 0; $ii < 16; $ii++) {
            $tiket = $tiket . chr(rand(97, 122));
        }

        $asQ = "UPDATE uzi_uzivatel_zaz SET tiket = '" . $tiket . "', cas_limit ='" . date("Y-m-d H:i", strtotime("+6 hours")) . "' WHERE id = " . $pUzi["id"];
        db::query($asQ);

        $obsah = "Vážená paní, vážený pane<br/><br/>zaznamenali jsme žádost o obnovu vašeho hesla do stánek bohemika.eu. <br/>"
                . "Pokud jste tuto žádost nevtvořil/a, považujte tento e-mail za bezpředmětný.<br/>"
                . "Odkaz pro obnovu hesla je zde:<br />"
                . "http://bohemika.eu/web/?uzivatel/obnovheslo/tiket=" . $tiket
                . "<br/> na odkaz klikněte, nebo jej zkopírujte do adresního řádku webového prohlížeče.<br/><br/>"
                . " S přáním hezkého dne<br />BOHEMIKA";
        $emailPar["soubor"] = "";
        $emailPar["souborNazev"] = "";
        $emailPar["odesilatelJmeno"] = "BOHEMIKA - neodpovídat";
        $emailPar["odesilatel"] = "noreply@bohemika.eu";
        $emailPar["obsah"] = $obsah;
        $emailPar["prijemce"] = $param["email"];
        $emailPar["predmet"] = "BOHEMIKA.EU  - OBNOVA HESLA ";

        if ($this->amail($emailPar)) {
            return 1;
        } else {
            return -4;
        }
    }

    public function obnovheslo($param) {
        if(strlen($param["tiket"]) < 16){
            return -1;
        }
        $asQ = "SELECT * FROM uzi_uzivatel_zaz WHERE tiket = '" . $param["tiket"] . "'";
        $qUzi = db::query($asQ);
        $pUzi = $qUzi->fetch_assoc();
        if ($pUzi == null) {
            return -2;
        }

        if ($qUzi->num_rows != 1) {
            return -3;
        }
        
        if( strtotime($pUzi["cas_limit"]) < strtotime(date("Y-m-d H:i"))){
            return -4;
        }
        $_SESSION["uzivId"] = $pUzi["id"];
        $_SESSION["opravneni"] = $pUzi["opravneni"];
        return 1;
    }
    
    public function noveheslo($param){
        if($_SESSION["uzivId"] > 0){
            $heslo = $this->hesloCrypt($param["form"]["zapheslo"]["heslo"]);
            $asQ = "UPDATE uzi_uzivatel_zaz SET heslo = '".$heslo."', tiket='' WHERE id=".$_SESSION["uzivId"];
            $sou = fopen('log.txt', 'a');
            fwrite($sou, "heslo\r\n".$heslo.":" . $asQ . "\r\n\r\n");
            fclose($sou);
            
            db::query($asQ);
        }
    }

}
