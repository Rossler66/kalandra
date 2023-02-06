<?php

include_once("service.php");

class clanek_ser extends service
{

    public function seznam($param)
    {
        $sezPar["order"] = "cla.datum desc";
        if (array_key_exists("where", $param)) {
            $sezPar["where"] = $param["where"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"]-1;
        }
        if (array_key_exists("poc", $param) && $param["poc"]) {
            $sezPar["limit"] = $param["poc"];
        }
        $clanekEnt = $this->nactiSeznam("stranka", "stranka_rep", "web_clanek_foto_rep", $sezPar);

        foreach ($clanekEnt as $clanek) {
            if ($clanek["cla"]->foto) {
                $fotkyPar["where"] = "sou.id in (" . $clanek["cla"]->foto . ")";
                $fotkyEnt = $this->nactiSeznam("stranka", "stranka_rep", "web_soubory_kat_rep", $fotkyPar);
                $clanek["cla"]->fotky = $fotkyEnt;
            } else {
                $clanek["cla"]->fotky = null;
            }
        }

        return $clanekEnt;
    }

    public function ctiPolozku($param)
    {
        $sezPar["where"] = "cla.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_clanek_foto_rep", $sezPar);
    }

    public function ctiFota($param)
    {
        $sezPar["where"] = "sou.id IN (" . $param["id"] . " )";
        return $this->nactiSeznam("stranka", "stranka_rep", "web_soubory_kat_rep", $sezPar);

    }

    public function novPolozka($param)
    {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_clanek_foto_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param)
    {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_clanek_foto_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["cla"], "cla");
        return $polozkaEnt;
    }

    public function smazpolozka($param)
    {
        $asQ = "DELETE FROM web_clanek_zaz WHERE id = " . $param["id"];
        db::query($asQ);
    }


}
