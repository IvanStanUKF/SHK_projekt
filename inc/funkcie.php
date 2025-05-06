<?php
    function pridat_navigaciu(array $odkazy){
        $vystup = "";
        foreach($odkazy as $nazov_odkazu => $odkaz){
            $vystup .= '<li><a href="' . $odkaz . '" class="smoothScroll">' . $nazov_odkazu . '</a></li>';
        }
        return $vystup;
    }

    function mb_ucfirst($string, $kodovanie = "UTF-8") { 
        $prvyZnak = mb_strtoupper(mb_substr($string, 0, 1, $kodovanie), $kodovanie); 
        $zvysok = mb_strtolower(mb_substr($string, 1, null, $kodovanie), $kodovanie);
        return $prvyZnak . $zvysok; 
    }

    function overenieUdajov($meno, $priezvisko, $vek, $telcislo, $email){
        $overenie = false;

        if (empty($meno) || empty($priezvisko) || empty($vek) || empty($telcislo) || empty($email)) {
            echo "<script>alert('Vyplňte požadované údaje!');</script>";
        }
        else if (preg_match('/[^\p{L}]/u', $meno) || preg_match('/[^\p{L}]/u', $priezvisko)) {
            echo "<script>alert('Meno a Priezvisko musia obsahovať iba písmená!');</script>";
        }
        else if (!ctype_digit($vek)) {
            echo "<script>alert('Vek musí byť číslo!');</script>";
        }
        else if (!ctype_digit($telcislo)) {
            echo "<script>alert('Telefónne číslo musí obsahovať iba číslice!');</script>";
        }
        else if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/", $email)) {
            echo "<script>alert('Zlý formát emailu!');</script>";
        }
        else {
            $overenie = true;
        }

        return $overenie;
    }

    function prihlasenie($admin_meno, $admin_heslo){
        $chybaPrihlasenia = true;

        try {
            $databaza = new Databaza();
            $admindata = new AdminData($databaza);
            $admin_udaje = $admindata->index();

            foreach ($admin_udaje as $riadok) {
                if ($admin_meno == $riadok["admin_meno"] && $admin_heslo == $riadok["admin_heslo"]){
                    $formdata = new FormData($databaza);
                    $_SESSION["admin_prihlaseny"] = true;
                    $chybaPrihlasenia = false;
                    break;
                }
            }
        }
        catch (PDOException $e) {
            $chyba = "Chyba pripojenia: " . $e->getMessage();
            echo "<script>alert('$chyba');</script>";
        }
        
        if ($chybaPrihlasenia) {
            echo "<script>alert('Chyba pri prihlásení do admin rozhrania!');</script>";
        }
    }
?>