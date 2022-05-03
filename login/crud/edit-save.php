<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:index.php');
    require_once '../config.php';

    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $permissions = $_POST['permissions'];
        $id = $_POST['id'];

        $sql = $bdd->prepare('SELECT * FROM users WHERE username = ?');
        $sql->execute([$username]);
        $data = $sql->fetch();

        if(!$data) {
            $check = $bdd->prepare('UPDATE users SET username = :username, permissions = :permissions WHERE id = :id');
            $check->execute([
                ':username' => $username,
                ':permissions' => $permissions,
                ':id' => $id
            ]);
            header('Location: ../user.php?edit=success');
            die();
        } else {
            header('Location: ../user.php?edit=error');
        }
    } else {
        header('Location: ../user.php'); die();
    }


?>