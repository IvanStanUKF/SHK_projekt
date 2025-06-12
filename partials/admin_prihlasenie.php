
		
		
		<!-- =========================
			Prihlásenie (sekcia) 
		============================== -->
		<section id="admin-prihlasenie" class="parallax-section formulare">
			<div class="container">

				<div class="wow fadeInUp" data-wow-delay="0.6s">
					<h2 class="admin-nadpis">Prihlásenie do admin rozhrania</h2>
				</div>

				<div class="row">
					<div class="col-md-3 col-sm-3"></div>

					<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="1s">
						<form action="" method="POST" id="prihlasenie">
							<input name="admin-email" type="email" class="form-control" id="admin-email" placeholder="Administrátorský email" required>
							<input name="admin-heslo" type="password" class="form-control" id="admin-heslo" placeholder="Heslo" required>
							
							<?php if (isset($chybaPrihlasenia) && !empty($chybaPrihlasenia)): ?>
								<div style="color:red;">
									<?php echo $chybaPrihlasenia; ?>
								</div>
							<?php endif; ?>
							
							<input name="csrf_token" type="hidden" value="<?php echo $_SESSION["csrf_token"]; ?>">
							<div class="col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10">
								<input name="aprihlasenie" type="submit" class="form-control" id="aprihlasenie" value="Prihlásenie">
							</div>
						</form>
					</div>

					<div class="col-md-3 col-sm-3"></div>

				</div>
			</div>
		</section>