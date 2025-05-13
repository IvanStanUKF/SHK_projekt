		<!-- =========================
			Footer (sekcia)
		============================== -->
		<footer>
			<div class="container">
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<p class="wow fadeInUp" data-wow-delay="0.6s">Všetky práva vyhradené &copy; 2025 SHK</p>

						<ul class="social-icon">
							<li><a href="#" class="fa fa-facebook wow fadeInUp" data-wow-delay="1s"></a></li>
							<li><a href="#" class="fa fa-twitter wow fadeInUp" data-wow-delay="1.3s"></a></li>
							<li><a href="#" class="fa fa-dribbble wow fadeInUp" data-wow-delay="1.6s"></a></li>
							<li><a href="#" class="fa fa-behance wow fadeInUp" data-wow-delay="1.9s"></a></li>
							<li><a href="#" class="fa fa-google-plus wow fadeInUp" data-wow-delay="2s"></a></li>
						</ul>

					</div>
					
				</div>
			</div>
		</footer>


		<!-- Back top -->
		<a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>


		<!-- =========================
			Skripty (JavaScript)
		============================== -->
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.parallax.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/smoothscroll.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/custom.js"></script>
		<script src="js/formular.js"></script>

		<?php if (isset($uspesna_registracia) && $uspesna_registracia): ?>
			<script>
				window.onload = function() {
					alert("Registrácia prebehla úspešne, viac informácií vám poskytneme emailom.");
					window.location.href = "index.php";
				};
			</script>
		<?php endif; ?>

	</body>
</html>