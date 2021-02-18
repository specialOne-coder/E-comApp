<?php

try {
    $bd = new PDO("mysql:host=localhost;dbname=enginnova;charset=utf8","root","ferdio");
    $bd->setAttribute(PDO::ATTR_CASE , PDO::CASE_LOWER);
    $bd->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
} catch (EXCEPTION $th) {
    echo'Erreur'.$th;
}



?>