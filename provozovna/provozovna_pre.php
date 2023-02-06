<?php


include_once( "presenter.php" );
class provozovna_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("provozovna", "provozovna_ser", "provozovna_ser");
        $this->template = $this->vratObjekt("provozovna", "provozovna_tem", "provozovna_tem");
    }
    
    
    public function seznam($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["str"] = $param["str"];
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisSeznam($templPar);
        
    }
    
    public function polozka($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["id"] = $param["id"];
        $temPar["data"] = $this->service->ctiPolozku($servPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $kraPar["order"] = "kra.id";
        $temPar["kraje"] = $this->nactiSeznam("stranka", "stranka_rep", "kat_kraje_kat_rep",$kraPar);
        $this->template->pisPolozku($temPar);
    }
    
    public function novpolozka($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $kraPar["order"] = "kra.id";
        $temPar["kraje"] = $this->nactiSeznam("stranka", "stranka_rep", "kat_kraje_kat_rep",$kraPar);
        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $this->service->uloz($param["form"]["polozka"]);
        
        $vys = array('typ' => 'stranka', 'data' => "./?provozovna/seznam/str=".$param["str"]);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }
    

    public function smazpolozka($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $serPar["id"] = $param["id"];
        $this->service->smazpolozka($serPar);
        
        $sezPar["str"] = $param["str"];
        $this->seznam($sezPar);
    }
    
    public function vypis($param){
         $servPar["str"] = 0;
         $servPar["poc"] = 999;
         $servPar["order"] = "pro.kraj_id, pro.mesto";
        $templPar["data"] = $this->service->seznam($servPar);
        $krajPar["order"] = "kra.nazev";
        $templPar["kraje"] = $this->nactiSeznam("stranka","stranka_rep","kat_kraje_kat_rep",$krajPar);
        $templPar["kraje"] = $this->service->aktivnikraje(null);
        $templPar["str"] = $param["str"];
        $this->template->vypis($templPar);
    }
    
    public function napsat($param){
        $this->template->napsat($param);
    }
    
    public function odeslat($param){
       $this->service->odeslat($param); 
    }
}