<?php
    session_start();
    if(!isset($_SESSION['user']))
        header('Location:index.php');
?>

<!DOCTYPE html>
<html lang="Fr-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <link rel="stylesheet" href="../css/landing.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Espace Administration</title>
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
                    <h3 class="title-stat">Informations :&nbsp;&nbsp;</h3>
                    <div class="msg-info-box">
                    </div>
                    <div class="data">
                        <?php
                            require_once 'config.php';

                            $sql = $bdd->prepare('SELECT * FROM users');
                            $sql->execute();

                            $countuser = $sql->rowCount();

                            if ($countuser != 0) {
                                echo 'Vous avez actuellement <strong>'.$countuser.'</strong> utilisateurs enregistrés.<br/><br/>';
                            } else {
                                echo "Il n'y a pas d'utilisateur enregistré pour le moment.<br/><br/>";
                            }
                        ?>
                        <?php
                            require_once 'config.php';

                            $sql = $bdd->prepare('SELECT * FROM upload');
                            $sql->execute();

                            $countfiles = $sql->rowCount();
                            
                            if ($countfiles != 0){
                                echo 'Vous avez actuellement <strong>'.$countfiles.'</strong> fichiers enregistrés.<br/><br/>';
                            } else {
                                echo "Il n'y a pas de fichier enregistré pour le moment.<br/><br/>";
                            }   
                        ?>
                        <?php
                            require_once 'config.php';

                            $sql = $bdd->prepare('SELECT * FROM formations');
                            $sql->execute();

                            $countformations = $sql->rowCount();
                            
                            if ($countformations != 0){
                                echo 'Vous avez actuellement <strong>'.$countformations.'</strong> formations enregistrés.<br/><br/>';
                            } else {
                                echo "Il n'y a pas de formations enregistré pour le moment.<br/><br/>";
                            }   
                        ?>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <p>Copyright 2022 &copy; Fc-Pro | Tout droit réservés.</p>
        </footer>
    </div>
    </body>
</html>