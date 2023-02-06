<?php

include_once("service.php");

class dokumentytypy_ser extends service {

    public function seznam($param) {
        $sezPar["order"] = "naz.nazev";
        if (array_key_exists("order", $param) && $param["order"]) {
            $sezPar["order"] = $param["order"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }

        return $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_naz_rep", $sezPar);
    }

    public function ctiPolozku($param) {
        $sezPar["where"] = "naz.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_dokumenty_naz_rep", $sezPar);
    }

    public function novPolozka($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_dokumenty_naz_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_dokumenty_naz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["naz"],"naz");
        return $polozkaEnt;
    }

    public function smazpolozka($param) {
        $asQ = "DELETE FROM web_dokumenty_kat WHERE id = " . $param["id"];
        db::query($asQ);
    }


}
