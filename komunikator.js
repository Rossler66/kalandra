function PosliPozadavek(Param)
{
//alert(Kdo+":"+Zdroj+":"+Form+":"+Param+":"+Fce);
    var XMLHttpRequestObjekt = false;
    if (window.XMLHttpRequest)
    {
        XMLHttpRequestObjekt = new XMLHttpRequest();
    } else if (window.ActiveXObject)
    {
        XMLHttpRequestObjekt = new ActiveXObject("Microsoft.XMLHTTP");
    }

    if (XMLHttpRequestObjekt)
    {
        XMLHttpRequestObjekt.open("POST", "vstup.php", true);
        XMLHttpRequestObjekt.setRequestHeader('Content-Type', 'application/json');
        XMLHttpRequestObjekt.onreadystatechange = function ()
        {
            if (XMLHttpRequestObjekt.readyState === 4 &&
                    XMLHttpRequestObjekt.status === 200)
            {
//            alert("Přijato:"+XMLHttpRequestObjekt.responseText);
                var json = JSON.parse(XMLHttpRequestObjekt.responseText);
                var token;
                var ii = 0;
                while (token = json.token[ii]) {
//                alert(token.typ);


                    //Přidá obsah
                    if (token.typ === "pridejstrance") {
//                        document.getElementById("stranka").innerHTML += token.data;
                        document.getElementById("dialog").innerHTML = token.data;
                    }
                    if (token.typ === "prepisstranku") {
                        document.getElementById("stranka").innerHTML = token.data;
                    }
                    if (token.typ === "soubor") {
                        souborDoStranky(token.data);
                    }

                    if (token.typ === "souborpole") {
                        souborDoPole(token.data);
                    }

                    if (token.typ === "souborclanek") {
                        souborDoClanku(token.data);
                    }

                    if (token.typ === "stranka") {
                        location.href = token.data;
                    }
                    if (token.typ === "setvalue") {
                        setValue(token.data);
                    }
                    /*
                     if (token.typ === "nabstranek") {
                     nabidkaStranek(token.data);
                     }
                     if (token.typ === "zobrazstranku") {
                     zobrazStranku(token.data);
                     }
                     */
                    ii++;
                }
            }
        };
    }
//  alert(Param);
    XMLHttpRequestObjekt.send(Param);
}



function nulujPar() {
    var par; //aktuálně načítené parametry
    par = {};
    par.data = {};
    par.data.form = {};
    return par;
}

function nahrajSoubor(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    if (evt.srcElement) {
        vstupElement = evt.srcElement;
    }
    if (evt.target) {
        vstupElement = evt.target;
    }
    var par = nulujPar(); //aktuálně načítené parametry
    par.jmp = vstupElement.getAttribute("jmp");
    par.pre = vstupElement.getAttribute("pre");
    par.fce = vstupElement.getAttribute("fce");
    var param = vstupElement.getAttribute("par");
    if (param) {
        var parametry = param.split(",");
        for (var ii in parametry) {
            var polozky = parametry[ii].split("=");
            par.data[polozky[0]] = polozky[1];
        }
    }

    var files = evt.dataTransfer.files; // FileList object.
    for (var i = 0, f; f = files[i]; i++) {
        const file = files[i];
        var reader = new FileReader();
        reader.onload = (function (theFile) {
            return function (e) {
                par.data.soubor = reader.result;
                par.data.soubortyp = theFile.type;
                par.data.soubornazev = theFile.name;
                PosliPozadavek(JSON.stringify(par));
            };
        }(f));
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }

}


function posli(evt) {
    var vstupElement;
    if (evt.srcElement) {
        vstupElement = evt.srcElement;
    }
    if (evt.target) {
        vstupElement = evt.target;
    }
    var par = nulujPar();

    par.jmp = vstupElement.getAttribute("jmp");
    par.pre = vstupElement.getAttribute("pre");
    par.fce = vstupElement.getAttribute("fce");
    var param = vstupElement.getAttribute("par");
    if (param) {
        var parametry = param.split(",");
        for (var ii in parametry) {
            var polozky = parametry[ii].split("=");
            par.data[polozky[0]] = polozky[1];
        }
    }
    var formName = vstupElement.getAttribute("form");
    if (formName) {
        var form = document.getElementsByName(formName)[0];
        par.data["form"][form.name] = ctiForm(form);
    }
    zavridialog(evt);
    PosliPozadavek(JSON.stringify(par));
}



function ctiForm(Obj) {
    var pocetSouboru = 0;
    //	var parf = new FormData(Obj);
    //return parf;
    var MinName = "";
    var parf = {};
    var soubor = {};
    soubor.file = "";
    soubor.nazev = "";
    soubor.datum = "";
    soubor.velikost = "";
    soubor.typ = "";
    for (var ii = 0; ii < Obj.length; ii++) {
        if (Obj[ii].name == "") {
            continue;
        }
        if (Obj[ii].type === "textarea") {
            if (Obj[ii].getAttribute("ckedit")) {
                var idCK = Obj[ii].getAttribute("id");
                parf[Obj[ii].name] = CKEDITOR.instances[idCK].getData();
            } else {
                parf[Obj[ii].name] = Obj[ii].value;
            }

        } else if (Obj[ii].type === "file") {
            const soubor = Obj[ii].files[0];
            const reader = new FileReader();
            reader.onload = function (evt) {
                soubor.soubor = reader.result;
                parf[Obj[ii].name] = soubor;
            }
            reader.readAsDataURL(soubor);
        } else if (Obj[ii].type === "radio") {
            if (Obj[ii].checked) {
                parf[Obj[ii].name] = Obj[ii].value;
            }
        } else if (Obj[ii].type === "checkbox") {
            if (Obj[ii].checked) {
                if (parf[Obj[ii].name] > "") {
                    parf[Obj[ii].name] = parf[Obj[ii].name] + "," + Obj[ii].value;
                } else {
                    parf[Obj[ii].name] = Obj[ii].value;
                }
            }
        } else {
            parf[Obj[ii].name] = Obj[ii].value;
        }
    }
    return parf;
}


function nastavDrag(evt) {
    console.log('File(s) in drop zone');
    // Prevent default behavior (Prevent file from being opened)
    evt.preventDefault();
}
