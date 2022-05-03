<?php
    session_start();
    require_once '../config.php';    

    if(isset($_GET['id'])) {
        $id=$_GET['id'];

        $password = "123";
        $password_hash = hash('sha256', $password);

        $check = $bdd->prepare('UPDATE users SET password = :password WHERE id = :id');
        $check->execute([
            ':password' => $password_hash,
            ':id' => $id
        ]);

        header('Location:../user.php?reset=success');
        die();
    } else {
        header('Location:../user.php'); die();
    }
?>