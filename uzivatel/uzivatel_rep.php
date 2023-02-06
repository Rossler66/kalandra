<?php
include_once( 'repository.php' );

class uzi_uzivatel_zaz_rep extends repository {

    public function __construct() {
        include_once 'uzivatel/uzivatel_ent.php';
        $this->definice = array(
            "uzi" =>
            array(
                "tabulka" => "uzi_uzivatel_zaz",
                "entita" => "uzi_uzivatel_zaz_ent",
                "alias" => "uzi",
            ),
        );
    }

}
