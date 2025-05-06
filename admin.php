<?php 
    session_start();
    require_once("inc/funkcie.php");
	require_once("inc/triedy/databaza.php");
	require_once("inc/triedy/formdata.php");
	require_once("inc/triedy/admindata.php");
    $odkazy_navigacia;

    if (isset($_GET["delete"])) {
        $databaza = new Databaza();
        $formdata = new FormData($databaza);
        $formdata->odstranitUdaje($_GET["delete"]);

        header("Location: admin.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $admin_meno = $_POST["admin-meno"];
        $admin_heslo = $_POST["admin-heslo"];

        prihlasenie($admin_meno, $admin_heslo);
    }

    if (isset($_SESSION["admin_prihlaseny"]) && !empty($_SESSION["admin_prihlaseny"]) && $_SESSION["admin_prihlaseny"]) {
        $odkazy_navigacia = array("Domovská stránka" => "index.php", "Údaje" => "#tabulka-databazy", "Odhlásiť sa" => "inc/odhlasenie.php");
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