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
    <link rel="stylesheet" href="../css/file.css">
    <link rel="icon" type="image/png" href="../img/favicon.png" />
    <title>Espace membre</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
                    <h3 class="title-stat">Fichiers :&nbsp;&nbsp;</h3>
                    <div class="msg-info-box">
                        <?php
                            if(isset($_GET['file'])) {
                                $file = htmlspecialchars($_GET['file']);
                                switch($file) {
                                    case 'success':
                                        echo '<div class="alert-success">Le fichier à bien été envoyer.<button class="close" data-dismiss="modal" aria-label="Close"><a href="file.php">&times;</a></button></div>';
                                    break;
                                    case 'error':
                                        echo "<div class='alert-danger'>Erreur dans l'envoie du Fichier.<button class='close' data-dismiss='modal' aria-label='Close'><a href='file.php'>&times;</a></button></div>";
                                    break;
                                }
                            } else if (isset($_GET['delfile'])) {
                                $delfile = htmlspecialchars($_GET['delfile']);
                                switch($delfile) {
                                    case 'success':
                                        echo "<div class='alert-success'>Le Fichier à bien été supprimé.<button class='close' data-dismiss='modal' aria-label='Close'><a href='file.php'>&times;</a></button></div>";
                                    break;
                                    case 'error':
                                        echo "<div class='alert-danger'>Erreur : Le Fichier n'a pas été supprimé.<button class='close' data-dismiss='modal' aria-label='Close'><a href='file.php'>&times;</a></button></div>";
                                    break;
                                    case 'null':
                                        echo "<div class='alert-danger'>Erreur : Spécifié n'est pas existant. <button class='close' data-dismiss='modal' aria-label='Close'><a href='file.php'>&times;</a></button></div>";
                                    break;
                                }
                            }
                        ?>
                    </div>
                    <div class="form-file">
                        <?php 
                            require_once 'config.php';
                            if(isset($_POST['submit'])!=""){
                                $name=$_FILES['photo']['name'];
                                $size=$_FILES['photo']['size'];
                                $type=$_FILES['photo']['type'];
                                $temp=$_FILES['photo']['tmp_name'];
                                $date = date('Y-m-d H:i:s');
                                
                                function GetRelativePath($path)
                                {
                                    $npath = str_replace('\\', '/', $path);
                                    return $npath;
                                }

                                $path = GetRelativePath(dirname(__FILE__));

                                move_uploaded_file($temp, $path."/filemgr/upload/".$name);
                            
                                $sql=$bdd->prepare("INSERT INTO upload (name,date) VALUES ('$name','$date')");
                                $sql->execute();
                                if($sql){
                                    header("location:file.php?file=success"); die();
                                } else{
                                    header("location:file.php?file=error"); die();
                                }
                            }
                        ?>
                        <div class="file-form-top">
                            <div class="insert-file">
                                <form id="form" action="" method="post" enctype="multipart/form-data">
                                    <input type="file" name="photo" id="photo" accept=".pdf" required="required" />
                                    <input id="submit" type="submit" name="submit" value="Envoyer" />
                                    <span id="sizelimit"></span>
                                </form>
                            </div>
                        </div>
                        <script>
                            let submit = document.getElementById('submit');
                            let input = document.getElementById('photo');
                            let span = document.getElementById('sizelimit');

                            input.addEventListener('change', () => {
                                let files = input.files;
                                if(files.length > 0) {
                                    if(files[0].size > 10 * 1024 * 1024) {
                                        span.innerText = 'Le fichier dépassé la taille limite (10MB)'
                                        submit.type = "hidden";
                                        return;
                                    }
                                }
                                span.innerText = '';
                                submit.type = "submit";
                            });
                        </script>
                    </div>
                    <div class="table-file">
                    <form method="post" action="delete.php" >
                        <table cellpadding="0" cellspacing="0" class="table">    
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom du Fichier</th>
                                    <th>Date</th>
                                    <th>Télécharger</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql=$bdd->prepare("SELECT * from upload");
                                    $sql->execute();
                                    while($row=$sql->fetch()){
                                    $id=$row['id'];
                                    $name=$row['name'];
                                    $date=$row['date'];
                                ?>
                                <tr>	
                                    <td data-label="Identifiant"><?php echo $row['id'] ?></td>
                                    <td data-label="Nom"><?php echo $row['name'] ?></td>
                                    <td data-label="Date"><?php echo $row['date'] ?></td>
                                    <td data-label="Télécharger"><a href="filemgr/download.php?filename=<?php echo $name;?>" title="cliquer pour télécharger"><img class="img-btn-file" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAAyElEQVRoge2ZwQ6CQAwFZ/1pEiARDxr/ut7VoOy+pjG+uRKWmRNpF4z5b5r8xCVi9/m1Sb95Uh5WgQOqcUA1DqjGAdU4oBoHVOOAahxQzfHpaI6Jxj3BBYKNW7sceaVvvMuI6JCHkZlYGdEpD6NDvSJiQB4UW4mRiEF5UK1VeiIE8qDcCx2JEMmDerH1TYRQHjI2c3sRYnnICID3EQnyucwxsUSwRDDHuVqnjzU21tiqNYwxJo/XH9mnO65qnu7Yfn4mdoAxppYHtANFBXgGtnIAAAAASUVORK5CYII="/></a></td>
                                    <td data-label="Supprimer"><a onclick="getdelconfirm();" title="cliquer pour supprimer"><img class="img-btn-file" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAABc0lEQVRoge2YsVLCQBRF70uwdSxJp2OoLTLR1kLlD/wLtJUKW0vxLxh+AKMz1kb9AGHGVEKjM9AGeFZYUGQ3YWER36nvvL1nJpvsBhCE/w2ZHNY9PLsm5kZWhoGbShxdmVrTmIBO+RkmJZQC3fDknODcAlw2saA+NGBGrfJy385KOcoxVsoDAJeJuKlKKQXWHaUAE18A6K+gyzx9Yq5ZWFcQ/hTaH7JeeMrLLDKPH0da3Tb/NbruiACAlovUc5F6RMg8txTMZ7LwJnaRenvx0wAAkqDqjZ3pZ9Yc3fzKNvGsDADsvnaUR468eRWyB2wjArYRAduIgG1EwDYiYBsRsI0I2EYEPsLj31/vSVD1TOdVlBYdMMVWMwmqlwCQOnynusjmzavIc6kfAthecD1dhn4c7egE8zxCDwXL5IYIkW5WW4BoWgfwVahRDhj45rFT181rC+w/P75PSpMDAC0AoyLlFIyI0KaJc+S/dXpLmC8IG8kP0Dt4FnT5Wm8AAAAASUVORK5CYII="/></a></td>
                                    <script>
                                        function getdelconfirm() {
                                            var delconf = confirm("Etes vous sur de vouloir supprimer le document ?");
                                            if( delconf == true ){
                                                location.href = "filemgr/delete.php?del=<?php echo $row['id']?>";
                                                return true;
                                            }
                                            else{
                                                location.href = "file.php?delfile=error";
                                                return false;
                                            }
                                        }
                                    </script>
                                </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                            </div>
                        </form>
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