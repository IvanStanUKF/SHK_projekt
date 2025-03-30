<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $meno = $_POST["meno"];
        $priezvisko = $_POST["priezvisko"];
        $vek = $_POST["vek"];
        $telcislo = $_POST["telcislo"];
        $email = $_POST["email"];
        $data = $meno . ":" . $priezvisko . ":" . $vek . ":" . $telcislo . ":" . $email . "\n";

        file_put_contents("../formular_data.txt", $data, FILE_APPEND);
        header("Location: ../index.php");
        exit();
    }
?>