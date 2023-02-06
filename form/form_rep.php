<?php
include_once( 'repository.php' );

class frm_formular_zaz_rep extends repository {

    public function __construct() {
        include_once 'form/form_ent.php';
        $this->definice = array(
            "frm" =>
                array(
                    "tabulka" => "frm_formular_zaz",
                    "entita" => "frm_formular_zaz_ent",
                    "alias" => "frm",
                ),
        );
    }

}
