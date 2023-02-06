<?php
include_once( 'entita.php' );
class frm_formular_zaz_ent extends entita
{
    private $id;
    private $odeslano;
    private $nazev;
    private $obsah;

    public function __construct()
    {
        parent:: __construct();
        $this->polNazev["id"] = "id";
        $this->polNazev["odeslano"] = "odeslano";
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

    public function setOdeslano($hod)
    {
        $this->odeslano = $hod;
    }

    public function getOdeslano()
    {
        return $this->odeslano;
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
        $m = "set" . ucfirst($name);
        $this->$m($val);
    }

    public function __get($name)
    {
        $m = "get" . ucfirst($name);
        return $this->$m();
    }
}