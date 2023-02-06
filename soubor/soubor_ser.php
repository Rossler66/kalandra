<?php

class soubor_ser {

    public function nahraj($data) {

        $nazevcasti = explode(".", $data["soubornazev"]);

        $pripona = $nazevcasti[1];
/*        
        // Allow certain file formats
        if ($pripona != "jpg" && $pripona != "png" && $pripona != "jpeg" && $pripona != "gif" && $pripona != "webp" && $pripona != "svg") {
            $vystup["id"] = -1;
            $vystup["nazev"] = $data["soubornazev"];
            $vys = array('typ' => 'soubor', 'data' => $vystup);
            $json = json_encode($vys);
            echo '{"token":[';
            echo $json;
            echo "]}";
        }
*/

        // Check if $uploadOk is set to 0 by an error
        $dir1 = chr(rand(97, 122)) . chr(rand(97, 122));
        $dir2 = chr(rand(97, 122)) . chr(rand(97, 122));
        $dir3 = chr(rand(97, 122)) . chr(rand(97, 122));
        $name = chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122)) . chr(rand(97, 122));

        $asQ = "INSERT INTO web_soubory_kat (cesta, nazev, pripona, puvodni_nazev) values ('" . $dir1 . "/" . $dir2 . "/" . $dir3 . "', '" . $name . "','" . $pripona . "','" . $data["soubornazev"] . "')";

        $sou = fopen('log.txt', 'a');
        fwrite($sou, "ddd " . $asQ . " \r\n");
        fclose($sou);

        $qQ = db::query($asQ);
        $filId = db::insertId();

        mkdir("./img/" . $dir1, 0777);
        mkdir("./img/" . $dir1 . "/" . $dir2, 0777);
        mkdir("./img/" . $dir1 . "/" . $dir2 . "/" . $dir3, 0777);

        $cil = "./img/" . $dir1 . "/" . $dir2 . "/" . $dir3 . "/" . $filId . "_" . $name . "." . $pripona;

        $soubor = $data["soubor"];
        $soubor = str_replace('data:' . $data["soubortyp"] . ";base64,", '', $soubor);
        $soubor = str_replace(' ', '+', $soubor);
        $soubor = base64_decode($soubor);
        $success = file_put_contents($cil, $soubor);
        chmod($cil, 0777);

        $vystup["id"] = $filId;
        $vystup["cesta"] = $cil;
        $vystup["nazev"] = $name;
        $vystup["pripona"] = $pripona;
        $vystup["puvodniNazev"] = $data["soubornazev"];
        
        return $vystup;

    }

    public function smaz($data) {
        $asQ = "SELECT * from web_soubory_kat WHERE id = " . $data["souborId"];
        $sou = db::query($asQ);
        $soubor = array();
        if ($dat = $sou->fetch_assoc()) {
            array_push($soubor, $dat);
            $cesta = "./img/" . $soubor[0]["cesta"] . "/" . $soubor[0]["id"] . "_" . $soubor[0]["nazev"] . "." . $soubor[0]["pripona"];
            unlink($cesta);
            $asQ = "DELETE FROM web_soubory_kat WHERE id = " . $data["souborId"];
            db::query($asQ);
        }
    }

}
