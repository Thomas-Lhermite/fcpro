<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/formation.css">
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>Formations Fc pro</title>
    </head>
    <body id="bootstrap-overrides">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">Accueil</a>
        <a href="#">Formations</a>
        <?php
            if(isset($_SESSION['user'])) {
                echo "<a class='login' href='login/deconnexion.php'>Déconnexion</a>";
                echo "<a class='login' href='login/landing.php'>Panel d'Administration</a>";
                echo "<a class='login' style='font-size: 2rem' href=''><i class='fas fa-cogs'></i></a>";
            } else {
                echo "<a class='login' href='login/index.php'>Connexion</a>";
            }
        ?>
    </div>
    <div id="main">
        <header>
            <div class="top-cont">
                <div class="top-title">
                    <h1 class="title">FC PRO</h1>
                </div>
                <span class="menu" onclick="openNav()"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAg0lEQVRoge3WwQmDQBSE4RkrSTN7sQ5BsB9BSCGBbUZL8SDCEhCTEHi78H+3fW8P824jAQDwO5ePlFJve5b0CMrzqU3SlHN+nYOu3NpeVP8R0pHxWQ66i4/NeT9klLRGBPnSanuIDgEAAHCDGh+MGl8bajwAAGgBNT4YNb421HgAwF/tiw8eHFFMpCQAAAAASUVORK5CYII="></span>
                <script>
                    function openNav() {
                        document.getElementById("mySidenav").style.width = "15rem";
                        // document.getElementById("main").style.marginLeft = "250px";
                    }

                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                        // document.getElementById("main").style.marginLeft = "0";
                    }
                </script>   
            </div>                        
        </header>
        <main>
            <div class="container">
                <div class="catalogue">
                    <?php
                        require_once 'login/config.php';

                        $sql = $bdd->prepare('SELECT * FROM formations');
                        $sql->execute();

                        while($formation = $sql->fetch()) {
                            echo "<div class='formation' id='".$formation['id']."'>";
                            echo "<h3 class='title-form'><a class='link-form' href='display-form.php?id=".$formation['id']."' >" .$formation['title']."</a><h3>";
                            echo "<p class='content-form'>" .$formation['description']. "</p>" ;
                            echo "<p class='rate-form'><a class='rate-form-link' href='rating/rating.php?id=".$formation['id']."'>Noter la formation</a></p>";
                            echo "</div>";
                        }
                    ?>
                </div>
                <?php
                    require_once 'login/config.php';

                    $countformations = null;
                    global $countformations;

                    $sql = $bdd->prepare('SELECT * FROM formations');
                    $sql->execute();

                    $countformations = $sql->rowCount(); 
                ?>
                <div class="side-catalogue">
                    <div class="box-side-cata">
                        <h3>Informations :</h3>
                        <?php
                        if ($countformations != 0){
                            echo '<p class="stat-form-side">Nous proposons actuellement '.$countformations.' formations.</p>';
                            echo "<p class='stat-form-side'>Parmis celle ci ce trouve :</p>";
                        } else {
                            echo "<p class='stat-form-side'>Aucune formation n'est proposée pour le moment.</p>";
                        }  
                        ?>
                        <ul>
                            <?php
                                require_once 'login/config.php';

                                $sql = $bdd->prepare('SELECT * FROM formations');
                                $sql->execute();

                                while($formation = $sql->fetch()) {
                                    echo"<li><a href='#".$formation['id']."'>".$formation['title']."</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <p>FC PRO &copy; 2022 | Tout droit réservé</p>
        </footer>
    </div>
</body>
</html>