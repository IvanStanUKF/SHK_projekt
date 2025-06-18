<?php
    require_once("inc/autoload.php");
    $databaza = new Databaza();
    $admindata = new AdminData($databaza); 
    $admindata->odhlasenie();
    
    header("Location: admin.php");
    exit;
?>