<?php

include_once('entita.php');

class web_menu_zaz_ent extends entita
{

    private $id;
    private $menuKod;
    private $text;
    private $odkaz;
    private $url;

    public function __construct()
    {
        $this->polNazev["id"] = "id";
        $this->polNazev["menuKod"] = "menu_kod";
        $this->polNazev["text"] = "text";
        $this->polNazev["odkaz"] = "odkaz";
        $this->polNazev["url"] = "url";

        $this->polDef["id"] = 0;
        $this->polDef["menuKod"] = " ";
        $this->polDef["text"] = " ";
        $this->polDef["odkaz"] = " ";
        $this->polDef["url"] = " ";
    }

    public function setId($hod)
    {
        $this->id = $hod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setMenuKod($hod)
    {
        $this->menuKod = $hod;
    }

    public function getMenuKod()
    {
        return $this->menuKod;
    }

    public function setText($hod)
    {
        $this->text = $hod;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setOdkaz($hod)
    {
        $this->odkaz = $hod;
    }

    public function getOdkaz()
    {
        return $this->odkaz;
    }

    public function setUrl($hod)
    {
        $this->url = $hod;
    }

    public function getUrl()
    {
        return $this->url;
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
