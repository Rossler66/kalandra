<?php

include_once('entita.php');

class web_stranka_zaz_ent extends entita
{

    private $id;
    private $typ;
    private $nazev;
    private $obsah;

    public function __construct()
    {
        $this->polNazev["id"] = "id";
        $this->polNazev["typ"] = "typ";
        $this->polNazev["nazev"] = "nazev";
        $this->polNazev["obsah"] = "obsah";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setTyp($hod)
    {
        $this->typ = $hod;
    }

    public function getTyp()
    {
        return $this->typ;
    }

    public function setNazev($hod)
    {
        $this->nazev = $hod;
    }

    public function getNazev()
    {
        return $this->nazev;
    }

    public function setObsah($hod)
    {
        $this->obsah = $hod;
    }

    public function getObsah()
    {
        return $this->obsah;
    }

    public function __set($name, $val)
    {
        $value = $val;
        $m = "set" . ucfirst($name);
        if (method_exists($this, $m)) {
            $this->$m($value);
        }
        $m = "set" . ucfirst($this->jmenoPolozky($name));
        if (method_exists($this, $m)) {
            $this->$m($value);
        }
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        if (method_exists($this, $m)) {
            return $this->$m();
        }
        $m = "get" . ucfirst($this->jmenoPolozky($name));
        if (method_exists($this, $m)) {
            return $this->$m();
        }
    }

}

class web_provozovna_zaz_ent extends entita
{

    private $id;
    private $zastupce;
    private $mesto;
    private $ulice;
    private $telefon;
    private $email;
    private $mapa;
    private $provozPo;
    private $provozUt;
    private $provozSt;
    private $provozCt;
    private $provozPa;
    private $provozSo;
    private $provozNe;
    private $poznamka;
    private $krajId;

    public function __construct()
    {
        $this->polNazev["id"] = "id";
        $this->polNazev["zastupce"] = "zastupce";
        $this->polNazev["mesto"] = "mesto";
        $this->polNazev["ulice"] = "ulice";
        $this->polNazev["telefon"] = "telefon";
        $this->polNazev["email"] = "email";
        $this->polNazev["mapa"] = "mapa";
        $this->polNazev["provozPo"] = "provoz_po";
        $this->polNazev["provozUt"] = "provoz_ut";
        $this->polNazev["provozSt"] = "provoz_st";
        $this->polNazev["provozCt"] = "provoz_ct";
        $this->polNazev["provozPa"] = "provoz_pa";
        $this->polNazev["provozSo"] = "provoz_so";
        $this->polNazev["provozNe"] = "provoz_ne";
        $this->polNazev["poznamka"] = "poznamka";
        $this->polNazev["krajId"] = "kraj_id";
        $this->polDef["id"] = " ";
        $this->polDef["zastupce"] = " ";
        $this->polDef["mesto"] = " ";
        $this->polDef["ulice"] = " ";
        $this->polDef["telefon"] = " ";
        $this->polDef["email"] = " ";
        $this->polDef["mapa"] = " ";
        $this->polDef["provozPo"] = " ";
        $this->polDef["provozUt"] = " ";
        $this->polDef["provozSt"] = " ";
        $this->polDef["provozCt"] = " ";
        $this->polDef["provozPa"] = " ";
        $this->polDef["provozSo"] = " ";
        $this->polDef["provozNe"] = " ";
        $this->polDef["poznamka"] = " ";
        $this->polDef["krajId"] = 0;
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setZastupce($hod)
    {
        $this->zastupce = $hod;
    }

    public function getZastupce()
    {
        return $this->zastupce;
    }

    public function setMesto($hod)
    {
        $this->mesto = $hod;
    }

    public function getMesto()
    {
        return $this->mesto;
    }

    public function setUlice($hod)
    {
        $this->ulice = $hod;
    }

    public function getUlice()
    {
        return $this->ulice;
    }

    public function setTelefon($hod)
    {
        $this->telefon = $hod;
    }

    public function getTelefon()
    {
        return $this->telefon;
    }

    public function setEmail($hod)
    {
        $this->email = $hod;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setMapa($hod)
    {
        $this->mapa = $hod;
    }

    public function getMapa()
    {
        return $this->mapa;
    }

    public function setProvozPo($hod)
    {
        $this->provozPo = $hod;
    }

    public function getProvozPo()
    {
        return $this->provozPo;
    }

    public function setProvozUt($hod)
    {
        $this->provozUt = $hod;
    }

    public function getProvozUt()
    {
        return $this->provozUt;
    }

    public function setProvozSt($hod)
    {
        $this->provozSt = $hod;
    }

    public function getProvozSt()
    {
        return $this->provozSt;
    }

    public function setProvozCt($hod)
    {
        $this->provozCt = $hod;
    }

    public function getProvozCt()
    {
        return $this->provozCt;
    }

    public function setProvozPa($hod)
    {
        $this->provozPa = $hod;
    }

    public function getProvozPa()
    {
        return $this->provozPa;
    }

    public function setProvozSo($hod)
    {
        $this->provozSo = $hod;
    }

    public function getProvozSo()
    {
        return $this->provozSo;
    }

    public function setProvozNe($hod)
    {
        $this->provozNe = $hod;
    }

    public function getProvozNe()
    {
        return $this->provozNe;
    }

    public function setPoznamka($hod)
    {
        $this->poznamka = $hod;
    }

    public function getPoznamka()
    {
        return $this->poznamka;
    }

    public function setKrajId($hod)
    {
        $this->krajId = $hod;
    }

    public function getKrajId()
    {
        return $this->krajId;
    }

    public function __set($name, $val)
    {
        $value = $val;
        $m = "set" . ucfirst($name);
        if (method_exists($this, $m)) {
            $this->$m($value);
        }
        $m = "set" . ucfirst($this->jmenoPolozky($name));
        if (method_exists($this, $m)) {
            $this->$m($value);
        }
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        if (method_exists($this, $m)) {
            return $this->$m();
        }
        $m = "get" . ucfirst($this->jmenoPolozky($name));
        if (method_exists($this, $m)) {
            return $this->$m();
        }
    }

}

class kat_kraje_kat_ent extends entita
{

    private $id;
    private $nazev;

    public function __construct()
    {
        $this->polNazev["id"] = "id";
        $this->polNazev["nazev"] = "nazev";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNazev($hod)
    {
        $this->nazev = $hod;
    }

    public function getNazev()
    {
        return $this->nazev;
    }

    public function __set($name, $val)
    {
        $value = $val;
        $m = "set" . ucfirst($name);
        if (method_exists($this, $m)) {
            $this->$m($value);
        }
        $m = "set" . ucfirst($this->jmenoPolozky($name));
        if (method_exists($this, $m)) {
            $this->$m($value);
        }
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        if (method_exists($this, $m)) {
            return $this->$m();
        }
        $m = "get" . ucfirst($this->jmenoPolozky($name));
        if (method_exists($this, $m)) {
            return $this->$m();
        }
    }

}

class web_dokumenty_kat_ent extends entita
{
    private $id;
    private $nazev;
    private $popis;
    private $soubor;

    public function __construct()
    {
        parent:: __construct();
        $this->polNazev["id"] = "id";
        $this->polNazev["nazev"] = "nazev";
        $this->polNazev["popis"] = "popis";
        $this->polNazev["soubor"] = "soubor";
        $this->polDef["id"] = 0;
        $this->polDef["nazev"] = " ";
        $this->polDef["popis"] = " ";
        $this->polDef["soubor"] = " ";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNazev($hod)
    {
        $this->nazev = $hod;
    }

    public function getNazev()
    {
        return $this->nazev;
    }

    public function setPopis($hod)
    {
        $this->popis = $hod;
    }

    public function getPopis()
    {
        return $this->popis;
    }

    public function setSoubor($hod)
    {
        $this->soubor = $hod;
    }

    public function getSoubor()
    {
        return $this->soubor;
    }

    public function __set($name, $val)
    {
        $m = "set" . ucfirst($name);
        $this->$m($val);
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        return $this->$m();
    }
}

class web_dokumenty_zaz_ent extends entita
{

    private $id;
    private $souborId;
    private $nazevId;
    private $platnostOd;
    private $platny;

    public function __construct()
    {
        $this->polNazev["id"] = "id";
        $this->polNazev["souborId"] = "soubor_id";
        $this->polNazev["nazevId"] = "nazev_id";
        $this->polNazev["platnostOd"] = "platnost_od";
        $this->polNazev["platny"] = "platny";

        $this->polDef["id"] = 0;
        $this->polDef["souborId"] = 0;
        $this->polDef["nazevId"] = 0;
        $this->polDef["platnostOd"] = " ";
        $this->polDef["platny"] = "N";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSouborId($hod)
    {
        $this->souborId = $hod;
    }

    public function getSouborId()
    {
        return $this->souborId;
    }

    public function setNazevId($hod)
    {
        $this->nazevId = $hod;
    }

    public function getNazevId()
    {
        return $this->nazevId;
    }

    public function setPlatnostOd($hod)
    {
        $this->platnostOd = $hod;
    }

    public function getPlatnostOd()
    {
        return $this->platnostOd;
    }

    public function setPlatny($hod)
    {
        $this->platny = $hod;
    }

    public function getPlatny()
    {
        return $this->platny;
    }

    public function __set($name, $val)
    {
        $m = "set" . ucfirst($name);
        $this->$m($val);
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        return $this->$m();
    }

}


class web_spoluprace_zaz_ent extends entita
{
    private $id;
    private $provozovnaId;
    private $datum;
    private $pozice;
    private $popis;

    public function __construct()
    {
        parent:: __construct();
        $this->polNazev["id"] = "id";
        $this->polNazev["provozovnaId"] = "provozovna_id";
        $this->polNazev["datum"] = "datum";
        $this->polNazev["pozice"] = "pozice";
        $this->polNazev["popis"] = "popis";

        $this->polDef["id"] = 0;
        $this->polDef["provozovnaId"] = 0;
        $this->polDef["datum"] = " ";
        $this->polDef["pozice"] = " ";
        $this->polDef["popis"] = " ";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setProvozovnaId($hod)
    {
        $this->provozovnaId = $hod;
    }

    public function getProvozovnaId()
    {
        return $this->provozovnaId;
    }

    public function setDatum($hod)
    {
        $this->datum = $hod;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function setPozice($hod)
    {
        $this->pozice = $hod;
    }

    public function getPozice()
    {
        return $this->pozice;
    }

    public function setPopis($hod)
    {
        $this->popis = $hod;
    }

    public function getPopis()
    {
        return $this->popis;
    }

    public function __set($name, $val)
    {
        $m = "set" . ucfirst($name);
        $this->$m($val);
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        return $this->$m();
    }
}

class web_clanek_zaz_ent extends entita
{
    private $id;
    private $nadpis;
    private $clanek;
    private $datum;
    private $foto;
    private $fotky;

    public function __construct()
    {
        parent:: __construct();
        $this->polNazev["id"] = "id";
        $this->polNazev["nadpis"] = "nadpis";
        $this->polNazev["clanek"] = "clanek";
        $this->polNazev["datum"] = "datum";
        $this->polNazev["foto"] = "foto";
        $this->polDef["id"] = 0;
        $this->polDef["nadpis"] = " ";
        $this->polDef["datum"] = date("Y-m-d");
        $this->polDef["clanek"] = " ";
        $this->polDef["foto"] = " ";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNadpis($hod)
    {
        $this->nadpis = $hod;
    }

    public function getNadpis()
    {
        return $this->nadpis;
    }

    public function setClanek($hod)
    {
        $this->clanek = $hod;
    }

    public function getClanek()
    {
        return $this->clanek;
    }

    public function setDatum($hod)
    {
        $this->datum = $hod;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function setFoto($hod)
    {
        $this->foto = $hod;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFotky($hod)
    {
        $this->fotky = $hod;
    }

    public function getFotky()
    {
        return $this->fotky;
    }

    public function __set($name, $val)
    {
        $m = "set" . ucfirst($name);
        $this->$m($val);
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        return $this->$m();
    }
}

class web_koncert_zaz_ent extends entita
{
    private $id;
    private $datum;
    private $cas;
    private $misto;
    private $text;
    private $foto;
    private $fotky;

    public function __construct()
    {
        parent:: __construct();
        $this->polNazev["id"] = "id";
        $this->polNazev["datum"] = "datum";
        $this->polNazev["cas"] = "cas";
        $this->polNazev["misto"] = "misto";
        $this->polNazev["text"] = "text";
        $this->polNazev["foto"] = "foto";

        $this->polDef["id"] = 0;
        $this->polDef["datum"] = date("Y-m-d");
        $this->polDef["cas"] = " ";
        $this->polDef["misto"] = " ";
        $this->polDef["text"] = " ";
        $this->polDef["foto"] = " ";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setDatum($hod)
    {
        $this->datum = $hod;
    }

    public function getDatum()
    {
        return $this->datum;
    }

    public function setCas($hod)
    {
        $this->cas = $hod;
    }

    public function getCas()
    {
        return $this->cas;
    }

    public function setMisto($hod)
    {
        $this->misto = $hod;
    }

    public function getMisto()
    {
        return $this->misto;
    }

    public function setText($hod)
    {
        $this->text = $hod;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setFoto($hod)
    {
        $this->foto = $hod;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setFotky($hod)
    {
        $this->fotky = $hod;
    }

    public function getFotky()
    {
        return $this->fotky;
    }


    public function __set($name, $val)
    {
        $m = "set" . ucfirst($name);
        $this->$m($val);
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        return $this->$m();
    }
}