<?php
    class AdminData {
        private $databaza;

        public function __construct(Databaza $databaza) {
            $this->databaza = $databaza->getSpojenie();
        }

        public function prihlasenie($admin_email, $admin_heslo){
            $dotaz = $this->databaza->prepare("SELECT * FROM admindata WHERE admin_email = :email");
            $dotaz->bindParam(":email", $admin_email, PDO::PARAM_STR);
            $dotaz->execute();
            $uzivatel = $dotaz->fetch();

            if ($uzivatel) {
                if (password_verify($admin_heslo, $uzivatel["admin_heslo"])) {
                    $_SESSION["admin_prihlaseny"] = true;
                    $_SESSION["admin_id"] = $uzivatel["id_admindata"];
                    $_SESSION["admin_email"] = $uzivatel["admin_email"];
                    $_SESSION["admin_rola"] = $uzivatel["admin_rola"];
                    return true;
                }
            }
            return false;
        }
    
        public function index() {
            $dotaz = $this->databaza->prepare("SELECT * FROM admindata");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>