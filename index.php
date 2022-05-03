<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="img/favicon.png" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <title>Fc pro</title>
    </head>
    <body id="bootstrap-overrides">
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">Accueil</a>
        <a href="formation.php">Formations</a>
        <?php
            if(isset($_SESSION['user'])) {
                echo "<div class='sidenav-connect'>";
                echo "<a class='login' href='login/landing.php'>Panel d'Administration</a>";
                echo "<a class='login' href='login/deconnexion.php'>Déconnexion</a>";
                echo "<a class='login' style='font-size: 2rem' href=''><i class='fas fa-cogs'></i></a>";
                echo "</div>";
            } else {
                echo "<a class='login' href='login/index.php'>Connexion</a>";
            }
        ?>
    </div>
    <div id="main">
        <header>
            <div class="top-cont">
                <span class="menu" onclick="openNav()"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAAg0lEQVRoge3WwQmDQBSE4RkrSTN7sQ5BsB9BSCGBbUZL8SDCEhCTEHi78H+3fW8P824jAQDwO5ePlFJve5b0CMrzqU3SlHN+nYOu3NpeVP8R0pHxWQ66i4/NeT9klLRGBPnSanuIDgEAAHCDGh+MGl8bajwAAGgBNT4YNb421HgAwF/tiw8eHFFMpCQAAAAASUVORK5CYII="></span>
                <script>
                    function openNav() {
                        document.getElementById("mySidenav").style.width = "15rem";
                    }

                    function closeNav() {
                        document.getElementById("mySidenav").style.width = "0";
                    }
                </script>
            </div>
            <div class="cont-top">
                <div class="top-website">
                    <h1>FC PRO</h1>
                    <button class="btn-showmore" onclick="window.location.href='#more'">En savoir plus</button>
                </div>
            </div>
        </header>
        <main id="more">
            <div class="cont">
                <div class="footer-left">
                    <h1>Qui somme nous ?</h1>
                    <p>
                        FC PRO, service de formation professionnelle continue de l'OGEC Notre Dame de la Providence à Avranches (50), organise des actions de formation destinées essentiellement aux personnels enseignants et non enseignants des établissements d'enseignement catholique
                        sous contrat avec l'Etat.
                    </p>
                    <ul>
                        <li><strong>Les actions de formation de FC PRO.</strong> L'information sur les actions de formation est présente sur des supports numériques différents selon le statut des futurs stagiaires: les professeurs de enseignement catholique
                            ou les personnels OGEC de l'enseignement catholique. Dans tous les cas, Les stagiaires de la formation professionnelle continue sont concernés par un <a href="https://ndlpavranches.fr/wp-content/uploads/2021/11/Reglement-interieur-2021-2022.pdf"
                                target="_blank">Réglement intérieur FC PRO 2021 2022</a> dédié. Nos actions de formation sont développées sur mesure, pour plus d'informations, merci de nous contacter.</li><br/>
                        <li><strong>Les professeurs.</strong> Dès septembre 2021, les enseignants de l'enseignement catholique pourront s'inscrire aux actions de formation de leur choix via https://www.formiris.org, le site de Formiris; le chef d'établissement
                            pourra ensuite valider cette inscription.</li><br/>
                        <li><strong>Les personnels non-enseignants (OGEC).</strong> Les personnels administratifs, d'éducation, de services et techniques de l'enseignement catholique doivent rechercher les actions de formation de FC PRO sur le site d'AKTO
                            réseau OPCALIA (espaceformation.opcalia.com) et demander au chef d'établissement leur inscription ; cela vaudra convention de formation et demande de prise en charge selon les règles de gestion d'AKTO réseau OPCALIA correspondant
                            à l'établissement du personnel OGEC.</li>
                    </ul>
                    <p>
                        CONVENTION DE FORMATION : Lorsque le chef d'établissement de l'enseignement catholique n'a pas utilisé pour l'inscription le site d'AKTO OPCALIA, il doit alors nouer la relation avec FC PRO en utilisant cette <a href="https://ndlpavranches.fr/wp-content/uploads/2021/03/convention-de-formation-MAJ-mars-2021.pdf"
                            target="_blank">Convention de formation</a>.<br/><br/> ACCESSIBILITE : Les formations se déroulent dans des locaux accessibles aux personnes en situation de handicap. Pour plus de renseignements ou pour une adaptation de la formation,
                        merci de nous contacter.
                    </p>
                </div>
                <div class="footer-right">
                    <div class="contact">
                        <h1>Nous Contacter</h1>
                        <ul>
                            <li>9 Rue Chanoine Berenger,</li>
                            <li>50300 Avranches</li>
                            <li>Téléphone: 02 33 58 02 22</li>
                            <li>Télécopie : 09 72 12 47 96</li>
                            <li><a href="mailto:secretariat@ndlaprovidence.org">Contacter nous par email</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">FC PRO &copy; 2022 | Tout droit réservé</div>
        </main>
    </div>
</body>
</html>