<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:index.php');
?>

<html>
    <head>
        <title>Changement de mot passe</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="../img/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="edit.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body id="bootstrap-overrides">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h5 class="modal-title">Modification du mot de passe :</h5>
                <form action="change_password.php" method="POST">
                    <label for='current_password'>Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required/>
                    <br />
                    <label for='new_password'>Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required/>
                    <br />
                    <label for='new_password_retype'>Confirmer le nouveau mot de passe</label>
                    <input type="password" id="new_password_retype" name="new_password_retype" class="form-control" required/>
                    <br />
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </form>
                <div class="text-center">
                    <div class="btn-close-edit">
                        <a href="landing.php">Annuler</a>
                    </div>
                </div>
            <div>
        </div>
    </body>
</html>