<?php

include_once( 'entita.php' );

class uzi_uzivatel_zaz_ent extends entita {

    private $id;
    private $login;
    private $heslo;
    private $jmeno;
    private $opravneni;
    private $email;

    public function __construct() {
        $this->polNazev["id"] = "id";
        $this->polNazev["login"] = "login";
        $this->polNazev["heslo"] = "heslo";
        $this->polNazev["jmeno"] = "jmeno";
        $this->polNazev["opravneni"] = "opravneni";
        $this->polNazev["email"] = "email";

        $this->polDef["id"] = 0;
        $this->polDef["login"] = " ";
        $this->polDef["heslo"] = " ";
        $this->polDef["jmeno"] = " ";
        $this->polDef["opravneni"] = " ";
        $this->polDef["email"] = " ";
    }

    public function setId($hod) {
        $this->id = $hod;
    }

    public function getId() {
        return $this->id;
    }

    public function setLogin($hod) {
        $this->login = $hod;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setHeslo($hod) {
        $this->heslo = $hod;
    }

    public function getHeslo() {
        return $this->heslo;
    }

    public function setJmeno($hod) {
        $this->jmeno = $hod;
    }

    public function getJmeno() {
        return $this->jmeno;
    }

    public function setOpravneni($hod) {
        $this->opravneni = $hod;
    }

    public function getOpravneni() {
        return $this->opravneni;
    }

    public function setEmail($hod) {
        $this->email = $hod;
    }

    public function getEmail() {
        return $this->email;
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
