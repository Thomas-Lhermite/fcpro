<?php   
session_start();
require_once 'config.php2';

if(!isset($_SESSION['user']))
{
    header('Location:index.php');
    die();
}


if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_retype'])){

    $current_password = htmlspecialchars($_POST['current_password']);
    $current_password_hash = hash('sha256', $current_password);
    $new_password = htmlspecialchars($_POST['new_password']);
    $new_password_retype = htmlspecialchars($_POST['new_password_retype']);

    $check_password  = $bdd->prepare('SELECT password FROM users WHERE username = :user');
    $check_password->execute(array(
        "user" => $_SESSION['user']
    ));
    $data_password = $check_password->fetch();

    if($current_password_hash === $data_password['password'])
    {
        if($new_password === $new_password_retype){

            $new_password_hash = hash('sha256', $new_password);
            $update = $bdd->prepare('UPDATE users SET password = :password WHERE username = :user');
            $update->execute(array(
                "password" => $new_password_hash,
                "user" => $_SESSION['user']
            ));
            header('Location:landing.php?pwd=success');
            die();
        } else {
            header('Location:landing.php?pwd=retype');
            die();
        }
    }
    else{
        header('Location:landing.php?pwd=current');
        die();
    }

}
else{
    header('Location:landing.php');
    die();
}

?>