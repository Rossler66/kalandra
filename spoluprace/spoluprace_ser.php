<?php

include_once("service.php");

class spoluprace_ser extends service {

    public function seznam($param) {
        $sezPar["order"] = "spo.datum";
        if (array_key_exists("order", $param) && $param["order"]) {
            $sezPar["order"] = $param["order"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }

        return $this->nactiSeznam("stranka", "stranka_rep", "web_spoluprace_rep", $sezPar);
    }

    public function ctiPolozku($param) {
        $sezPar["where"] = "spo.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_spoluprace_rep", $sezPar);
    }

    public function novPolozka($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_spoluprace_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param) {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_spoluprace_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["spo"],"spo");
        return $polozkaEnt;
    }

    public function smazpolozka($param) {
        $asQ = "DELETE FROM web_spoluprace_rep WHERE id = " . $param["id"];
        db::query($asQ);
    }


}
