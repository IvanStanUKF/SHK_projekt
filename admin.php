<?php 
    session_start();
    require_once("inc/autoload.php");
    $odkazy_navigacia;

    if (isset($_GET["delete"]) && $_SESSION["admin_upravenie"] == 1) {
        $databaza = new Databaza();
        $formdata = new FormData($databaza);
        $formdata->odstranitUdaje($_GET["delete"]);

        header("Location: admin.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
            die("Neplatný CSRF token. Akcia bola zablokovaná.");
        }

        $admin_email = $_POST["admin-email"];
        $admin_heslo = $_POST["admin-heslo"];

        try {
            $databaza = new Databaza();
            $admindata = new AdminData($databaza);
            if (!$admindata->prihlasenie($admin_email, $admin_heslo)) {
                $chybaPrihlasenia = "Nesprávny email alebo heslo!";
            }
        }
        catch (PDOException $e) {
            $chyba = "Chyba pripojenia k databáze: " . $e->getMessage();
            echo "<script>alert('$chyba');</script>";
        }
    }

    if (isset($_SESSION["admin_prihlaseny"]) && $_SESSION["admin_prihlaseny"]) {
        $odkazy_navigacia = array("Domovská stránka" => "index.php", "Údaje" => "#tabulka-databazy", "Odhlásiť sa" => "odhlasenie.php");
    } 
    else {
        $odkazy_navigacia = array("Domovská stránka" => "index.php", "Prihlásiť sa" => "#admin-prihlasenie");
    }
    
    //echo isset($_SESSION["admin_prihlaseny"]) ? "Admin je prihlásený :)" : "Admin nie je prihlásený :(";

	require("partials/header.php");
?>


		<!-- =========================
			Intro (sekcia)
		============================== -->
		<section id="intro" class="parallax-section">
			<div class="container">
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<h1 class="wow bounceIn" data-wow-delay="0.9s">Slovenské historické kurzy</h1>
					</div>


				</div>
			</div>
		</section>

        <?php
            if (isset($_SESSION["admin_prihlaseny"]) && $_SESSION["admin_prihlaseny"]) {
                require_once("partials/admin_udaje.php");
            }
            else {
                require_once("partials/admin_prihlasenie.php");
            }
        ?>
		


<?php 
	include("partials/footer.php");
?>