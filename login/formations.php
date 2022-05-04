<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:index.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <link rel="stylesheet" href="../css/formations.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Espace membre</title>
</head>

<body>   
<div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="../index.php">Retour sur le site</a>
        <button class="down-btn">Gestion du Site <i class="fas fa-angle-down"></i></button>
        <div class="down">
            <a class='login' href="user.php"><i class="fas fa-caret-right"></i> Gestion des utilisateurs</a>
            <a class='login' href="formations.php"><i class="fas fa-caret-right"></i> Gestion des formations</a>
            <a class='login' href="file.php"><i class="fas fa-caret-right"></i> Gestion des fichiers</a>
            <a class='login' href="formateurs.php"><i class="fas fa-caret-right"></i> Gestion des formateurs</a>
        </div>
        <a class='login' href="deconnexion.php">Déconnexion</a>
        <a class='login' style='font-size: 2rem' href=''><i class='fas fa-cogs'></i></a>
    </div>
    <div id="main">
    <header>
            <div class="top-cont">
                <div class="top-title">
                    <h1 class="title">FC PRO</h1>
                </div>
                <div class="info-user">
                    <p>vous êtes connecté en tant que <span class="info-session-user"><?php echo $_SESSION['user']?></span></p>
                </div>
                <span class="menu" onclick="openNav()"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAg0lEQVRoge3WwQmDQBSE4RkrSTN7sQ5BsB9BSCGBbUZL8SDCEhCTEHi78H+3fW8P824jAQDwO5ePlFJve5b0CMrzqU3SlHN+nYOu3NpeVP8R0pHxWQ66i4/NeT9klLRGBPnSanuIDgEAAHCDGh+MGl8bajwAAGgBNT4YNb421HgAwF/tiw8eHFFMpCQAAAAASUVORK5CYII="></span>
                <script>

                    const dropdown = document.querySelectorAll('.down-btn');

                    dropdown.forEach((btn) => {
                    btn.addEventListener('click', (e) => {

                        downText = btn.nextElementSibling;
                        downText.classList.toggle('show');
                        document.getElementById("mySidenav").style.width = "15rem";
                    });
                    });;
                    

                    function openNav() {
                        document.getElementById("mySidenav").style.width = "15rem";
                    }

                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                    }
                </script>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="content">
                    <h3 class="title-stat">Formations :&nbsp;&nbsp;</h3>
                    <div class="msg-info-box">
                        <?php
                            if(isset($_GET['formation'])){
                                $formation = htmlspecialchars($_GET['formation']);
                                switch($formation){
                                    case 'error':
                                        echo "<div class='alert-danger'>Un problème est survenue lors de la création de la formation <button class='close' data-dismiss='modal' aria-label='Close'><a href='formations.php'>&times;</a></button></div>";
                                    break;

                                    case 'success':
                                        echo '<div class="alert-success">La formation a été créer avec succès ! <button class="close" data-dismiss="modal" aria-label="Close"><a href="formations.php">&times;</a></button></div>';
                                    break; 
                                }
                            } else if(isset($_GET['editf'])){
                                $editf = htmlspecialchars($_GET['editf']);
                                switch($editf){
                                    case 'error':
                                        echo "<div class='alert-danger'>La modification n'a pas été prise en compte car une formation de ce nom existe déjà.<button class='close' data-dismiss='modal' aria-label='Close'><a href='formations.php'>&times;</a></button></div>";
                                    break;

                                    case 'success':
                                        echo '<div class="alert-success">La modification a été prise en compte avec succès. <button class="close" data-dismiss="modal" aria-label="Close"><a href="formations.php">&times;</a></button></div>';
                                    break; 
                                }
                            } else if(isset($_GET['deletef'])){
                                $deletef = htmlspecialchars($_GET['deletef']);
                                switch($deletef){
                                    case 'success':
                                        echo '<div class="alert-success">La Suppression a été effectuée. <button class="close" data-dismiss="modal" aria-label="Close"><a href="formations.php">&times;</a></button></div>';
                                    break; 
                                }
                            }
                        ?>
                    </div>
                    <?php
                        require_once 'config.php';

                        $check = $bdd->prepare('SELECT * FROM formations');
                        $check->execute();
                            echo "<table class='table'>";
                            echo "<thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Titre de la formation</th>
                                        <th>Fichier de la Formation</th>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                    </tr>
                                  </thead>";
                            while ($data = $check->fetch()) {
                                echo "<tbody><tr>\n";
                                echo "<td data-label='Identifiant'><strong>".    $data['id']    ."</strong></td>\n";
                                echo "<td data-label='Nom'>".    $data['title']    ."</td>\n";
                                echo "<td data-label='Fichier'>".    $data['file'] ."</td>\n";
                                echo '<td data-label="Modifier"><div class="btn-table-color"><button><a href="formations/editf.php?id=' .$data['id']. '">Modifier</a></button></td>';
                                echo '<td data-label="Supprimer"><div class="btn-table-color"><button><a href="formations/deletef.php?id=' .$data['id']. '">Supprimer</a></button></td>';
                                echo "</tr></tbody>";
                            }
                            echo "</table>";
                            echo '<br/><br/><a href="formations/createf.php" class="form-link-u">Ajouter une formations</a>';   
                    ?>
                </div>
            </div>
        </main>
        <footer>
            <p>Copyright 2022 &copy; Fc-Pro | Tout droit réservés.</p>
        </footer>
    </div> 
</body>
</html>