/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var bEditace = false;
var editObj = null;
var editpanel = null;
var dragObjekt = null;



function dragmod(){
    let body = document.getElementsByTagName("body")[0];
        body.addEventListener("dragover", nastavDrag);
}

function editmod() {
    let editbod = document.getElementById("editbod");
    let body = document.getElementsByTagName("body")[0];
    let editstranka = document.getElementById("editstranka");
    let nabidka = document.getElementById("nabidka");
    let obsah = document.getElementById("obsah");
    let smaz;
    let blok;

    if (bEditace) {
        bEditace = false;
        editbod.style.backgroundColor = "#6666";
//        body.removeEventListener("dragover", nastavDrag);
        body.removeEventListener("click", upravPrvek);
        zavriPanel();
        editstranka.style.display="none";
        nabidka.style.display="none";
        editpanel = null;

        
        smaz = document.getElementsByClassName("ikoedit");
        while (smaz.length > 0) {
            blok = smaz[0].parentNode;
            blok.removeChild(smaz[0]);
        }
        smaz = document.getElementsByClassName("editace");
        while (smaz.length > 0) {
            smaz[0].classList.remove("editace");
        }
        smaz = document.getElementsByTagName("A");
        for (let ii = 0; ii < odkA.length; ii++) {
            smaz[ii].removeAttribute("onclick");
        }


    } else {
        bEditace = true;
        editbod.style.backgroundColor = "#f00a";
//        body.addEventListener("dragover", nastavDrag);
        body.addEventListener("click", upravPrvek);
        editstranka.style.display="block";
        let stranka = document.getElementById("obsah");
        let inp = editstranka.getElementsByTagName("INPUT")[0];
        inp.value = stranka.getAttribute("nazev");
        
        obsah.classList.add("editace");
        let bloky = obsah.getElementsByClassName("block");
        let addDiv;
        for (let ii = 0; ii < bloky.length; ii++) {
            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("pridejblok");
            addDiv.addEventListener("click", pridejBlok);
            bloky[ii].appendChild(addDiv);

            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("upravblok");
            addDiv.addEventListener("click", upravBlok);
            bloky[ii].appendChild(addDiv);

            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("pridejpole");
            addDiv.addEventListener("click", pridejPole);
            bloky[ii].appendChild(addDiv);
            bloky[ii].setAttribute("draggable",true);
//            bloky[ii].addEventListener("drop",prvekDragEnd);
//            bloky[ii].addEventListener("dragstart",prvekDragStart);
        }
        let pole = obsah.getElementsByClassName("pole");
        for (let ii = 0; ii < pole.length; ii++) {
            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("upravpole");
            addDiv.addEventListener("click", upravPole);
            pole[ii].appendChild(addDiv);

            addDiv = document.createElement("DIV");
            addDiv.classList.add("ikoedit");
            addDiv.classList.add("pridejprvek");
            addDiv.addEventListener("click", pridejPrvek);
            pole[ii].appendChild(addDiv);

            pole[ii].setAttribute("draggable",true);
//            pole[ii].addEventListener("drop",prvekDragEnd);
//            pole[ii].addEventListener("dragstart",prvekDragStart);
        }
        odkA = document.getElementsByTagName("A");
        for (let ii = 0; ii < odkA.length; ii++) {
            odkA[ii].setAttribute("onclick","return false;");
        }
    }
}

function prvekDragStart(evt){
    if(!evt.target){
        return;
    }
    dragObjekt = evt.target;
//    let className = dragObjekt.className;
//    alert(className);
}

function prvekDragEnd(evt){
    if(!drag || dragObjekt === null){
        return;
    }
    let dropObjekt = evt.target;
    let classStart = 0;
    if(dragObject.classList.contains("pole")){$classStrart = "P";}
    if(dragObject.classList.contains("block")){$classStrart = "B";}

    if(dragObject.classList.contains("pole")){$classStrart = "P";}
    if(dragObject.classList.contains("block")){$classStrart = "B";}

    let classCil
    let className = dropObjekt.className;
//    alert(className);
    if(dragObjekt == dropObjekt){
        return;
    }
//    let calssName = dragObjekt.getClassName();
    dropObjekt.appendChild(dragObjekt);
    dragObjekt = null;

}

function zavriPanel() {
    if (editpanel) {
        editpanel.style.display = "none";
        editpanel = null;
    }
}

function pridejBlok(evt) {
    let aktBlok;
    let addDiv;
    if (evt.target) {
        aktBlok = evt.target;
    }
    aktBlok = aktBlok.parentNode;

    let addBlok = document.createElement("DIV");
    addBlok.classList.add("block");
    addBlok.classList.add("block_standard");
    let addCont = document.createElement("DIV");
    addCont.classList.add("container");
    addBlok.appendChild(addCont);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("pridejblok");
    addDiv.addEventListener("click", pridejBlok);
    addBlok.appendChild(addDiv);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("upravblok");
    addDiv.addEventListener("click", upravBlok);
    addBlok.appendChild(addDiv);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("pridejpole");
    addDiv.addEventListener("click", pridejPole);
    addBlok.appendChild(addDiv);


    aktBlok.parentNode.insertBefore(addBlok, aktBlok);
}

function blokNahoru(evt) {
    let nadramec = editObj.parentNode;
    let pred = editObj.previousElementSibling;
    if (pred != null) {
        let pomblok = nadramec.removeChild(editObj);
        nadramec.insertBefore(pomblok, pred);
    }
}

function blokDolu(evt) {
    let nadramec = editObj.parentNode;
    let po = editObj.nextElementSibling;
    if (po != null) {
        po = po.nextElementSibling;
        let pomblok = nadramec.removeChild(editObj);
        nadramec.insertBefore(pomblok, po);
    }

}

function blokNahoruInput(evt) {
    let posBlok = editObj.parentNode;
    let nadramec = posBlok.parentNode;
    let pred = posBlok.previousElementSibling;
    if (pred != null) {
        let pomblok = nadramec.removeChild(posBlok);
        nadramec.insertBefore(pomblok, pred);
    }
}

function blokDoluInput(evt) {
    let posBlok = editObj.parentNode;
    let nadramec = posBlok.parentNode;
    let po = posBlok.nextElementSibling;
    if (po != null) {
        po = po.nextElementSibling;
        let pomblok = nadramec.removeChild(posBlok);
        nadramec.insertBefore(pomblok, po);
    }
}

function blokSmaz(evt) {
    if (!editObj) {
        return;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }

    editObj.remove();
    editObj = null;
    editpanel = null;
}

function blokSmazInput(evt) {
    if (!editObj) {
        return;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }

    editObj.parentNode.remove();
    editObj = null;
    editpanel = null;
}


function upravBlok(evt) {
    let element;
    if (evt.target) {
        element = evt.target;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }
    editpanel = document.getElementById("editblock");
    if (editObj === element) {
        return;
    }
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = element.parentNode;
    document.getElementById("nazevBloku").value = editObj.id;

    editObj.classList.add("editace");
    editpanel.style.display = "block";
}

function nastavNazevBloku(){
    if (!editObj) {
        return;
    }
    editObj.id = document.getElementById("nazevBloku").value;
}

function nastavZarovnaniTextu(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let typ = aktBlok.getAttribute("typ");
    if (!typ) {
        return;
    }
    editObj.classList.remove("tal");
    editObj.classList.remove("tac");
    editObj.classList.remove("tar");
    editObj.classList.add(typ);
}


function nastavVelikostTextu(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let typ = aktBlok.getAttribute("hodnota");
    if (!typ) {
        return;
    }
    editObj.classList.remove("txs_xs");
    editObj.classList.remove("txs_s");
    editObj.classList.remove("txs_m");
    editObj.classList.remove("txs_l");
    editObj.classList.remove("txs_xl");
    editObj.classList.add(typ);
}


function nastavBarvuPozadi(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let barva = "bcg_" + aktBlok.getAttribute("barva");
    if (!barva) {
        return;
    }
    editObj.classList.remove("bcg_bila");
    editObj.classList.remove("bcg_seda");
    editObj.classList.remove("bcg_bledemodra");
    editObj.classList.remove("bcg_tmavomodra");
    editObj.classList.remove("bcg_transparent");
    editObj.classList.remove("bcg_bila3");
    editObj.classList.remove("bcg_seda3");
    editObj.classList.remove("bcg_bledemodra3");
    editObj.classList.remove("bcg_tmavomodra3");
    editObj.classList.remove("bcg_bila2");
    editObj.classList.remove("bcg_seda2");
    editObj.classList.remove("bcg_bledemodra2");
    editObj.classList.remove("bcg_tmavomodra2");
    editObj.classList.remove("bcg_bila1");
    editObj.classList.remove("bcg_seda1");
    editObj.classList.remove("bcg_bledemodra1");
    editObj.classList.remove("bcg_tmavomodra1");
    editObj.classList.add(barva);
}

function nastavBarvuTextu(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let barva = "col_" + aktBlok.getAttribute("barva");
    if (!barva) {
        return;
    }
    editObj.classList.remove("col_bila");
    editObj.classList.remove("col_seda");
    editObj.classList.remove("col_bledemodra");
    editObj.classList.remove("col_tmavomodra");
    editObj.classList.remove("col_transaprent");
    editObj.classList.add(barva);
}


function nastavRamecek(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let barva = "bor_" + aktBlok.getAttribute("barva");
    if (!barva) {
        return;
    }
    editObj.classList.remove("bor_bila");
    editObj.classList.remove("bor_seda");
    editObj.classList.remove("bor_bledemodra");
    editObj.classList.remove("bor_tmavomodra");
    editObj.classList.remove("bor_transaprent");
    editObj.classList.add(barva);
}

function nastavStin(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("stin");
    if (hodnota !== "---") {
        editObj.classList.add(hodnota);
    }
}

function nastavZoom(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("zoom");
    if (hodnota !== "---") {
        editObj.classList.add(hodnota);
    }
}


function nastavTypBloku(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let typ = "block_" + aktBlok.getAttribute("typ");
    if (!typ) {
        return;
    }
    editObj.classList.remove("block_hlava");
    editObj.classList.remove("block_oblasti");
    editObj.classList.remove("block_info");
    editObj.classList.remove("block_standard");
    editObj.classList.add(typ);

}

function nastavTypInput(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let typ = aktBlok.getAttribute("hodnota");
    if (!typ) {
        return;
    }
    editObj.setAttribute("type",typ);

}


function pridejPole(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    aktBlok = aktBlok.parentNode.firstElementChild;

    let addPole = document.createElement("DIV");
    addPole.classList.add("pole");
    addPole.classList.add("pole3");
    addPole.classList.add("poleM");
    addPole.classList.add("bcg_seda");
    
    let addA = document.createElement("A");
    addA.classList.add("odkaz");
    addPole.appendChild(addA);

    let addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("upravpole");
    addDiv.addEventListener("click", upravPole);
    addPole.appendChild(addDiv);

    addDiv = document.createElement("DIV");
    addDiv.classList.add("ikoedit");
    addDiv.classList.add("pridejprvek");
    addDiv.addEventListener("click", pridejPrvek);
    addPole.appendChild(addDiv);

    aktBlok.appendChild(addPole);
}

function upravPole(evt) {
    let element;
    if (evt.target) {
        element = evt.target;
    }
    if (editpanel) {
        editpanel.style.display = "none";
    }
    editpanel = document.getElementById("editpole");
    if (editObj === element) {
        return;
    }
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = element.parentNode;
    editObj.classList.add("editace");
    editpanel.style.display = "block";

}

function nastavPocetPole(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("typ");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("pole1");
    editObj.classList.remove("pole2");
    editObj.classList.remove("pole3");
    editObj.classList.remove("pole4");
    editObj.classList.add(hodnota);

}

function nastavVyskaPole(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("pole_v1");
    editObj.classList.remove("pole_v2");
    editObj.classList.remove("pole_v3");
    editObj.classList.remove("pole_v4");
    editObj.classList.remove("pole_v5");
    editObj.classList.remove("pole_v6");
    editObj.classList.remove("pole_v7");
    editObj.classList.remove("pole_v8");
    editObj.classList.remove("pole_v9");
    if (hodnota !== "---") {
        editObj.classList.add(hodnota);
    }
}


function nastavSirkaPole(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("typ");
    if (!hodnota) {
        return;
    }
    editObj.classList.remove("poleS");
    editObj.classList.remove("poleM");
    editObj.classList.remove("poleL");
    editObj.classList.add(hodnota);

}

function nastavSirkuInput(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("hodnota");
    if (!hodnota) {
        return;
    }
    let divObj = editObj.parentElement;
    divObj.classList.remove("w25po");
    divObj.classList.remove("w50po");
    divObj.classList.remove("w75po");
    divObj.classList.remove("w100po");
    divObj.classList.add(hodnota);

}

function nastavRequired(evt){
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let hodnota = aktBlok.getAttribute("hodnota");
    if (hodnota === "A") {
        editObj.required = true;
    }else{
        editObj.required = false;

    }
}


function pridejPrvek(evt) {
    zavriPanel();
    editpanel = document.getElementById("pridejprvek");
    editpanel.style.display = "block";
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    editObj = aktBlok.parentNode;

}

function pridejObrazek(evt) {
    let addPrvek = document.createElement("IMG");
    addPrvek.classList.add("prvek");
    editObj.appendChild(addPrvek);
}

function pridejNadpis(evt) {
    let addPrvek = document.createElement("H2");
    addPrvek.classList.add("prvek");
    addPrvek.innerHTML = "Nadpis";
    editObj.appendChild(addPrvek);
}

function pridejText(evt) {
    let addPrvek = document.createElement("P");
    addPrvek.classList.add("prvek");
    addPrvek.innerHTML = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit.";
    editObj.appendChild(addPrvek);
}

function pridejMapu(evt){
    let addPrvek = document.createElement("IFRAME");
    addPrvek.classList.add("prvek");
//    addPrvek.src = "https://www.google.com/maps/d/u/4/embed?mid=1wQGyZeagyxXI9NW0e5K5Y32GHuA&amp;ehbc=2E312F";
    addPrvek.src = "https://www.google.com/maps/d/embed?mid=1wQGyZeagyxXI9NW0e5K5Y32GHuA&ehbc=2E312F";
    addPrvek.style = "width:100%; height:800px;";
    editObj.appendChild(addPrvek);
}

function pridejInput(evt) {
    let form = editObj.getElementsByTagName("FORM")[0];
    if(!form){
        form = document.createElement("form");
        form.classList.add("prvek");
        form.addEventListener("onsubmit", posliform);
        form.setAttribute("action","");
        form.setAttribute("method","POST");
        editObj.appendChild(form);
    }
    let addPrvek = document.createElement("DIV");
    addPrvek.classList.add("inputprvek");
    addPrvek.classList.add("w50po");
    addPrvek.innerHTML = '<div class="nav">Nadpis</div><input class="prvek" type="text" onkeydown="return event.key !==\'Enter\'"  />';
    form.appendChild(addPrvek);
}

function pridejSelect(evt) {
    let form = editObj.getElementsByTagName("FORM")[0];
    if(!form){
        form = document.createElement("form");
        form.setAttribute("action","");
        form.setAttribute("method","POST");
        editObj.appendChild(form);
    }
    let addPrvek = document.createElement("DIV");
    addPrvek.classList.add("inputprvek");
    addPrvek.classList.add("w50po");
    addPrvek.innerHTML = '<div class="nav">Nadpis</div><select class="prvek" type="text" onkeydown="return event.key !==\'Enter\'"  ><option>aaa</option>></select>';
    form.appendChild(addPrvek);
}

function pridejTlacitko(evt) {
    let form = editObj.getElementsByTagName("FORM")[0];
    if(!form){
        form = document.createElement("form");
        editObj.appendChild(form);
    }
    let addPrvek = document.createElement("DIV");
    addPrvek.classList.add("inputprvek");
    addPrvek.classList.add("w50po");
    addPrvek.innerHTML = '<input class="prvek" type="submit" />';
    form.appendChild(addPrvek);
}

function upravPrvek(evt) {
    let aktPrvek;
    if (evt.target) {
        aktPrvek = evt.target;
    }
    if (aktPrvek.className.indexOf("prvek") < 0) {
        return;
    }

    /*    if (editObj == aktPrvek) {
     return;
     }*/
    if (aktPrvek.tagName === "IMG") {
        upravObrazek(aktPrvek);
    }
    if (aktPrvek.tagName === "H1" || aktPrvek.tagName === "H2" || aktPrvek.tagName === "H3" || aktPrvek.tagName === "H4" || aktPrvek.tagName === "H56" || aktPrvek.tagName === "H6") {
        upravNadpis(aktPrvek);
    }
    if (aktPrvek.tagName === "P") {
        upravText(aktPrvek);
    }

    if (aktPrvek.tagName === "FORM") {
        upravForm(aktPrvek);
    }

    if (aktPrvek.tagName === "INPUT") {
        if(aktPrvek.getAttribute("type") === "submit"){
            upravTlacitko(aktPrvek);
            return false;
        }else{
            upravInput(aktPrvek);
        }
    }
    if (aktPrvek.tagName === "SELECT") {
        upravSelect(aktPrvek);

    }
    return false;
}

function retfals(){
    return false;
}

function upravObrazek(edOb) {
    zavriPanel();
    editpanel = document.getElementById("editobrazek");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
}

function upravNadpis(edOb) {
    zavriPanel();
    editpanel = document.getElementById("editnadpis");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    editRadek(edOb);
}


function souborDoStranky(data) {
    editObj.src = data.cesta;
}

function souborDoPole(data) {
    let styl = ' background-image: url('+data.cesta+');';
    editObj.setAttribute("style",styl);
}


function editRadek(element) {
    let input;
    let sirka = element.offsetWidth;
    let vyska = element.offsetHeight;
    let paddingLeft = window.getComputedStyle(element, null).getPropertyValue("padding-left");
    let paddingTop = window.getComputedStyle(element, null).getPropertyValue("padding-top");
//    let paddingRight = window.getComputedStyle(element, null).getPropertyValue("padding-right");
//    let paddingBottom = window.getComputedStyle(element, null).getPropertyValue("padding-bottom");
//    sirka = sirka - parseInt(paddingLeft) - parseInt(paddingRight);
//    vyska = vyska - parseInt(paddingTop) - parseInt(paddingBottom);
    input = document.createElement("INPUT");
    input.onblur = opustRadek;
    input.value = element.innerHTML;
    element.innerHTML = "";
    element.appendChild(input);
    input.style.width = sirka + "px";
    input.style.height = vyska + "px";
    input.style.padding = 0;
    input.style.margin = 0;
    input.style.fontFamily = window.getComputedStyle(element, null).getPropertyValue("font-family");
    input.style.fontWeight = window.getComputedStyle(element, null).getPropertyValue("font-weight");
    input.style.fontSize = window.getComputedStyle(element, null).getPropertyValue("font-size");
    input.style.color = window.getComputedStyle(element, null).getPropertyValue("color");
    input.style.textAlign = window.getComputedStyle(element, null).getPropertyValue("text-align");
    input.style.letterSpacing = window.getComputedStyle(element, null).getPropertyValue("letter-spacing");
    input.style.backgroundColor = window.getComputedStyle(element, null).getPropertyValue("background-color");
    input.focus();
}


function opustRadek() {
    var input = editObj.firstElementChild;
    if (input == null) {
        return;
    }
    let text = input.value;
    let parrent = input.parentNode;
    parrent.removeChild(input);
    parrent.innerHTML = text;
}

function upravText(edOb) {
    zavriPanel();
    editpanel = document.getElementById("edittext");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    editText(edOb);
}

function upravInput(edOb) {
    zavriPanel();
    editpanel = document.getElementById("editinput");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    let inp = editpanel.getElementsByTagName("INPUT")[0];
    inp.value = editObj.previousElementSibling.innerHTML;
}

function upravSelect(edOb) {
    zavriPanel();
    editpanel = document.getElementById("editselect");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    let inp = editpanel.getElementsByTagName("INPUT")[0];
    inp.value = editObj.previousElementSibling.innerHTML;
    upravSelectOptions();
}

function upravSelectOptions(){
    let opt = "";
    for(let ii = 0; ii < editObj.options.length; ii++){
        opt = opt + '<p class="optpolozka" index="'+ii+'">'+editObj.options[ii].text+'</p>';
    }
    document.getElementById("optionshodnoty").innerHTML = opt;

}

function upravTlacitko(edOb) {
    zavriPanel();
    editpanel = document.getElementById("edittlacitko");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    editpanel.style.display = "block";
    let inp = editpanel.getElementsByTagName("INPUT")[0];
    inp.value = editObj.value;

}

function upravForm(edOb){
    zavriPanel();

    editpanel = document.getElementById("editform");
    if (editObj) {
        editObj.classList.remove("editace");
    }
    editObj = edOb;
    editObj.classList.add("editace");
    let inp = editpanel.getElementsByTagName("INPUT")[0];
    inp.value = editObj.name;

    editpanel.style.display = "block";
}

function inputnadpis(evt){
    if (evt.target) {
        aktBlok = evt.target;
    }
    editObj.previousElementSibling.innerHTML = aktBlok.value;
    editObj.setAttribute("name",aktBlok.value);
}

function formnazev(evt){
    if (evt.target) {
        aktBlok = evt.target;
    }
    editObj.setAttribute("name",aktBlok.value);
}

function inputhodnota(evt){
    if (evt.target) {
        aktBlok = evt.target;
    }
    let opt = document.createElement("OPTION");
    opt.text = aktBlok.value;
    editObj.add(opt);
    aktBlok.value = "";
    upravSelectOptions();
}

function deletehodnota(evt){
    if (evt.target) {
        aktBlok = evt.target;
    }
    let index = aktBlok.getAttribute("index");
    if(index){
        editObj.options.remove(index);
    }
    upravSelectOptions();

}

function tlacitkopopis(evt){
    if (evt.target) {
        aktBlok = evt.target;
    }
    editObj.value = aktBlok.value;
}


function editText(element) {
    let sirka = element.offsetWidth;
    let vyska = element.offsetHeight;
    let paddingLeft = window.getComputedStyle(element, null).getPropertyValue("padding-left");
    let paddingTop = window.getComputedStyle(element, null).getPropertyValue("padding-top");
    let paddingRight = window.getComputedStyle(element, null).getPropertyValue("padding-right");
    let paddingBottom = window.getComputedStyle(element, null).getPropertyValue("padding-bottom");
    sirka = sirka - parseInt(paddingLeft) - parseInt(paddingRight);
    vyska = vyska - parseInt(paddingTop) - parseInt(paddingBottom);
    texar = document.createElement("TEXTAREA");
    texar.id = "editext";
    texar.onblur = opustArea;
    let pztxt = element.innerHTML;
    let pctxt = pztxt.replace(/<br>/g, '\n');
    texar.innerHTML = pctxt;
    element.innerHTML = "";
    element.appendChild(texar);
    texar.style.width = sirka + "px";
    texar.style.height = vyska + "px";
    texar.style.fontFamily = window.getComputedStyle(element, null).getPropertyValue("font-family");
    texar.style.fontWeight = window.getComputedStyle(element, null).getPropertyValue("font-weight");
    texar.style.fontSize = window.getComputedStyle(element, null).getPropertyValue("font-size");
    texar.style.color = window.getComputedStyle(element, null).getPropertyValue("color");
    texar.style.textAlign = window.getComputedStyle(element, null).getPropertyValue("text-align");
    texar.style.letterSpacing = window.getComputedStyle(element, null).getPropertyValue("letter-spacing");
    texar.style.backgroundColor = window.getComputedStyle(element, null).getPropertyValue("background-color");
    texar.focus();

}

function opustArea() {
    if (texar == null) {
        return;
    }
    let text = texar.value;
    let parrent = texar.parentNode;
    parrent.removeChild(texar);
    parrent.innerHTML = text.replace(/\n/g, '<br>');
    texar = null;
}

function nastavTagPrvku(evt) {
    let aktBlok;
    if (evt.target) {
        aktBlok = evt.target;
    }
    let tag = aktBlok.getAttribute("typ");
    if (!tag) {
        return;
    }
    let novTag = document.createElement(tag);
    novTag.innerHTML = editObj.innerHTML;

    let poc = editObj.classList.length;
    for (let ii = 0; ii < poc; ii++) {
        novTag.classList.add(editObj.classList[ii]);
    }
    let prvNad = editObj.parentNode;
    prvNad.insertBefore(novTag, editObj);
    prvNad.removeChild(editObj);
    editObj = novTag;


}

function nabOdkazy() {
    let par = nulujPar(); //aktuálně načítené parametry
    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "nabOdkazy";
    PosliPozadavek(JSON.stringify(par));
}

function vlozOdkaz(evt,odkaz){
    var odkA;
    if(editObj.tagName == "DIV") {
        odkA = editObj.getElementsByTagName("A")[0];
    }else{
        odkA = editObj.parentNode;
        if(odkA.tagName != "A"){
            let prvNad = odkA;
            odkA = document.createElement("A");
            odkA.appendChild(editObj);
            prvNad.appendChild(odkA);
            odkA.setAttribute("onclick","return false;")

        }
    }
    let cesta = odkaz;
    odkA.href =cesta;
    zavridialog(evt);
}

function vlozOdkazURL(evt){
    let odkaz = document.getElementById("odkazURL").value;

    if(editObj.tagName == "DIV") {
        odkA = editObj.getElementsByTagName("A")[0];
    }else{
        odkA = editObj.parentNode;
        if(odkA.tagName != "A"){
            let prvNad = odkA;
            odkA = document.createElement("A");
            odkA.appendChild(editObj);
            prvNad.appendChild(odkA);
            odkA.setAttribute("onclick","return false;")

        }
    }

    let cesta = odkaz;
    odkA.href =cesta;
    zavridialog(evt);
}

function odkazSmaz(evt){
    var odkA;
    if(editObj.tagName == "DIV") {
        odkA = editObj.getElementsByTagName("A")[0];
    }else{
        odkA = editObj.parentNode;
        if(odkA.tagName != "A"){
            return;
        }
    }
    odkA.href ="#";
}

function strankaSeznam() {
    editmod();
    let par = nulujPar(); //aktuálně načítené parametry
    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "nabStranky";
    PosliPozadavek(JSON.stringify(par));
}

function strankaPridej(){
    editmod();
    let stranka = document.getElementById("obsah");
    stranka.setAttribute("idstr", 0);
    stranka.setAttribute("nazev","Nová stránka");
    stranka.innerHTML = '<div class="block block_standard"><div class="container"></div></div>';
    let inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    inp.value = "Nová stránka";
    editmod();
}

function strankaKopy(){
    editmod();
    let stranka = document.getElementById("obsah");
    stranka.setAttribute("idstr", 0);
    let nazev = stranka.getAttribute("nazev")+" - kopie";
    stranka.setAttribute("nazev",nazev);
    let inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    inp.value = nazev;
    editmod();
    
}

function strankaUloz(){
    editmod();
    let stranka = document.getElementById("obsah");
    let inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    let par = nulujPar();
    par.data.id = stranka.getAttribute("idstr");
    par.data.nazev = inp.value;
    par.data.obsah = stranka.innerHTML;
    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "ulozstranku";
    PosliPozadavek(JSON.stringify(par));
    
}

/*
function zobrazStranku(param){
    let stranka = document.getElementById("stranka");
    stranka.setAttribute("idstr", param.id);
    stranka.setAttribute("nazev",param.nazev);
    stranka.innerHTML = param.obsah;
    let inp = document.getElementById("editstranka").getElementsByTagName("INPUT")[0];
    inp.value = param.nazev;
    editmod();
}
*/

function nactiStranku(evt){
    let aktBlok;
    document.getElementById("nabidka").style.display = "none";
    
    if (evt.target) {
        aktBlok = evt.target;
    }
    while(aktBlok.tagName !== "TR" && aktBlok !== null){
        aktBlok = aktBlok.parentNode;
    }
    if(aktBlok === null){return;}
    let par = nulujPar();
    par.data.id = aktBlok.getAttribute("id");

    par.jmp = "stranka";
    par.pre = "stranka";
    par.fce = "nactistranku";
    PosliPozadavek(JSON.stringify(par));
}

function nabidkaStranek(data){
    let nab = document.getElementById("nabidka");
    nab.innerHTML = data.obsah;
    nab.addEventListener("click", nactiStranku);
   nab.style.display = "block";
}

function posliform(){
//    if (evt.target) {
//        aktForm = evt.target;
//    }
    if(bEditace) {return false;}
    alert(1);
}

function souborDoClanku(data) {
    let fotoclanek = document.getElementById("fotoclanek");
    let fotoimg = document.createElement("img");
    fotoimg.src = data.cesta;
    fotoimg.setAttribute("fotoId",data.id);
    fotoimg.addEventListener("click", souborZeClanku);
    fotoclanek.appendChild(fotoimg);
    souborClankuNastav();
}

function souborZeClanku(evt){
    let foto = evt.target;
    foto.remove();
    souborClankuNastav();
}

function souborClankuNastav(){
    let fotoclanek = document.getElementById("fotoclanek");
    let fotky = fotoclanek.getElementsByTagName("img");
    let fotoid = "";
    let odd = "";
    for(let ii = 0; ii < fotky.length; ii++){
        fotoid = fotoid+odd+fotky[ii].getAttribute("fotoid");
        odd = ",";
    }
    document.getElementById("fotoClanekId").value = fotoid;
}

