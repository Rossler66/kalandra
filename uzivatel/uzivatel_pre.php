<?php


include_once( "presenter.php" );
class uzivatel_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("uzivatel", "uzivatel_ser", "uzivatel_ser");
        $this->template = $this->vratObjekt("uzivatel", "uzivatel_tem", "uzivatel_tem");
    }
    
    public function prihlaseni($param) {
        if (array_key_exists("uzivId",$_SESSION) && $_SESSION["uzivId"] > 0) {
           $this->template->volbyUziv(null);
        }else{
            $this->template->formPrihlaseni(null);
        }
    }
    
    public function prihlasit($param){
       $servPar["jmeno"] = $param["form"]["prihlaseni"]["login"]; 
       $servPar["heslo"] = $param["form"]["prihlaseni"]["password"]; 
       $res = $this->service->prihlasit($servPar);
       if($res < 0){
           $this->template->chybnePrihlaseni($res);
       }else{
           $this->template->volbyUziv(null);
       }
    }
    
    public function seznam($param){
        if(strpos($_SESSION["opravneni"],"1") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["str"] = $param["str"];
        $templPar["data"] = $this->service->seznam($servPar);
        $templPar["str"] = $param["str"];
        $this->template->pisSeznam($templPar);
        
    }
    
    public function polozka($param){
        if(strpos($_SESSION["opravneni"],"1") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $servPar["id"] = $param["id"];
        $temPar["data"] = $this->service->ctiPolozku($servPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $this->template->pisPolozku($temPar);
    }
    
    public function novpolozka($param){
        if(strpos($_SESSION["opravneni"],"1") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        if(strpos($_SESSION["opravneni"],"1") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $this->service->uloz($param["form"]["polozka"]);
        
        $vys = array('typ' => 'stranka', 'data' => "./?uzivatel/seznam/str=".$param["str"]);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }
    
    public function zapheslo($param){
        $this->template->zapHeslo(null);
    }
    
     public function obnheslo($param){
       $servPar["email"] = $param["form"]["zapheslo"]["email"]; 
       $res = $this->service->obnheslo($servPar);
       if($res < 0){
           $this->template->chybneObnoveni($res);
       }else{
           $this->template->obnoveniHesla(null);
       }
    }
    
    public function obnovheslo($param){
        $res = $this->service->obnovheslo($param);
        if($res < 0){
            $this->template->nelzeObnovit($res);
        }else{
            $this->template->obnovHeslo($res);
        }
    }
   
    
    public function noveheslo($param){
        $this->service->noveheslo($param);
    }
}