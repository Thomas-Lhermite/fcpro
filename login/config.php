<?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=n-d-l-p-fcpro;charset=utf8', '266745_admin', 'Admin12345@');
    } catch (Exception $e) {
        die('Erreur'.$e->getMessage());
    }

?>