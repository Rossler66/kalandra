<?php


include_once("presenter.php");
class dokumentytypy_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("dokumentytypy", "dokumentytypy_ser", "dokumentytypy_ser");
        $this->template = $this->vratObjekt("dokumentytypy", "dokumentytypy_tem", "dokumentytypy_tem");
    }


    public function seznam($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["str"] = $param["str"];
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisSeznam($templPar);
    }

    public function polozka($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["id"] = $param["id"];
        $temPar["data"] = $this->service->ctiPolozku($servPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];

        $this->template->pisPolozku($temPar);
    }

    public function novpolozka($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];

        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $dokument = $this->service->uloz($param["form"]["polozka"]);
        $vys = array('typ' => 'stranka', 'data' => "./?dokumentytypy/seznam/str=".$param["str"]);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }


    public function smazpolozka($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $serPar["id"] = $param["id"];
        $this->service->smazpolozka($serPar);
        $sezPar["str"] = $param["str"];
        $this->seznam($sezPar);
    }

}