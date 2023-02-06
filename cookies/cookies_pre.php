<?php

include_once( "presenter.php" );

class cookies_pre extends presenter {
    
    
    public function start(){
       if(!isset($_COOKIE["cok"])){
           $tem = $this->vratObjekt("cookies", "cookies_tem", "cookies_tem");
           $tem->cokNastav();
       } 
    }
    
}
