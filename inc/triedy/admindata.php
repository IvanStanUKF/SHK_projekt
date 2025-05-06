<?php
    class AdminData {
        private $databaza;

        public function __construct(Databaza $databaza) {
            $this->databaza = $databaza->getSpojenie();
        }
    
        public function index() {
            $dotaz = $this->databaza->prepare("SELECT * FROM admindata");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }

        public function odstranitAdminUdaje($id) {
            $dotaz = $this->databaza->prepare("DELETE FROM admindata WHERE id_admindata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            return $dotaz->execute();
        }
 
        public function pridajAdminUdaje($adminmeno, $adminheslo) {
            $dotaz = $this->databaza->prepare("INSERT INTO admindata (admin_meno, admin_heslo) values(:adminmeno, :adminheslo)");
            $dotaz->bindParam(":adminmeno", $adminmeno, PDO::PARAM_STR);
            $dotaz->bindParam(":adminheslo", $adminheslo, PDO::PARAM_STR);
            return $dotaz->execute();
        }
    
        public function zmenAdminUdaje($id, $adminmeno, $adminheslo) {
            $dotaz = $this->databaza->prepare("UPDATE admindata SET admin_meno = :adminmeno, admin_heslo = :adminheslo WHERE id_admindata = :id");
            $dotaz->bindParam(":id", $id, PDO::PARAM_INT);
            $dotaz->bindParam(":adminmeno", $adminmeno, PDO::PARAM_STR);
            $dotaz->bindParam(":adminheslo", $adminheslo, PDO::PARAM_STR);
            return $dotaz->execute();
        }
    }
?>