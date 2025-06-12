<?php
    class FormData {
        private $databaza;

        public function __construct(Databaza $databaza) {
            $this->databaza = $databaza->getSpojenie();
        }

        public function mb_ucfirst($string, $kodovanie = "UTF-8") { 
            $prvyZnak = mb_strtoupper(mb_substr($string, 0, 1, $kodovanie), $kodovanie); 
            $zvysok = mb_strtolower(mb_substr($string, 1, null, $kodovanie), $kodovanie);
            return $prvyZnak . $zvysok; 
        }

        public function overenieUdajov($meno, $priezvisko, $vek, $telcislo, $email){
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

        public function kontrolaDuplicityKontaktu($telcislo, $email, $uprava, $id = 0){
            if ($uprava) {
                $dotaz = $this->databaza->prepare("SELECT COUNT(*) FROM formdata WHERE (telcislo = :telcislo OR email = :email) AND (id_formdata != :id)");
                $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            }
            else {
                $dotaz = $this->databaza->prepare("SELECT COUNT(*) FROM formdata WHERE (telcislo = :telcislo OR email = :email)");
            }

            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            $dotaz->execute();

            $pocet = $dotaz->fetchColumn();
            if ($pocet == 0) {
                return true;
            }
            else {
                echo "<script>alert('Zadaný email alebo telefónne číslo už je zaregistrované!');</script>";
                return false;
            }
        }
        
        public function getStavy() {
            $dotaz = $this->databaza->prepare("SELECT * FROM formdata_stav");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function index() {
            $dotaz = $this->databaza->prepare("SELECT f.*, fs.stav FROM formdata f LEFT OUTER JOIN formdata_stav fs ON f.stav_id = fs.id_stav");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }

        public function odstranitUdaje($id) {
            $dotaz = $this->databaza->prepare("DELETE FROM formdata WHERE id_formdata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            return $dotaz->execute();
        }
 
        public function pridatUdaje($meno, $priezvisko, $vek, $telcislo, $email) {
            if (!$this->kontrolaDuplicityKontaktu($telcislo, $email, false)) { return false; }

            $dotaz = $this->databaza->prepare("INSERT INTO formdata (meno, priezvisko, vek, telcislo, email, stav_id) values(:meno, :priezvisko, :vek, :telcislo, :email, :stav_id)");
            
            $dotaz->bindParam(":meno", $meno, PDO::PARAM_STR);
            $dotaz->bindParam(":priezvisko", $priezvisko, PDO::PARAM_STR);
            $dotaz->bindParam(":vek", $vek, PDO::PARAM_INT);
            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            $dotaz->bindValue(":stav_id", 1, PDO::PARAM_INT);
            
            return $dotaz->execute();
        }

        public function zobrazitUdaj($id) {
            $dotaz = $this->databaza->prepare("SELECT * FROM formdata WHERE id_formdata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->execute();
            return $dotaz->fetch(PDO::FETCH_ASSOC);
        }
    
        public function zmenitUdaje($id, $meno, $priezvisko, $vek, $telcislo, $email, $stav_id) {
            if (!$this->kontrolaDuplicityKontaktu($telcislo, $email, true, $id)) { return false; }

            $dotaz = $this->databaza->prepare("UPDATE formdata SET meno = :meno, priezvisko = :priezvisko, vek = :vek, telcislo = :telcislo, email = :email, stav_id = :stav_id WHERE id_formdata = :id");
    
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->bindParam(":meno", $meno, PDO::PARAM_STR);
            $dotaz->bindParam(":priezvisko", $priezvisko, PDO::PARAM_STR);
            $dotaz->bindParam(":vek", $vek, PDO::PARAM_INT);
            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            $dotaz->bindParam(":stav_id", $stav_id, PDO::PARAM_INT);
            
            return $dotaz->execute();
        }
    }
?>