<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:../index.php');
?>
<html>
    <head>
        <title>Création d'utilisateur</title>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="../../img/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../edit.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body id="bootstrap-overrides">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h5 class="modal-title">Création de l'utilisateur</h5>
                <form action="create-save.php" method="post" class="form-edit">
                    <label for='username'>Nom d'utilisateur</label>
                    <input type="input" id="username" name="username" class="form-control" value=""required/>
                    <br />
                    <label for='permissions'>Permissions :</label>
                    <select name="permissions">
                        <option value="default" selected>-- Choisir une permission --</option>
                        <option value="*">Administrateur : *</option>
                        <option value="**">SuperAdministrateur : **</option>
                    </select><br/><br/>
                    <button type="submit" class="btn btn-success">Créer</button>
                </form>
                <div class="text-center">
                    <div class="btn-close-edit">
                        <a href="../user.php">Annuler</a>
                    </div>
                </div>
            <div>
        </div>
    </body>
</html>