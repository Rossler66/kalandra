<?php

include_once( "presenter.php" );

class stranka_pre extends presenter {

    private $pre = null;
    private $fce = null;
    private $par = array();
    private $skripty = "";
//put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("stranka", "stranka_ser", "stranka_ser");
        $this->template = $this->vratObjekt("stranka", "stranka_tem", "stranka_tem");
    }

    public function vstup($param) {
        if ($param) {
            $par = explode("/", $_SERVER['QUERY_STRING']);
            if (array_key_exists(0, $par) && $par[0]) {
                $this->pre = $par[0];
            } else {
                $this->pre = null;
            }

            if (array_key_exists(1, $par) && $par[1]) {
                $this->fce = $par[1];
            } else {
                $this->fce = null;
            }

            if (array_key_exists(2, $par) && $par[2]) {
                $parametry = $par[2];
                @ $parPol = explode(",", $parametry);
                foreach ($parPol as $pol) {
                    $keyhod = explode("=", $pol);
                    if (count($keyhod) == 2)
                        $this->par[$keyhod[0]] = $keyhod[1];
                }
            }else {
                $this->par = null;
            }
        }
        if ($this->pre == null || $this->fce == null) {
            $this->pre = "stranka";
            $this->fce = "obsah";
            $this->par["typ"] = "T";
            $this->par["id"] = 0;
        }
    }

    public function hlavickaZacatek($param){
        $this->template->hlavickaZacatek(null);
    }

    public function hlavickaKonec($param){
        $this->template->hlavickaKonec(null);
    }

    public function vypis() {
        if (array_key_exists("cook", $this->par) && $this->par["cook"] == "set") {
            $cookTem = $this->vratObjekt("cookies", "cookies_tem", "cookies_tem");
            $cookTem->cokNastav();
        }
        echo '<div id="strzahlaviobs"></div>';
        echo '<div class="strzahlavi" id="strzahlavi">';
        $this->zahlavi(null);
        echo '</div>';

        echo '<div class="stranka" id="stranka">';

        if ($this->pre == "stranka") {
            $fce = $this->fce;
            $this->$fce($this->par);
        } else {
            include_once $this->pre . '/' . $this->pre . '_pre.php';
            $asPre = $this->pre . "_pre";
            $prezent = new $asPre();
            $fce = $this->fce;
            $prezent->$fce($this->par);
        }
        $this->zapati(null);

        echo '</div>';
    }

    public function zahlavi($param) {
        /*
          $strankaPar["typ"] = "H";
          $strankaPar["id"] = 0;
          $obsahPar = $this->service->stranka($strankaPar);
          $obsahPar["class"] = "zahlavi";
          $obsahPar["obsahId"] = "zahlavi";
          $this->template->obsah($obsahPar);
         * 
         */
        $sezPar["where"] = 'men.menu_kod = "H"';
        $zahPar["menhor"] = $this->nactiSeznam("menu", "menu_rep", "web_menu_zaz_rep", $sezPar);
        $sezPar["where"] = 'men.menu_kod = "D"';
        $zahPar["mendol"] = $this->nactiSeznam("menu", "menu_rep", "web_menu_zaz_rep", $sezPar);
        $this->template->zahlavi($zahPar);
    }

    public function obsah($param) {
        if ($this->pre == "stranka") {
            if (array_key_exists("typ", $param)) {
                $strankaPar["typ"] = $param["typ"];
            } else {
                $strankaPar["typ"] = "";
            }
            if (array_key_exists("id", $param)) {
                $strankaPar["id"] = $param["id"];
            } else {
                $strankaPar["id"] = 0;
            }
            $obsahPar = $this->service->stranka($strankaPar);
            $obsahPar["class"] = "obsah";
            $obsahPar["obsahId"] = "obsah";
            $this->template->obsah($obsahPar);
        }
    }

    public function zapati($param) {
        $sezPar["where"] = "men.menu_kod='Z'";
        $sezPar["order"] = "men.id";
        $zapPar["nabidka"] = $this->nactiSeznam("menu", "menu_rep", "web_menu_zaz_rep", $sezPar);
        $sezPar["where"] = 'dok.platny="A"';
        $sezPar["order"] = "naz.nazev";
        $zapPar["dokumenty"] = $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_soubor_rep", $sezPar);
        $this->template->zapati($zapPar);
    }

    public function editor($param) {
        if(strpos($_SESSION["opravneni"],"3") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        if (array_key_exists("typ", $param) && $param["typ"]) {
            $obsPar["typ"] = $param["typ"];
        } else {
            $obsPar["typ"] = "";
        }
        $obsPar["id"] = $param["id"];
        $this->obsah($obsPar);
        $this->template->editorBlok(null);
        $this->skripty .= '<script src = "editace.js"></script><script>editmod();</script>';
    }

    public function ulozstranku($param) {
        if(strpos($_SESSION["opravneni"],"3") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $editorPar["id"] = $this->service->ulozstranku($param);
        $editorPar["typ"] = "";
        $this->editor($editorPar);
    }

    public function obrazek($data) {
        if(strpos($_SESSION["opravneni"],"3") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $souborSer = $this->vratObjekt("soubor", "soubor_ser", "soubor_ser");
        $soubor = $souborSer->nahraj($data);

        $vys = array('typ' => 'soubor', 'data' => $soubor);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

    public function obrazekpole($data) {
        if(strpos($_SESSION["opravneni"],"3") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $souborSer = $this->vratObjekt("soubor", "soubor_ser", "soubor_ser");
        $soubor = $souborSer->nahraj($data);

        $vys = array('typ' => 'souborpole', 'data' => $soubor);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }


    public function paticka($param) {
        echo '<div id="editbod" jmp="uzivatel" pre="uzivatel" fce="prihlaseni" onclick="posli(event);"></div>';
        echo '<div id="dialog"></div>';
        echo '</body>';
        echo '<script src="prostredi.js"></script>';
        echo '<script src="komunikator.js"></script>';
        echo '<script src="editace.js"></script>';
        echo '<script>dragmod()</script>';
        echo $this->skripty;
        echo '</html>';
    }

    public function nabStranky($param) {
        if(strpos($_SESSION["opravneni"],"3") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $this->service->nabStranky($param);
    }

    public function nabOdkazy($param) {
        $this->service->nabOdkazy($param);
    }

}
