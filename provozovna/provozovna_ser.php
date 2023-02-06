<?php

include_once("service.php");

class provozovna_ser extends service
{

    public function seznam($param)
    {
        $sezPar["order"] = "pro.mesto";
        if (array_key_exists("order", $param) && $param["order"]) {
            $sezPar["order"] = $param["order"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }
        if (array_key_exists("poc", $param) && $param["poc"]) {
            $sezPar["limit"] = $param["poc"];
        }
        return $this->nactiSeznam("stranka", "stranka_rep", "web_provozovna_kraj_rep", $sezPar);
    }

    public function ctiPolozku($param)
    {
        $sezPar["where"] = "pro.id = " . $param["id"];
        return $this->nactiSeznam("stranka", "stranka_rep", "web_provozovna_zaz_rep", $sezPar);
    }

    public function novPolozka($param)
    {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_provozovna_zaz_rep");
        return $polozkaRep->vratEntitu(null);
    }

    public function uloz($param)
    {
        $polozkaRep = $this->vratObjekt("stranka", "stranka_rep", "web_provozovna_zaz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["pro"], "pro");
        return $polozkaEnt;
    }

    public function smazpolozka($param)
    {
        $asQ = "DELETE FROM web_provozovna_zaz WHERE id = " . $param["id"];
        db::query($asQ);
    }

    public function odeslat($param)
    {
        $provPar["where"] = "pro.id = " . $param["form"]["zprava"]["id"];
        $provozovnaEnt = $this->nactiSeznam("stranka", "stranka_rep", "web_provozovna_zaz_rep", $provPar);

        $data["odesilatelJmeno"] = $param["form"]["zprava"]["jmeno"];
        $data["odesilatel"] = $param["form"]["zprava"]["email"];
        $data["obsah"] = "Odeslílatel: " . $param["form"]["zprava"]["jmeno"] . "<br />"
            . "Email: " . $param["form"]["zprava"]["email"] . "<br />"
            . "Telefon: " . $param["form"]["zprava"]["telefon"] . "<br />"
            . "Zpráva:<br />"
            . $param["form"]["zprava"]["vzkaz"];
        $data["prijemce"] = $provozovnaEnt[0]["pro"]->email;
        $data["predmet"] = "Zpráva z WEBU BOHEMIKA";
        $this->amail($data);
    }

    public function aktivnikraje()
    {
        $asQ = "SELECT kra.id as kra__id, kra.nazev as kra__nazev, count(pro.id) as pocet "
            . " FROM kat_kraje_kat kra "
            . " LEFT JOIN web_provozovna_zaz pro ON (kra.id = pro.kraj_id) "
            . " GROUP BY kra.id "
            . " HAVING pocet > 0";
        $krajeRep = $this->vratObjekt("stranka","stranka_rep","kat_kraje_kat_rep");
        $krajeEnt = $krajeRep->nactiQ($asQ);
        return $krajeEnt;
    }

}
