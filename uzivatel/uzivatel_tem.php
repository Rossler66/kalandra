<?php

include_once( "template.php" );

class uzivatel_tem extends template {

    public function formPrihlaseni($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Přihlášení<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <form name="prihlaseni">';
        $vys .= '       <div class="nav">Přihlašovací jméno</div>';
        $vys .= '       <input type="text" name="login">';
        $vys .= '       <div class="nav">Přihlašovací heslo</div>';
        $vys .= '       <input type="password" name="password">';
        $vys .= '   </form>';
        $vys .= '   <div class="tlacpas">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Zapomenuté heslo" jmp="uzivatel" pre="uzivatel" fce="zapheslo" onclick="posli(event);">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Přihlásit" jmp="uzivatel" pre="uzivatel" fce="prihlasit" form="prihlaseni" onclick="posli(event);">';
        $vys .= '   </div>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }
    public function zapHeslo($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Obnova hesla<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <form name="zapheslo">';
        $vys .= '       <div class="nav">Váš registrační e-mail</div>';
        $vys .= '       <input type="text" name="email">';
        $vys .= '   </form>';
        $vys .= '   <div class="tlacpas">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Obnovit heslo" jmp="uzivatel" pre="uzivatel" fce="obnheslo" form="zapheslo" onclick="posli(event);">';
        $vys .= '   </div>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

    public function chybnePrihlaseni($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Přihlášení<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <p>Chybné přihlášení. Chcete to zkusit znovu? ('.$param.')</p>';
        $vys .= '   <div class="tlacpas">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Zkusit znovu" jmp="uzivatel" pre="uzivatel" fce="prihlaseni" onclick="posli(event);">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Obnovit heslo" jmp="uzivatel" pre="uzivatel" fce="zapheslo" onclick="posli(event);">';
        $vys .= '   </div>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

    public function chybneObnoveni($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Obnovení hesla<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <p>Zadaný e-mail neznáme. Chcete to zkustit znovu? '.$param.'</p>';
        $vys .= '   <div class="tlacpas">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Zkusit znovu" jmp="uzivatel" pre="uzivatel" fce="zapheslo" onclick="posli(event);">';
        $vys .= '   </div>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

    public function obnoveniHesla($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Obnovení hesla<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <p>Na zadaný e-mail jsme Vás zaslali odkaz pro ovnovení hesla. Odkaz je platný 6 hodin.</p>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }
    
    
    public function volbyUziv($param) {
        $vys = '';

        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Volby<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
//        $vys .= '       <a href="?form/seznam/str=0" class="tlacitko">Formuláře</a>';
        $vys .= '       <a href="?menu/seznam/str=0" class="tlacitko">Menu</a>';
        $vys .= '       <a href="?stranka/editor/typ=T,id=0" class="tlacitko">Úprava stránky</a>';
        $vys .= '       <a href="?clanek/seznam/str=0" class="tlacitko">Články</a>';
        $vys .= '       <a href="?koncert/seznam/str=0" class="tlacitko">Koncerty</a>';
//        $vys .= '       <a href="?provozovna/seznam/str=0" class="tlacitko">Pobočky</a>';
//        $vys .= '       <a href="?spoluprace/seznam/str=0" class="tlacitko">Nabídka spolupráce</a>';
//        $vys .= '       <a href="?dokumentysou/seznam/str=0" class="tlacitko">Dokumety</a>';
//        $vys .= '       <a href="?dokumentytypy/seznam/str=0" class="tlacitko">Typy dokumetů</a>';
        $vys .= '       <a href="?uzivatel/seznam/str=0" class="tlacitko">Uživatelé</a>';
        $vys .= '</div>';

        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
    }

    public function pisSeznam($param) {
        echo '<div class="block  block_standard">';
        echo '<div class="container">';
        echo '<div class="pole pole1 poleL">';
        echo '<div class="volbysez">';

        echo '<a href="./?uzivatel/novpolozka/id=0,str=' . $param["str"] . '"><img src="./img/iko_plus.svg" /></a>';
        if ($param["str"] > 0) {
            echo '<a href="./?uzivatel/seznam/str=' . ($param["str"] - 1) . '"><img src="./img/iko_doleva.svg" /></a>';
        }
        echo '<a href="./?uzivatel/seznam/str=' . ($param["str"] + 1) . '"><img src="./img/iko_doprava.svg" /></a>';
        echo '</div>';
        echo '<table class="seznam">';
        echo '<tr><th class="tal">Jméno</th><th class="tal">Email</th><th class="tal">Login</th><th class="tal">Oprávnění</th><th class="tar">Volby</th></tr>';
        foreach ($param["data"] as $rad) {
            echo '<tr><td>' . $rad["uzi"]->jmeno . '</td><td>' . $rad["uzi"]->email . '</td><td>' . $rad["uzi"]->login . '</td><td>' . $rad["uzi"]->opravneni . '</td>'
            . '<td><div class="volbysez"><a href="?uzivatel/polozka/id=' . $rad["uzi"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_edit.svg"></a>'
            . '<a href="?uzivatel/smazpolozka/id:' . $rad["uzi"]->id . ',str=' . $param["str"] . '" class="iko"><img src="./img/iko_smaz.svg"></a>'
            . '</div></td></tr>';
        }
        echo '</table>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function pisPolozku($param) {
        echo '<div class="block  block_standard">';
        echo '  <div class="container">';
        echo '      <div class="pole pole3 poleL bcg_svetlabarva stin formular">';
        echo '          <h2 class="col_tmavabarva">Uživatel<a href="?uzivatel/seznam/str='.$param["str"].'"><img src="./img/iko_zavrit.svg" ></a></h2>';
        echo '          <form name="polozka" >';
        echo '              <div class="nav">Jméno a příjmení uživatele</div>';
        echo '              <input type="text" name="uzi_jmeno"  class="w100p" value="' . $param["data"][0]["uzi"]->jmeno . '" />';
        echo '              <div class="nav">Přihlašovací jméno</div>';
        echo '              <input type="text" name="uzi_login" class="w100p" value="' . $param["data"][0]["uzi"]->login . '" />';
        echo '              <div class="nav">Heslo</div>';
        echo '              <input type="password" class="w100p" name="uzi_heslo" value="" />';
        echo '              <div class="nav">Email</div>';
        echo '              <input type="text" name="uzi_email" class="w100p" value="' . $param["data"][0]["uzi"]->email . '" />';
        echo '              <div class="nav">Oprávnění</div><ul class="w100p">';
        if(strpos($param["data"][0]["uzi"]->opravneni,"1") !== false){$checked = "checked";}else{$checked = "";}
        echo '                <li><input type="checkbox" name="opr_uzivatele" value="1" '.$checked.'>Uživatelé</li>';
        if(strpos($param["data"][0]["uzi"]->opravneni,"2")){$checked = "checked";}else{$checked = "";}
        echo '                <li><input type="checkbox" name="opr_dokumenty" value="2" '.$checked.'>Dokumenty</li>';
        if(strpos($param["data"][0]["uzi"]->opravneni,"3")){$checked = "checked";}else{$checked = "";}
        echo '                <li><input type="checkbox" name="opr_stranky" value="3" '.$checked.'>Stránky a menu</li>';
        if(strpos($param["data"][0]["uzi"]->opravneni,"4")){$checked = "checked";}else{$checked = "";}
        echo '                <li><input type="checkbox" name="opr_pobocky" value="4" '.$checked.'>Pobočky</li>';
        if(strpos($param["data"][0]["uzi"]->opravneni,"5")){$checked = "checked";}else{$checked = "";}
//        echo '                <li><input type="checkbox" name="opr_pobocka" value="5" '.$checked.'>Vybraná pobočka</li>';
        echo '              </ul>';
        echo '              <input type="hidden" name="uzi_id" class="w100p" value="' . $param["data"][0]["uzi"]->id . '" />';
        echo '              <div class="tlacpas">';
        echo '                  <input type="button" class="tlacitko" value="Uložit" jmp="uzivatel" pre="uzivatel" fce="uloz" par="id=' . $param["id"] . ',str=' . $param["str"] . '" form="polozka" onclick="posli(event)" />';
        echo '              </div>';
        echo '          </form>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }
    
    public function nelzeObnovit($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Obnovení hesla<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <p>Heslo nelze obnovit. Použitý tiket není platný. '.$param.'</p>';
        $vys .= '</div>';

        echo $vys;
/*        
        $vystup = array('typ' => 'pridejstrance', 'data' => $vys);
        $json = json_encode($vystup);
        echo '{"token":[';
        echo $json;
        echo "]}";
 * 
 */
    }

    
    public function obnovHeslo($param) {

        $vys = '';
        $vys .= '<div class="dialog formular">';
        $vys .= '   <h2>Obnova hesla<img src="./img/iko_zavrit.svg" onclick="zavridialog(event);"></h2>';
        $vys .= '   <form name="zapheslo">';
        $vys .= '       <div class="nav">Vaše nové heslo</div>';
        $vys .= '       <input type="password" name="heslo">';
        $vys .= '   </form>';
        $vys .= '   <div class="tlacpas">';
        $vys .= '       <input type="button" class="tlacitko" name="login" value="Obnovit heslo" jmp="uzivatel" pre="uzivatel" fce="noveheslo" form="zapheslo" onclick="posli(event);">';
        $vys .= '   </div>';
        $vys .= '</div>';

        echo $vys;

    }
    
}
