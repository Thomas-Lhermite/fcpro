<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:../index.php');
        require_once '../config.php';
?>
<html>
    <head>
        <title>Création d'une Formation</title>
        <link rel="icon" type="image/png" href="../../img/favicon.png" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../edit.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body id="bootstrap-overrides">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <h5 class="modal-title">Création de la formation</h5>
                <form action="createf-save.php" method="post" class="form-edit">
                    <label for='formation'>Titre de la formation :</label>

                    <input type="input" id="formation" name="formation" class="form-control" value=""required/>
                    <br />
                    <label for='desc'>Description de la formation :</label>
                    <textarea name="desc" id="desc" class="form-control" cols="40" rows="5" required></textarea>
                    <!-- <input type="input" id="desc" name="desc" class="form-control" value=""required/> -->
                    <br />
                    <label for='content'>Contenut de la formation :</label>
                    <textarea name="content" id="content_editor" class="form-control" cols="40" rows="30" required></textarea>
                    <br />
                    <label for="schedule">Date du Début :</label><br/>
                    <input type="date" name="date_start" class="form-control" value=""required><br/><br/>
                    <label for="schedule">Date de Fin :</label><br/>
                    <input type="date" name="date_end" class="form-control" value=""required><br/><br/>
                    <label for='file'>Choisir un fichier en lien avec la formation :</label><br/>
                    
                    <select name="file" class="form-control">
                        <option value="none" selected>-- Choisir un Fichier --</option>
                        <?php
                        
                        $option = $bdd->prepare('SELECT * FROM upload');
                        $option->execute();
                        while($data = $option->fetch()) {
                            echo"<option value=".$data['name'].">".$data['name']."</option>";
                        }                        
                        ?>
                    </select><br/><br/>
                    <button type="submit" class="btn btn-success">Créer</button>
                </form>
                <div class="text-center">
                    <div class="btn-close-edit">
                        <a href="../formations.php">Annuler</a>
                    </div>
                </div>
            <div>
        </div>
        <script src="../ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace('content_editor');
        </script>
    </body>
</html>