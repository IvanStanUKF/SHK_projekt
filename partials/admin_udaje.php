
		
		<!-- =========================
			Tabuľka databázy (sekcia) 
		============================== -->
		<section id="tabulka-databazy" class="parallax-section formulare">
			<div class="container">

				<div class="wow fadeInUp" data-wow-delay="0.6s">
					<h2 class="admin-nadpis">Údaje o prihlásených do kurzu</h2>
				</div>

				<div class="row">
					<div class="wow col-md-12 col-sm-12 fadeInUp" data-wow-delay="0.6s">
                        <div class="tabulka-wrapper"><table class="tabulka-databazy">
                            <tr>
                                <th>ID</th>
                                <th>Meno</th>
                                <th>Priezvisko</th>
                                <th>Vek</th>
                                <th>Telefónne číslo</th>
                                <th>Email</th>
                                <th>Stav</th>
                                <th>Upraviť dáta</th>
                                <th>Odstrániť dáta</th>
                            </tr>
                            <?php
                                if (isset($_SESSION["admin_prihlaseny"]) && $_SESSION["admin_prihlaseny"]) {
                                    $databaza = new Databaza();
                                    $formdata = new FormData($databaza);
                                    $_SESSION["admin_udaje"] = $formdata->index();

                                    foreach($_SESSION["admin_udaje"] as $riadok) {
                                        echo "<tr>";
                                        echo "<td class=\"td-center\">".$riadok["id_formdata"]."</td>";
                                        echo "<td>".$riadok["meno"]."</td>";
                                        echo "<td>".$riadok["priezvisko"]."</td>";
                                        echo "<td class=\"td-center\">".$riadok["vek"]."</td>";
                                        echo "<td>".$riadok["telcislo"]."</td>";
                                        echo "<td>".$riadok["email"]."</td>";
                                        echo "<td>".$riadok["stav"]."</td>";
                                        echo '<td class="td-center"><a href="admin_uprava.php?id='.$riadok["id_formdata"].'" target="_blank">Upraviť</a></td>';
                                        echo '<td class="td-center"><a href="?delete='.$riadok["id_formdata"].'" onclick="return confirm(\'Určite chcete vymazať tieto údaje?\')">Odstrániť</a></td>';
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </table></div>

                    </div>

				</div>
			</div>
		</section>