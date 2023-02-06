<?php


include_once( "presenter.php" );
class menu_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("menu", "menu_ser", "menu_ser");
        $this->template = $this->vratObjekt("menu", "menu_tem", "menu_tem");
    }
    
    
    public function seznam($param){
        $servPar["str"] = $param["str"];
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisSeznam($templPar);
        
    }
    
    public function polozka($param){
        $servPar["id"] = $param["id"];
        $temPar["data"] = $this->service->ctiPolozku($servPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $strankyPar["order"] = "str.nazev";
        $temPar["stranky"] = $this->nactiSeznam("stranka", "stranka_rep", "web_stranka_zaz_rep", $strankyPar);
        $this->template->pisPolozku($temPar);
    }
    
    public function novpolozka($param){
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $strankyPar["order"] = "str.nazev";
        $temPar["stranky"] = $this->nactiSeznam("stranka", "stranka_rep", "web_stranka_zaz_rep", $strankyPar);
        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        $this->service->uloz($param["form"]["polozka"]);
        
        $vys = array('typ' => 'stranka', 'data' => "./?menu/seznam/str=".$param["str"]);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }
    

    public function smazpolozka($param){
        $serPar["id"] = $param["id"];
        $this->service->smazpolozka($serPar);
        
        $sezPar["str"] = $param["str"];
        $this->seznam($sezPar);
    }
}