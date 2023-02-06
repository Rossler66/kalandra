const blok_zahlaviobs = document.getElementById("strzahlaviobs");
const blok_zahlavi = document.getElementById("strzahlavi");


const oblZahlavi = {
    root: null,
    threshold: [0.5]
}

blok_zahlavi_observer = new IntersectionObserver(call_zahlavi, oblZahlavi);
blok_zahlavi_observer.observe(blok_zahlaviobs);

function call_zahlavi(entries) {
    const [entry] = entries;

//    if (entry.isIntersecting && entry.intersectionRatio < 1) {
    if (!entry.isIntersecting || entry.intersectionRatio < 1) {
        blok_zahlavi.classList.add("zahlavifixed")
    } else {
        blok_zahlavi.classList.remove("zahlavifixed")
    }
}


const blok_oblasti = document.getElementsByClassName("block_oblasti");
const blok_standard = document.getElementsByClassName("zoom");
let blok_oblasti_observer = [];
let blok_standard_observer = [];
let ii;

const oblOptions = {
    root: null,
    threshold: [0.1]
};

const standardOptions = {
    root: null,
    threshold: [0.2]
};

for (ii = 0; ii < blok_oblasti.length; ii++) {
    blok_oblasti_observer[ii] = new IntersectionObserver(call_oblasti, oblOptions);
    blok_oblasti_observer[ii].observe(blok_oblasti[ii]);
}

for (ii = 0; ii < blok_standard.length; ii++) {
    blok_standard_observer[ii] = new IntersectionObserver(call_standard, standardOptions);
    blok_standard_observer[ii].observe(blok_standard[ii]);
}


function call_oblasti(entries) {
    const [entry] = entries;
//    console.log(entry);

    let pole = entries[0].target.getElementsByClassName("pole");
    if (entry.isIntersecting && entry.intersectionRatio < 1) {
        for (ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.remove("banvolby");
        }

    } else {
        for (ii = 0; ii < pole.length; ii++) {
            pole[ii].classList.add("banvolby");
        }
    }
}

function call_standard(entries) {
    const [entry] = entries;

    if (entry.isIntersecting && entry.intersectionRatio > 0.2) {
        entry.target.classList.remove("zmensi");

    } else {
        entry.target.classList.add("zmensi");
    }
}

function zavridialog(evt) {
    let vstupElement;
    if (evt.target) {
        vstupElement = evt.target;
    }


    while (vstupElement.className.indexOf("dialog")) {
        vstupElement = vstupElement.parentElement;
        if (vstupElement == null) {
            return;
        }
    }

    let parrent = vstupElement.parentNode;
    parrent.removeChild(vstupElement);


}

function setCook(evt) {
    let vstupElement;
    let iko;
    if (evt.target) {
        vstupElement = evt.target;
    }

    let date = new Date();

    let typ = vstupElement.getAttribute("typ");
    let stav = vstupElement.getAttribute("stav");
    let hod = stav + " " + date.getDate();
    date.setDate(date.getDate() + 800);

    if (typ == "vse") {
        document.cookie = "cok=" + hod + "; expires = " + date;
        document.cookie = "stat=" + hod + "; expires = " + date;
        document.cookie = "rekl=" + hod + "; expires = " + date;
        let cook = document.getElementById("cookiesnas");
        cook.parentNode.removeChild(cook);
        return;
    }

    if (stav == "A") {
        stav = "N";
        iko = "./img/iko_vypnuto.svg";
    } else {
        stav = "A";
        iko = "./img/iko_zapnuto.svg";
    }
    vstupElement.setAttribute("stav", stav);
    vstupElement.src = iko;
    document.cookie = typ + "=" + stav + "; expires = " + date;

}

function zavCook(evt) {
    let cook = document.getElementById("cookiesnas");
    cook.parentNode.removeChild(cook);
}


function detCook(evt) {
    let vstupElement;
    if (evt.target) {
        vstupElement = evt.target;
    }
    let detCok = document.getElementById("cokpodrobne");
    if (detCok.className.indexOf("disn") > -1) {
        vstupElement.innerHTML = "Základní nastavení";
        detCok.classList.remove("disn");
    } else {
        vstupElement.innerHTML = "Podrobné nastavení";
        detCok.classList.add("disn");
    }
}

function dokumentZmenNazev(sel) {
    document.getElementById("dokNazev").value = sel.options[sel.selectedIndex].text;
}

function setValue(data) {

    document.getElementById(data["id"]).value = data["value"];
}
