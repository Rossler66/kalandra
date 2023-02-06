<?php

class cookies_tem {

    public function cokNastav() {
        echo '<div class="cookiesnas" id="cookiesnas">';
        echo '  <div class="block block_standard">';
        echo '      <div class="container">';
        echo '          <div class="pole pole1 poleM cokpodrobne disn" id="cokpodrobne">';
        echo '              <h3>Cookies nezbytné pro fungování webu<img src="./img/iko_zapnuto.svg"></h3>';
        echo '              <p>Tyto cookies NELZE ZAKÁZAT protože jsou nezbytné pro fungování našeho webu. Tyto soubory navíc přispívají k bezpečnému a řádnému využívání našich služeb.';
        echo '              </p>';
        if (isset($_COOKIE["stat"])) {
            $hod = $_COOKIE["stat"];
        } else {
            $hod = "N";
        }
        if($hod == "A"){$img = "./img/iko_zapnuto.svg";} else {$img = "./img/iko_vypnuto.svg";}
        $img = '<img src="'.$img.'" typ="stat" stav="' . $hod[0] . '" onclick="setCook(event);">';
        echo '              <h3>Cookies pro statistiku návštěvnosti našich stránek' . $img . '</h3>';
        echo '              <p>Analytické cookies na našem webu jsou shromažďovány skripty a následně anonymiyovány. Po anonymizaci se již nejedná o osobní údaje,'
        . ' protože anonymizované cookies nelze přiřadit konkrétnímu uživateli, resp. konkrétní osobě. My pracujeme pouze s cookies v anonymizované podobě. '
        . 'Proto nedokážeme z cookies zjistit, jak se konkrétní uživatel na našem webu choval. Získáváme pouze přehled o návštěvnosti';
        echo '              </p>';
        if (isset($_COOKIE["rekl"])) {
            $hod = $_COOKIE["rekl"];
        } else {
            $hod = "N";
        }
        if($hod == "A"){$img = "./img/iko_zapnuto.svg";} else {$img = "./img/iko_vypnuto.svg";}
        $img = '<img src="'.$img.'" typ="rekl" stav="' . $hod[0] . '" onclick="setCook(event);">';
        echo '              <h3>Cookies pro personalizovanou reklamu' . $img . '</h3>';
        echo '              <p>Záznamy pro personalizovanou reklamu nám umžňují nabídnout Vám takové produkty, o které se návštěvním našich stránek v nimulosti zajímal.';
        echo '              </p>';
        echo '          </div>';
        echo '          <div class="pole pole1 poleM">';

        echo '              <div class="coktext">';
        echo '                  <p>K chodu a uživatelskému pohodlí na našem webu využíváme soubory cookie. '
        . '                     Podrobné informace o nich a jejich zpracování naleznete v odkaze Využítí cookies ve spodní liště webu.'
        . '                     Kliknutím na "Přijmout všechny" souhlasíte s tím, že můžeme užívat všechny typy cookie. '
        . '                     Kliknutí na "Pouze nezbytné" budeme ukládat pouze cookie nezbytně nutné pro chod našeho webu.'
        . '                     Zněmit svou volbu můžete kliknutím na odkaz "Cookie" v patičce stránky.';
        echo '              </div>';
        echo '              <div class="cokvolby">';
        echo '                  <a class="tlacitko" href="#" typ="vse" stav="A" onclick="setCook(event);">Přijmout všechny</a>';
        echo '                  <a class="tlacitko" href="#" typ="vse" stav="N" onclick="setCook(event);">Pouze nezbytné</a>';
        echo '                  <a class="tlacitko" href="#" onclick="detCook(event)">Podrobné nastavení</a>';
        echo '                  <a class="tlacitko" href="#" onclick="zavCook(event)">Zavřít</a>';
        echo '              </div>';
        echo '          </div>';
        echo '      </div>';
        echo '  </div>';
        echo '</div>';
    }

}
