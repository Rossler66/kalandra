<?php
session_start();
include('db.php');
db::dbs();

$vstupTX = file_get_contents('php://input');
$vstupJS = json_decode($vstupTX, true);
$jmp = $vstupJS["jmp"];
$pre = $vstupJS["pre"];
$fce = $vstupJS["fce"];
$data = $vstupJS["data"];
$prez = $pre."_pre";
include_once($jmp."/".$prez . ".php");
$form = new $prez($data);
$form->$fce($data);

