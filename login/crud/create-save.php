<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:index.php');
    require_once '../config.php';

    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $permissions = $_POST['permissions'];
        
        $password = "123";
        $password_hash = hash('sha256', $password);

        if($permissions != "default") {

            $sql = $bdd->prepare('SELECT * FROM users WHERE username = ?');
            $sql->execute([$username]);
            $data = $sql->fetch();

            if(!$data) {
                $check = $bdd->prepare('INSERT INTO users (username, password, permissions) VALUES (:username,:password,:permissions)');
                $check->execute([
                    ':username' => $username,
                    ':password' => $password_hash,
                    ':permissions' => $permissions
                ]);
                header('Location: ../user.php?create=success'); die();
            } else {
                header('Location: ../user.php?create=error'); die();
            }
        } else {
            header('Location: ../user.php?create=error2'); die();
        }
    } else {
        header('Location: ../user.php'); die();
    }


?>