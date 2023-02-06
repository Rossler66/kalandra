<?php

include_once("service.php");

class koncert_ser extends service
{

    public function seznam($param)
    {
        $sezPar["order"] = "kon.datum desc";
        if (array_key_exists("where", $param)) {
            $sezPar["where"] = $param["where"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"]-1;
        }
        if (array_key_exists("poc", $param) && $param["poc"]) {
            $sezPar["limit"] = $param["poc"];
        }
        $koncertEnt = $this->nactiSeznam("stranka", "stranka_rep", "web_koncert_foto_rep", $sezPar);

        foreach ($koncertEnt as $koncert) {
            if ($koncert["kon"]->foto) {
                $fotkyPar["where"] = "sou.id in (" . $koncert["kon"]->foto . ")";
                $fotkyEnt = $this->nactiSeznam("stranka", "stranka_rep", "web_soubory_kat_rep", $fotkyPar);
                $koncert["kon"]->fotky = $fotkyEnt;
            } else {
                $koncert["kon"]->fotky = null;
            }
        }

        return $koncertEnt;
    }

    public function ctiPolozku($param)
    {
        $sezPar["where"] = "kon.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_koncert_foto_rep", $sezPar);
    }

    public function ctiFota($param)
    {
        $sezPar["where"] = "sou.id IN (" . $param["id"] . " )";
        return $this->nactiSeznam("stranka", "stranka_rep", "web_soubory_kat_rep", $sezPar);

    }

    public function novPolozka($param)
    {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_koncert_foto_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param)
    {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_koncert_foto_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["kon"], "kon");
        return $polozkaEnt;
    }

    public function smazpolozka($param)
    {
        $asQ = "DELETE FROM web_koncert_zaz WHERE id = " . $param["id"];
        db::query($asQ);
    }


}
