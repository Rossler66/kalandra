<?php


include_once("presenter.php");
class spoluprace_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("spoluprace", "spoluprace_ser", "spoluprace_ser");
        $this->template = $this->vratObjekt("spoluprace", "spoluprace_tem", "spoluprace_tem");
    }


    public function seznam($param){
        if(strpos($_SESSION["opravneni"],"5") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["str"] = $param["str"];
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisSeznam($templPar);
    }

    public function polozka($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["id"] = $param["id"];
        $temPar["data"] = $this->service->ctiPolozku($servPar);
        $provPar["order"] = "pro.mesto, pro.zastupce";
        $provPar["limit"] = 999;
        $temPar["provozovny"] = $this->nactiSeznam("stranka","stranka_rep","web_provozovna_zaz_rep",$provPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];

        $this->template->pisPolozku($temPar);
    }

    public function novpolozka($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $provPar["order"] = "pro.mesto, pro.zastupce";
        $provPar["limit"] = 999;
        $temPar["provozovny"] = $this->nactiSeznam("stranka","stranka_rep","web_provozovna_zaz_rep",$provPar);

        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $dokument = $this->service->uloz($param["form"]["polozka"]);
        $vys = array('typ' => 'stranka', 'data' => "./?spoluprace/seznam/str=".$param["str"]);
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

    public function vypis($param){
        $servPar["str"] = 0;
        $templPar["data"] = $this->service->seznam($servPar);
        $this->template->vypis($templPar);
    }

}