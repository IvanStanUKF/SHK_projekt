<?php
    require("inc/funkcie.php");
?>

<!DOCTYPE html>
<html lang="sk">
	<head>
		<title>Slovenské historické kurzy</title>
		<meta name="description" content="Slovenské historické kurzy poskytujú prehľad o kľúčových obdobiach slovenských dejín, historických udalostiach, významných osobnostiach, politických zmenách a sociálnych vývojových procesoch, ktoré formovali dnešné Slovensko.">
		<meta name="author" content="SHK">
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/animate.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/owl.theme.css">
		<link rel="stylesheet" href="css/owl.carousel.css">

		<link rel="stylesheet" href="css/style.css">

		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600' rel='stylesheet' type='text/css'>
	</head>

	<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

		<!-- =========================
			Načítavací indikátor
		============================== -->
		<div class="preloader">
			<div class="sk-rotating-plane"></div>
		</div>


		<!-- =========================
			Navigácia (header)
		============================== -->
		<div class="navbar navbar-fixed-top custom-navbar" role="navigation">
			<div class="container">

				<!-- Navigačný header -->
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand">SHK</a>
				</div>

				<div class="collapse navbar-collapse">

					<ul class="nav navbar-nav navbar-right">
						<?php
							$odkazy_navigacia = array("Intro"=>"#intro", "O kurze"=>"#overview", "Ciele kurzu"=>"#detail", "Registrácia"=>"#register", "Časté otázky"=>"#faq");
							echo(pridat_navigaciu($odkazy_navigacia));
						?>
					</ul>

				</div>

			</div>
		</div>