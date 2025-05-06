<?php
    class FormData {
        private $databaza;

        public function __construct(Databaza $databaza) {
            $this->databaza = $databaza->getSpojenie();
        }

        function kontrolaDuplicityKontaktu($telcislo, $email, $uprava, $id = 0){
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
    
        public function index() {
            $dotaz = $this->databaza->prepare("SELECT * FROM formdata");
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

            $dotaz = $this->databaza->prepare("INSERT INTO formdata (meno, priezvisko, vek, telcislo, email) values(:meno, :priezvisko, :vek, :telcislo, :email)");
            
            $dotaz->bindParam(":meno", $meno, PDO::PARAM_STR);
            $dotaz->bindParam(":priezvisko", $priezvisko, PDO::PARAM_STR);
            $dotaz->bindParam(":vek", $vek, PDO::PARAM_INT);
            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $dotaz->execute();
        }

        public function zobrazitUdaj($id) {
            $dotaz = $this->databaza->prepare("SELECT * FROM formdata WHERE id_formdata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->execute();
            return $dotaz->fetch(PDO::FETCH_ASSOC);
        }
    
        public function zmenitUdaje($id, $meno, $priezvisko, $vek, $telcislo, $email) {
            if (!$this->kontrolaDuplicityKontaktu($telcislo, $email, true, $id)) { return false; }

            $dotaz = $this->databaza->prepare("UPDATE formdata SET meno = :meno, priezvisko = :priezvisko, vek = :vek, telcislo = :telcislo, email = :email WHERE id_formdata = :id");
    
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->bindParam(":meno", $meno, PDO::PARAM_STR);
            $dotaz->bindParam(":priezvisko", $priezvisko, PDO::PARAM_STR);
            $dotaz->bindParam(":vek", $vek, PDO::PARAM_INT);
            $dotaz->bindParam(":telcislo", $telcislo, PDO::PARAM_STR);
            $dotaz->bindParam(":email", $email, PDO::PARAM_STR);
            
            return $dotaz->execute();
        }
    }
?>