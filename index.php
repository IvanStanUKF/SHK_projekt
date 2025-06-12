<?php 
	session_start();
	
	$odkazy_navigacia = array("Intro"=>"#intro", "O kurze"=>"#overview", "Ciele kurzu"=>"#detail", "Registrácia"=>"#register", "Časté otázky"=>"#faq", "Admin"=>"admin.php");
	include("partials/header.php");

	$uspesna_registracia = false;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!isset($_POST["csrf_token"]) || $_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
			die("Neplatný CSRF token. Akcia bola zablokovaná.");
		}

		$meno = trim($_POST["meno"] ?? "");
		$priezvisko = trim($_POST["priezvisko"] ?? "");
		$vek = trim($_POST["vek"] ?? "");
		$telcislo = trim($_POST["telcislo"] ?? "");
		$email = trim($_POST["email"] ?? "");

		try {
			$databaza = new Databaza();
			$formdata = new FormData($databaza);

			$meno = $formdata->mb_ucfirst($meno); 
			$priezvisko = $formdata->mb_ucfirst($priezvisko); 
			$telcislo = str_replace(" ", "", $telcislo);

			if ($formdata->overenieUdajov($meno, $priezvisko, $vek, $telcislo, $email)) {
				if ($formdata->pridatUdaje($meno, $priezvisko, $vek, $telcislo, $email)) {
					$uspesna_registracia = true;
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
?>


		<!-- =========================
			Intro (sekcia)
		============================== -->
		<section id="intro" class="parallax-section">
			<div class="container">
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<h1 class="wow bounceIn" data-wow-delay="0.9s">Slovenské historické kurzy</h1>
						<a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="1.6s">Zistiť viac</a>
						<a href="#register" class="btn btn-lg btn-danger smoothScroll wow fadeInUp" data-wow-delay="1.6s">Zapísať sa</a>
					</div>


				</div>
			</div>
		</section>


		<!-- =========================
			O kurze (sekcia)
		============================== -->
		<section id="overview" class="parallax-section">
			<div class="container">
				<div class="row">

					<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.6s">
						<h3>O kurze</h3>
						<p>Náš kurz o slovenskej histórii je navrhnutý pre každého, kto sa zaujíma o históriu Slovenska a chce lepšie pochopiť jeho kultúrny a politický vývoj. Kurz pokrýva kľúčové obdobia slovenských dejín, od praveku až po súčasnosť. Získate prehľad o historických udalostiach, významných osobnostiach, politických zmenách a sociálnych vývojových procesoch, ktoré formovali dnešné Slovensko.</p>
					</div>
							
					<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="0.9s">
						<img src="images/overview-img.jpg" class="img-responsive" alt="Overview">
					</div>

				</div>
			</div>
		</section>


		<!-- =========================
			Ciele kurzu (sekcia)
		============================== -->
		<section id="detail" class="parallax-section">
			<div class="container">
				<div class="row">

					<div class="wow fadeInLeft col-12" data-wow-delay="0.3s">
						<h2>Ciele kurzu</h2>
					</div>

				</div>
				
				<div class="row">

					<div class="wow fadeInLeft col-md-4 col-sm-4" data-wow-delay="0.3s">
						<h3>Získať komplexný prehľad o histórii Slovenska.</h3>
					</div>

					<div class="wow fadeInUp col-md-4 col-sm-4" data-wow-delay="0.6s">
						<h3>Pochopiť významné historické udalosti a ich dopad na súčasnosť.</h3>
					</div>

					<div class="wow fadeInRight col-md-4 col-sm-4" data-wow-delay="0.9s">
						<h3>Prehĺbiť poznatky o kultúrnych a politických aspektoch slovenských dejín.</h3>
					</div>

				</div>
			</div>
		</section>


		<!-- =========================
			Registrácia (sekcia) 
		============================== -->
		<section id="register" class="parallax-section formulare">
			<div class="container">
				<div class="row">

					<div class="wow fadeInUp col-md-7 col-sm-7" data-wow-delay="0.6s">
						<h2>Registrácia</h2>
						<h3>Ďakujeme, že máte záujem o náš kurz slovenskej histórie! Vyplnením tohto formulára sa zaregistrujete na kurz, ktorý vás oboznámi s kľúčovými udalosťami, osobnosťami a historickými obdobiami, ktoré formovali dnešné Slovensko.</h3>
					</div>

					<div class="wow fadeInUp col-md-5 col-sm-5" data-wow-delay="1s">
						<form action="" method="POST" id="registracia">
							<input name="meno" type="text" class="form-control" id="firstname" placeholder="Meno" value="<?php echo htmlspecialchars($meno ?? ''); ?>" required>
							<input name="priezvisko" type="text" class="form-control" id="lastname" placeholder="Priezvisko" value="<?php echo htmlspecialchars($priezvisko ?? ''); ?>" required>
							<input name="vek" type="number" class="form-control" id="age" placeholder="Vek" value="<?php echo htmlspecialchars($vek ?? ''); ?>" required>
							<input name="telcislo" type="telephone" class="form-control" id="phone" placeholder="Telefónne číslo" value="<?php echo htmlspecialchars($telcislo ?? ''); ?>" required>
							<input name="email" type="email" class="form-control" id="email" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
							<input name="csrf_token" type="hidden" value="<?php echo $_SESSION["csrf_token"]; ?>">
							<div class="col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10">
								<input name="submit" type="submit" class="form-control" id="submit" value="Registrácia">
							</div>
							<p>Vyplnením formulára súhlasíte so spracovaním dát (GDPR)!</p>
						</form>
					</div>

					<div class="col-md-1"></div>

				</div>
			</div>
		</section>


		<!-- =========================
			Často kladené otázky (sekcia)   
		============================== -->
		<section id="faq" class="parallax-section">
			<div class="container">
				<div class="row">

					<!-- Názov sekcie
					================================================== -->
					<div class="wow bounceIn col-md-offset-2 col-md-8 col-sm-offset-1 col-sm-10 text-center">
						<div class="section-title">
							<h2>Časté otázky</h2>
							<p>Tu sú odpovede na často kladené otázky</p>
						</div>
					</div>

					<div class="wow fadeInUp col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10" data-wow-delay="0.9s">
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingOne">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
											Aké sú predpoklady na absolvovanie kurzu?
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
									<div class="panel-body">
										<p>Na absolvovanie kurzu nie sú požiadavky na predchádzajúce vzdelanie, avšak základná znalosť histórie môže byť výhodou. Kurz je vhodný pre všetkých, ktorí sa chcú dozvedieť viac o histórii Slovenska.</p>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingTwo">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
											Aké technické požiadavky sú potrebné na absolvovanie online kurzu?
										</a>
									</h4>
								</div>
								<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
									<div class="panel-body">
										<p>Na absolvovanie online kurzu potrebujete pripojenie na internet a zariadenie (počítač, tablet, alebo mobil), ktoré podporuje video prehrávač a má prístup k webovým stránkam.</p>
									</div>
								</div>
							</div>

							<div class="panel panel-default">
								<div class="panel-heading" role="tab" id="headingThree">
									<h4 class="panel-title">
										<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
											Je možné získať certifikát po absolvovaní kurzu?
										</a>
									</h4>
								</div>
								<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
									<div class="panel-body">
										<p>Áno, po úspešnom absolvovaní kurzu a splnení všetkých požiadaviek vám vydáme certifikát, ktorý potvrdzuje vašu účasť a získané vedomosti.</p>
									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</section>

<?php 
	include("partials/footer.php");
?>