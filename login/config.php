<?php
print("1");
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=n-d-l-p-fcpro;charset=utf8', '266745_admin', 'Admin12345@');
        print("2");
    } catch (Exception $e) {
        print("3");
        die('Erreur'.$e->getMessage());
    }

?>