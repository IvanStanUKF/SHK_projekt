<?php
    class AdminData {
        private $databaza;

        public function __construct(Databaza $databaza) {
            $this->databaza = $databaza->getSpojenie();
        }

        public function prihlasenie($admin_email, $admin_heslo){
            $dotaz = $this->databaza->prepare("SELECT ad.*, adr.zobrazenie, adr.upravenie FROM admindata ad LEFT OUTER JOIN admindata_role adr ON ad.admin_rola_id = adr.id_role WHERE admin_email = :email");
            $dotaz->bindParam(":email", $admin_email, PDO::PARAM_STR);
            $dotaz->execute();
            $uzivatel = $dotaz->fetch();

            if ($uzivatel) {
                if (password_verify($admin_heslo, $uzivatel["admin_heslo"])) {
                    $_SESSION["admin_prihlaseny"] = true;
                    $_SESSION["admin_id"] = $uzivatel["id_admindata"];
                    $_SESSION["admin_email"] = $uzivatel["admin_email"];
                    $_SESSION["admin_rola"] = $uzivatel["admin_rola_id"];
                    $_SESSION["admin_zobrazenie"] = $uzivatel["zobrazenie"];
                    $_SESSION["admin_upravenie"] = $uzivatel["upravenie"];
                    return true;
                }
            }
            return false;
        }

        public function odhlasenie() {
            session_start();
            $_SESSION = [];
            session_destroy();

            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    "",
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }
        }

        public function index() {
            $dotaz = $this->databaza->prepare("SELECT * FROM admindata");
            $dotaz->execute();
            return $dotaz->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>