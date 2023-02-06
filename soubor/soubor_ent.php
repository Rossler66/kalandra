<?php

include_once( 'entita.php' );

class web_soubory_kat_ent extends entita {

    private $id;
    private $cesta;
    private $nazev;
    private $pripona;
    private $puvodniNazev;

    public function __construct() {
        $this->polNazev["id"] = "id";
        $this->polNazev["cesta"] = "cesta";
        $this->polNazev["nazev"] = "nazev";
        $this->polNazev["pripona"] = "pripona";
        $this->polNazev["puvodniNazev"] = "puvodni_nazev";
    }

    public function setId($hod) {
        $this->id = $hod;
    }

    public function getId() {
        return $this->id;
    }

    public function setCesta($hod) {
        $this->cesta = $hod;
    }

    public function getCesta() {
        return $this->cesta;
    }

    public function setNazev($hod) {
        $this->nazev = $hod;
    }

    public function getNazev() {
        return $this->nazev;
    }

    public function setPripona($hod) {
        $this->pripona = $hod;
    }

    public function getPripona() {
        return $this->pripona;
    }

    public function setPuvodniNazev($hod) {
        $this->puvodniNazev = $hod;
    }

    public function getPuvodniNazev() {
        return $this->puvodniNazev;
    }

    public function getCelaCesta(){
        return $this->cesta."/".$this->id."_".$this->nazev.".".$this->pripona;
    }
    public function __set($name, $val) {
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

    public function __get($name) {
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
