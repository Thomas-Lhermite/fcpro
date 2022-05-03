<?php
    session_start();
    require_once 'config.php';

    if(isset($_POST['username']) && isset($_POST['password']))
    {
        $user = htmlspecialchars($_POST['username']); 
        $password = htmlspecialchars($_POST['password']); 
        
        $check = $bdd->prepare('SELECT id, username, password, permissions FROM users WHERE username = ?');
        $check->execute(array($user));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        

        if($row > 0)
        {
            $password_hash = hash('sha256', $password);
            if($data['password'] === $password_hash)
            {
                $_SESSION['user'] = $data['username'];
                $_SESSION['permissions'] = $data['permissions'];
                $_SESSION['id'] = $data['id'];
                header('Location: ../index.php');
                die();
            }else{ 
                header('Location: index.php?login_err=password'); die(); 
            }
        }else{ 
            header('Location: index.php?login_err=already'); die(); 
        }
    }else{ 
        header('Location: index.php'); die();
    }
?>