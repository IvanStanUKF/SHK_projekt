function overenie_formularu(event) {
    var meno = document.getElementById("firstname").value;
    var priezvisko = document.getElementById("lastname").value;
    var vek = document.getElementById("age").value;
    var telcislo = document.getElementById("phone").value;
    var email = document.getElementById("email").value;
    
    if (meno == "" || priezvisko == "" || vek == "" || telcislo == "" || email == "") {
        alert("Vyplňte požadované údaje!");
        event.preventDefault();
        return;
    }

    else if (!/^[a-zA-Z]+$/.test(meno)) {
        alert("Meno nemôže obsahovať číslice!");
        event.preventDefault();
        return;
    }

    else if (/\d/.test(meno)) {
        alert("Meno nemôže obsahovať číslice!");
        event.preventDefault();
        return;
    }

    else if (/\d/.test(priezvisko)) {
        alert("Priezvisko nemôže obsahovať číslice!");
        event.preventDefault();
        return;
    }

    else if (/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email) == false) {
        alert("Zlý formát emailu!");
        event.preventDefault();
        return;
    }

    else {
        var potvrdenie = confirm(
            "Skontrolujte svoje údaje:\n" +
            "Meno: " + meno + "\n" +
            "Priezvisko: " + priezvisko + "\n" +
            "Vek: " + vek + "\n" +
            "Telefónne číslo: " + telcislo + "\n" +
            "Email: " + email + "\n\n" +
            "Kliknite na OK pre potvrdenie údajov a súhlasenie s ich spracovaním. Kliknite na Zrušiť pre opravu údajov.\n"
        );

        if (potvrdenie) {
            alert("Registrácia prebehla úspešne, viac informácií vám poskytneme emailom.");
        } 
        else {
            event.preventDefault();
            return;
        }
    }
}

document.getElementById("registracia").addEventListener("submit", overenie_formularu);