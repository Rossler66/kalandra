<?php


include_once( "presenter.php" );
class dokumentysou_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("dokumentysou", "dokumentysou_ser", "dokumentysou_ser");
        $this->template = $this->vratObjekt("dokumentysou", "dokumentysou_tem", "dokumentysou_tem");
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

        $nazvyPar["order"] = "naz.nazev";
        $nazvyPar["limit"] = 999;
        $temPar["nazvy"] = $this->nactiSeznam("stranka","stranka_rep","web_dokumenty_naz_rep",$nazvyPar);
        $this->template->pisPolozku($temPar);
    }
    
    public function novpolozka($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $nazvyPar["order"] = "naz.nazev";
        $nazvyPar["limit"] = 999;
        $temPar["nazvy"] = $this->nactiSeznam("stranka","stranka_rep","web_dokumenty_naz_rep",$nazvyPar);

        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $dokument = $this->service->uloz($param["form"]["polozka"]);
        $vys = array('typ' => 'stranka', 'data' => "./?dokumentysou/seznam/str=".$param["str"]);
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

    public function soubor($param){
        if(strpos($_SESSION["opravneni"],"2") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $souborSer = $this->vratObjekt("soubor", "soubor_ser", "soubor_ser");
        $soubor = $souborSer->nahraj($param);
        $data["id"] = "dok_souborId";
        $data["value"] = $soubor["id"];
        $vys = array('typ' => 'setvalue', 'data' => $data);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";

    }

    public function platne($param){
        $servPar["str"] = $param["str"];
        $servPar["where"] = "dok.platny = 'A'";
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisHistorie($templPar);
    }


    public function historie($param){
        $servPar["str"] = $param["str"];
        $servPar["where"] = "dok.platny != 'A'";
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisHistorie($templPar);
    }

}