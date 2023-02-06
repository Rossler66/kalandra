<?php
include_once("service.php");

class form_ser extends service
{
    public function ulozForm($param)
    {
        if(!$param["polozky"]){
            return;
        }
        $obsah = "";
        $odd = "";
        foreach ($param["polozky"] as $nazev => $hodnota) {
//            $nazev = str_replace("\\","\\\\".$nazev);
//            $nazev = str_replace("\"","\\\"",$nazev);
//            $hodnota = str_replace("\\","\\\\".$hodnota);
//            $hodnota = str_replace("\"","\\\"",$hodnota);
            $obsah .= $odd."\"".addslashes($nazev)."\":\"".addslashes($hodnota)."\"";
            $odd = ",";
        }
        $formRep = $this->vratObjekt("form", "form_rep", "frm_formular_zaz_rep");
        $formEnt = $formRep->vratEntitu(null);
        $formEnt[0]["frm"]->id = 0;
        $formEnt[0]["frm"]->odeslano = date("Y-m-d H:i");
        $formEnt[0]["frm"]->nazev = "f_".$param["nazev"];
        $formEnt[0]["frm"]->obsah = $obsah;
        $formRep->uloz($formEnt[0]["frm"],"frm");
    }

    public function seznam($param)
    {
        $sezPar["order"] = "frm.odeslano desc";
        if (array_key_exists("order", $param) && $param["order"]) {
            $sezPar["order"] = $param["order"];
        }
        if (array_key_exists("str", $param) && $param["str"]) {
            $sezPar["offset"] = $param["str"];
        }
        if (array_key_exists("poc", $param) && $param["poc"]) {
            $sezPar["limit"] = $param["poc"];
        }
        return $this->nactiSeznam("form", "form_rep", "frm_formular_zaz_rep", $sezPar);
    }

    public function ctiPolozku($param)
    {
        $sezPar["where"] = "frm.id = " . $param["id"];
        return $this->nactiSeznam("form", "form_rep", "frm_formular_zaz_rep", $sezPar);
    }

    public function uloz($param)
    {
        $polozkaRep = $this->vratObjekt("form", "form_rep", "frm_formular_zaz_rep");
        $polozkaEnt = $polozkaRep->nactiFormular($param);
        $polozkaRep->uloz($polozkaEnt[0]["pro"], "pro");
        return $polozkaEnt;
    }

}