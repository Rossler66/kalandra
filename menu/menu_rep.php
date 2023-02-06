<?php
include_once( 'repository.php' );

class web_menu_zaz_rep extends repository {

    public function __construct() {
        include_once 'menu/menu_ent.php';
        $this->definice = array(
            "men" =>
            array(
                "tabulka" => "web_menu_zaz",
                "entita" => "web_menu_zaz_ent",
                "alias" => "men",
            ),
        );
    }

}
