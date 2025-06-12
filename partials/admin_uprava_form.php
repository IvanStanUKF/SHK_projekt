
		
		
		<!-- =========================
			Úprava dát (sekcia) 
		============================== -->
		<section id="admin-upravovanie" class="parallax-section formulare">
			<div class="container">

				<div class="wow fadeInUp" data-wow-delay="0.6s">
					<h2 class="admin-nadpis">Úprava dát</h2>
				</div>

				<div class="row">
					<div class="col-md-3 col-sm-3"></div>

					<div class="wow fadeInUp col-md-6 col-sm-6" data-wow-delay="1s">
						<form action="" method="POST" id="upravovanie">
							<label for="firstname">Meno</label>
							<input name="nove-meno" type="text" class="form-control" id="firstname" placeholder="Meno" value="<?php echo $staredata["meno"] ?>" required>
							<label for="lastname">Priezvisko</label>
							<input name="nove-priezvisko" type="text" class="form-control" id="lastname" placeholder="Priezvisko" value="<?php echo $staredata["priezvisko"] ?>" required>
							<label for="age">Vek</label>
							<input name="novy-vek" type="number" class="form-control" id="age" placeholder="Vek" value="<?php echo $staredata["vek"] ?>" required>
							<label for="phone">Telefónne číslo</label>
							<input name="nove-telcislo" type="telephone" class="form-control" id="phone" placeholder="Telefónne číslo" value="<?php echo $staredata["telcislo"] ?>" required>
							<label for="email">Email</label>
							<input name="novy-email" type="email" class="form-control" id="email" placeholder="Email" value="<?php echo $staredata["email"] ?>" required>
							<label for="stav">Stav</label>
							<select name="novy-stav" class="form-control" id="stav" required>
								<option value="" disabled selected>Vyberte stav</option>
								<?php
									foreach ($stavy as $stav) {
										$selected = ($staredata['stav_id'] == $stav['id_stav']) ? "selected" : "";
										echo '<option value="'.$stav['id_stav'].'" '.$selected.'>'.$stav['stav'].'</option>';
									}
								?>
							</select>
							<input name="csrf_token" type="hidden" value="<?php echo $_SESSION["csrf_token"]; ?>">
							<div class="col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10">
								<input name="admin-uprava" type="submit" class="form-control" id="admin-uprava" value="Upraviť">
							</div>
						</form>
					</div>

					<div class="col-md-3 col-sm-3"></div>

				</div>
			</div>
		</section>