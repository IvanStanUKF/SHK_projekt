
		
		
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
							<label for="nove-meno">Meno</label>
							<input name="nove-meno" type="text" class="form-control" id="nove-meno" placeholder="Meno" value="<?php echo $staredata["meno"] ?>" required>
							<label for="nove-priezvisko">Priezvisko</label>
							<input name="nove-priezvisko" type="text" class="form-control" id="nove-priezvisko" placeholder="Priezvisko" value="<?php echo $staredata["priezvisko"] ?>" required>
							<label for="novy-vek">Vek</label>
							<input name="novy-vek" type="number" class="form-control" id="novy-vek" placeholder="Vek" value="<?php echo $staredata["vek"] ?>" required>
							<label for="nove-telcislo">Telefónne číslo</label>
							<input name="nove-telcislo" type="telephone" class="form-control" id="nove-telcislo" placeholder="Telefónne číslo" value="<?php echo $staredata["telcislo"] ?>" required>
							<label for="novy-email">Email</label>
							<input name="novy-email" type="email" class="form-control" id="novy-email" placeholder="Email" value="<?php echo $staredata["email"] ?>" required>
							<label for="novy-stav">Stav</label>
							<select name="novy-stav" class="form-control" id="novy-stav">
								<option value="" disabled selected>Vyberte stav</option>
								<?php
									foreach ($stavy as $stav) {
										$selected = ($staredata['stav_id'] == $stav['id_stav']) ? "selected" : "";
										echo '<option value="'.$stav['id_stav'].'" '.$selected.'>'.$stav['stav'].'</option>';
									}
								?>
							</select>
							<label for="novy-typ">Typ kurzu</label>
							<select name="novy-typ" class="form-control" id="novy-typ" required>
								<option value="" disabled selected>Vyberte čas kurzu</option>
								<?php
									foreach ($typy_kurzov as $typ) {
										$selected = ($staredata['typ_kurzu_id'] == $typ['id_typy_kurzov']) ? "selected" : "";
										echo '<option value="'.$typ['id_typy_kurzov'].'" '.$selected.'>'.$typ['typ_kurzu'].'</option>';
									}
								?>
							</select>
							<label for="novy-kurz">Kurz</label>
							<select name="novy-kurz" class="form-control" id="novy-kurz">
								<option value="" disabled selected>Vyberte kurz</option>
								<?php
									foreach ($kurzy as $kurz) {
										$selected = ($staredata['kurz_id'] == $kurz['id_kurzy']) ? "selected" : "";
										echo '<option value="'.$kurz['id_kurzy'].'" '.$selected.'>'.$kurz['typ_kurzu'].' -- '.$kurz['kurz'].'</option>';
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