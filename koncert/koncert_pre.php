<?php


include_once( "presenter.php" );
class koncert_pre extends presenter{

    //put your code here
    private $service;
    private $template;

    function __construct() {
        $this->service = $this->vratObjekt("koncert", "koncert_ser", "koncert_ser");
        $this->template = $this->vratObjekt("koncert", "koncert_tem", "koncert_tem");
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
        $fotoPar["id"] = $temPar["data"][0]["kon"]->foto;
        $temPar["foto"] = $this->service->ctiFota($fotoPar);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $kraPar["order"] = "kra.id";
        $this->template->pisPolozku($temPar);
    }

    public function novpolozka($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $temPar["data"] = $this->service->novPolozka(null);
        $temPar["id"] = $param["id"];
        $temPar["str"] = $param["str"];
        $this->template->pisPolozku($temPar);
    }

    public function uloz($param){
        if(strpos($_SESSION["opravneni"],"4") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $this->service->uloz($param["form"]["polozka"]);

        $vys = array('typ' => 'stranka', 'data' => "./?koncert/seznam/str=".$param["str"]);
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
        $servPar["str"] = $param["str"];
        $servPar["poc"] = 15;
        $servPar["order"] = "kon.datum desc";
        $templPar["data"] = $this->service->seznamvyp($servPar);
        $templPar["str"] = $param["str"];
        $this->template->vypis($templPar);
    }

    public function vypisdet($param){
        $servPar["where"] = "kon.id = ".$param["id"];
        $templPar["data"] = $this->service->seznam($servPar);
//        $templPar["str"] = $param["str"];
        $this->template->vypisdet($templPar);
    }

    public function obrazekpole($data) {
        if(strpos($_SESSION["opravneni"],"3") === false){echo "<h1 class='w100p bcg_tmavomodra tac'>Neoprávněný přístup</h1>";return;}
        $souborSer = $this->vratObjekt("soubor", "soubor_ser", "soubor_ser");
        $soubor = $souborSer->nahraj($data);

        $vys = array('typ' => 'souborclanek', 'data' => $soubor);
        $json = json_encode($vys);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

}