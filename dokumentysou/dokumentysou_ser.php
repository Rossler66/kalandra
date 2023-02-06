<?php

include_once( "service.php" );

class dokumentysou_ser extends service {

    public function seznam($param) {
        $sezPar["order"] = "dok.platnost_od desc";
        if (array_key_exists("order", $param) && $param["order"]) {
            $sezPar["order"] = $param["order"];
        }
        if (array_key_exists("where", $param) && $param["where"]) {
            $sezPar["where"] = $param["where"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }
        
        return $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_soubor_rep", $sezPar);
    }
    
    public function ctiPolozku($param) {
        $sezPar["where"] = "dok.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_soubor_rep", $sezPar);
    }

    public function novPolozka($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_dokumenty_zaz_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_dokumenty_zaz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
//        $polozkaEnt[0]["naz"]->popis = " ";
//        $polozkaEnt[0]["naz"]->id = $polozkaEnt[0]["dok"]->nazevId;
//        $polozkaRep->uloz($polozkaEnt[0]["naz"],"naz");
//        $polozkaEnt[0]["dok"]->nazevId = $polozkaEnt[0]["naz"]->id;
        $polozkaRep->uloz($polozkaEnt[0]["dok"], "dok");

        if($polozkaEnt[0]["dok"]->platny == "A"){
            $dokumentPar["where"] = "dok.id = ".$polozkaEnt[0]["dok"]->id;
            $dokumentEnt = $this->nactiSeznam("stranka","stranka_rep","web_dokumenty_soubor_rep",$dokumentPar);
            $zdroj = "./img/".$dokumentEnt[0]["sou"]->cesta."/".$dokumentEnt[0]["sou"]->id."_".$dokumentEnt[0]["sou"]->nazev.".".$dokumentEnt[0]["sou"]->pripona;
            $cile = explode(",",$dokumentEnt[0]["naz"]->soubor);
            foreach($cile as $cil){
                copy($zdroj,$cil);
            }
        }

        return $polozkaEnt;
    }

    public function smazpolozka($param) {
        $asQ = "DELETE FROM web_dokumenty_zaz WHERE id = " . $param["id"];
        db::query($asQ);
    }
    
    public function soubor($param){
        $asQ = "UPDATE web_dokumenty_zaz SET soubor_id = ".$param["souborId"]." WHERE id = ".$param["id"];
        db::query($asQ);
    }

    
}
