function overenie_formularu(event) {
    var meno = document.getElementById("firstname").value.trim();
    var priezvisko = document.getElementById("lastname").value.trim();
    var vek = document.getElementById("age").value.trim();
    var telcislo = document.getElementById("phone").value.trim();
    var email = document.getElementById("email").value.trim();
    telcislo = telcislo.replace(/\s+/g, "");
    
    if (meno.trim() === "" || priezvisko.trim() === "" || vek.trim() === "" || telcislo.trim() === "" || email.trim() === "") {
        alert("Vyplňte požadované údaje!");
        event.preventDefault();
        return;
    }

    else if (!/^[\p{L}]+$/u.test(meno) || !/^[\p{L}]+$/u.test(priezvisko)) {
        alert("Meno a Priezvisko musia obsahovať iba písmená!");
        event.preventDefault();
        return;
    }

    else if (!/^\d+$/.test(vek)) {
        alert("Vek musí byť číslo!");
        event.preventDefault();
        return;
    }

    else if (!/^\d+$/.test(telcislo)) {
        alert("Telefónne číslo musí obsahovať iba číslice!");
        event.preventDefault();
        return;
    }

    else if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email)) {
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

        if (!potvrdenie) {
            event.preventDefault();
            return;
        }
    }
}

document.getElementById("registracia").addEventListener("submit", overenie_formularu);