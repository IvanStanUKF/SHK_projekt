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
                return true;
            }

            return false;
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

        public function kontrolaKapacity($kurz_id) {
            if (is_null($kurz_id)) { return true; }

            $dotaz_k = $this->databaza->prepare("SELECT kapacita FROM kurzy WHERE id_kurzy = :kurz_id");
            $dotaz_k->bindParam(":kurz_id", $kurz_id, PDO::PARAM_INT);
            $dotaz_k->execute();
            $kapacita = $dotaz_k->fetchColumn();

            $dotaz_p = $this->databaza->prepare("SELECT COUNT(*) FROM formdata WHERE kurz_id = :kurz_id");
            $dotaz_p->bindParam(":kurz_id", $kurz_id, PDO::PARAM_INT);
            $dotaz_p->execute();
            $pocet = $dotaz_p->fetchColumn();

            if ($pocet+1 <= $kapacita) {
                return true;
            }
            else {
                echo "<script>alert('Zadaný kurz je plný!');</script>";
                return false;
            }
        }
        
        public function getStavy() {
            $dotaz = $this->databaza->prepare("SELECT * FROM formdata_stav");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getTypyKurzov() {
            $dotaz = $this->databaza->prepare("SELECT * FROM typy_kurzov WHERE aktualnost = 1");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }
        
        public function getKurzy() {
            $dotaz = $this->databaza->prepare("SELECT k.*, tk.typ_kurzu FROM kurzy k LEFT OUTER JOIN typy_kurzov tk ON k.typ_kurzu_id = tk.id_typy_kurzov WHERE koniec_datum IS NULL OR koniec_datum >= CURDATE()");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function index() {
            $dotaz = $this->databaza->prepare(
                "SELECT f.*, fs.stav, tk.typ_kurzu, k.kurz
                FROM formdata f 
                LEFT OUTER JOIN formdata_stav fs ON f.stav_id = fs.id_stav
                LEFT OUTER JOIN typy_kurzov tk ON f.typ_kurzu_id = tk.id_typy_kurzov
                LEFT OUTER JOIN kurzy k ON f.kurz_id = k.id_kurzy"
            );
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }

        public function odstranitUdaje($id) {
            $dotaz = $this->databaza->prepare("DELETE FROM formdata WHERE id_formdata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            return $dotaz->execute();
        }
 
        public function pridatUdaje($meno, $priezvisko, $vek, $telcislo, $email, $typ_kurzu_id) {
            if (!$this->kontrolaDuplicityKontaktu($telcislo, $email, false)) { return false; }

            $dotaz = $this->databaza->prepare("INSERT INTO formdata (meno, priezvisko, vek, telcislo, email, stav_id, typ_kurzu_id) values(:meno, :priezvisko, :vek, :telcislo, :email, :stav_id, :typ_kurzu_id)");
            
            $dotaz->bindParam(":meno", $meno, PDO::PARAM_STR);
            $dotaz->bindParam(":priezvisko", $priezvisko, PDO::PARAM_STR);
            $dotaz->bindParam(":vek", $vek, PDO::PARAM_INT);
            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            $dotaz->bindValue(":stav_id", 1, PDO::PARAM_INT);
            $dotaz->bindParam(":typ_kurzu_id", $typ_kurzu_id, PDO::PARAM_INT);
            
            return $dotaz->execute();
        }

        public function zobrazitUdaj($id) {
            $dotaz = $this->databaza->prepare("SELECT * FROM formdata WHERE id_formdata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->execute();
            return $dotaz->fetch(PDO::FETCH_ASSOC);
        }
    
        public function zmenitUdaje($id, $meno, $priezvisko, $vek, $telcislo, $email, $stav_id, $typ_kurzu_id, $kurz_id) {
            if (!$this->kontrolaDuplicityKontaktu($telcislo, $email, true, $id) || (!$this->kontrolaKapacity($kurz_id))) { return false; }

            $dotaz = $this->databaza->prepare("UPDATE formdata SET meno = :meno, priezvisko = :priezvisko, vek = :vek, telcislo = :telcislo, email = :email, stav_id = :stav_id, typ_kurzu_id = :typ_kurzu_id, kurz_id = :kurz_id WHERE id_formdata = :id");
    
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->bindParam(":meno", $meno, PDO::PARAM_STR);
            $dotaz->bindParam(":priezvisko", $priezvisko, PDO::PARAM_STR);
            $dotaz->bindParam(":vek", $vek, PDO::PARAM_INT);
            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            $dotaz->bindParam(":stav_id", $stav_id, is_null($stav_id) ? PDO::PARAM_NULL : PDO::PARAM_INT);
            $dotaz->bindParam(":typ_kurzu_id", $typ_kurzu_id, PDO::PARAM_INT);
            $dotaz->bindParam(":kurz_id", $kurz_id, is_null($kurz_id) ? PDO::PARAM_NULL : PDO::PARAM_INT);
            
            return $dotaz->execute();
        }
    }
?>