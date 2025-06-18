<?php 
    session_start();
    require_once("inc/autoload.php");
    $odkazy_navigacia;
    $uspesna_zmena = false;

    if (isset($_GET["id"])) {
        $databaza = new Databaza();
        $formdata = new FormData($databaza);
        $id = $_GET["id"];
        $staredata = $formdata->zobrazitUdaj($id);
		$stavy = $formdata->getStavy();
		$typy_kurzov = $formdata->getTypyKurzov();
		$kurzy = $formdata->getKurzy();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
			die("Neplatný CSRF token. Akcia bola zablokovaná.");
		}

		$meno = trim($_POST["nove-meno"] ?? "");
		$priezvisko = trim($_POST["nove-priezvisko"] ?? "");
		$vek = trim($_POST["novy-vek"] ?? "");
		$telcislo = trim($_POST["nove-telcislo"] ?? "");
		$email = trim($_POST["novy-email"] ?? "");
		$stav_id = trim($_POST["novy-stav"] ?? null);
		$typ_kurzu_id = trim($_POST["novy-typ"] ?? "");
		$kurz_id = trim($_POST["novy-kurz"] ?? null);
		if ($stav_id === '' || $stav_id === null) { $stav_id = null; }
		if ($kurz_id === '' || $kurz_id === null) { $kurz_id = null; }

		try {
			$databaza = new Databaza();
			$formdata = new FormData($databaza);

			$stavy = $formdata->getStavy();
			$stavy_pole = array_column($stavy, 'id_stav');
			$typy_kurzov = $formdata->getTypyKurzov();
			$typy_pole = array_column($typy_kurzov, 'id_typy_kurzov');
			$kurzy = $formdata->getKurzy();
			$kurzy_pole = array_column($kurzy, 'id_kurzy');

			$meno = $formdata->mb_ucfirst($meno); 
			$priezvisko = $formdata->mb_ucfirst($priezvisko); 
			$telcislo = str_replace(" ", "", $telcislo);

			if ($formdata->overenieUdajov($meno, $priezvisko, $vek, $telcislo, $email)) {
				if (!in_array($stav_id, $stavy_pole) && $stav_id != null) {
					echo "<script>alert('Neplatný stav!');</script>";
				}
				else if (!in_array($typ_kurzu_id, $typy_pole)) {
					echo "<script>alert('Neplatný typ kurzu!');</script>";
				}
				else if (!in_array($kurz_id, $kurzy_pole) && $kurz_id != null) {
					echo "<script>alert('Neplatný kurz!');</script>";
				}
				else if ($formdata->zmenitUdaje($id, $meno, $priezvisko, $vek, $telcislo, $email, $stav_id, $typ_kurzu_id, $kurz_id)) {
					$uspesna_zmena = true;
					$staredata = $formdata->zobrazitUdaj($id);
				}
				else {
					echo "<script>alert('Nepodarilo sa odoslať formulár!');</script>";
				}
			}
		}
		catch (PDOException $e) {
			$chyba = "Chyba pripojenia k databáze: " . $e->getMessage();
			echo "<script>alert('$chyba');</script>";
		}
	}

    if (isset($_SESSION["admin_prihlaseny"]) && $_SESSION["admin_prihlaseny"] && $_SESSION["admin_upravenie"] == 1) {
        $odkazy_navigacia = array("Domovská stránka" => "index.php", "Úprava dát" => "#admin-uprava", "Admin" => "admin.php");
    } 
    else {
        header("Location: admin.php");
		exit;
    }

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
                require_once("partials/admin_uprava_form.php");
            }
        ?>



<?php if (!empty($uspesna_zmena) && $uspesna_zmena): ?>
	<script>
		window.onload = function() {
			alert("Dáta boli úspešne zmenené!");
			window.location.href = "admin.php";
		};
	</script>
<?php endif; ?>

<?php 
	include("partials/footer.php");
?>