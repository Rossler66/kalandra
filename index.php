<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
include( 'db.php' );
db::dbs();

include ('form/form_ser.php');
$formSer = new form_ser();
$frmPar["nazev"] = $_SERVER['QUERY_STRING'];
$frmPar["polozky"] = $_POST;
$formSer->ulozForm($frmPar);
include ('stranka/stranka_pre.php');
$strankaPre = new stranka_pre();
include ('cookies/cookies_pre.php');
$cokPre = new cookies_pre();
$strankaPre->vstup($_SERVER['QUERY_STRING']);
$strankaPre->hlavickaZacatek(null);
$cokPre->start();
$strankaPre->hlavickaKonec(null);
$strankaPre->vypis();
$strankaPre->paticka(null);


//<script src="prostredi.js"></script>
//<script src="komunikator.js"></script>
//</html>
