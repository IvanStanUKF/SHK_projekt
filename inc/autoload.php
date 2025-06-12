<?php
	if (empty($_SESSION["csrf_token"])) {
		$_SESSION["csrf_token"] = bin2hex(random_bytes(32));
	}

	require_once("inc/triedy/Databaza.php");
	require_once("inc/triedy/FormData.php");
	require_once("inc/triedy/AdminData.php");
?>