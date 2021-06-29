<?php
require_once('./includes/class/User.php');
require_once('./includes/class/Role.php');
require_once('./includes/class/Main.php');
require_once('./includes/class/Article.php');
require_once('./includes/class/Commentaire.php');
require_once('./includes/class/Categorie.php');
require_once('./includes/class/Menu.php');

session_start();
$_SESSION['alert'] = '';
if(isset($_GET['logout']))
{
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8"/>
    <link href="./includes/css/card_style.css" rel="stylesheet">
    <link href="./includes/css/article_style.css" rel="stylesheet">
    <link href="./includes/css/style.css" rel="stylesheet" id="css">
    <link href="./includes/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="./includes/js/bootstrap.min.js"></script>
    <script src="./includes/js/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <title>Yalu Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="common-css/bootstrap.css" rel="stylesheet">

    <link href="common-css/ionicons.css" rel="stylesheet">
</head>


<nav class="navbar navbar-expand-lg navbar-light " id="navbar">

    <img src="https://www.pngarea.com/pngm/334/2609989_younglife-logo-png-yl-symbol-blue-transparent-png.png" alt="">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link active" style="font-size: large" href="index.php">Accueil</a>

            <?php
            if (isset($_SESSION['user_id']) && Role::getUserRole($_SESSION['user_id']) != 'Éditeur')
                echo '<a class="nav-item nav-link active" style="font-size: large" href="create_article.php">Ajouter article</a>';
            foreach (Menu::getMenuItems(4) as $menuItem) {
                if ($menuItem['parent'] == 1)
                {
                    echo '
                           <div class="dropdown" style="width: 10%">
                                <a class="nav-item nav-link dropdown-toggle" href="" style="font-size: large" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    '.utf8_encode($menuItem['nom']).'
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                    foreach (Menu::getMenuSubItems($menuItem['id']) as $subItem)
                    {
                        echo '<a class="dropdown-item" href="'.$subItem['lien'].'">'.utf8_encode($subItem['nom']).'</a>';
                    }
                    echo '</div></div>';
                }
                elseif($menuItem['parent_id'] == null)
                {
                    echo '<a class="nav-item nav-link" style="font-size: large" href="'.$menuItem['lien'].'">'.utf8_encode($menuItem['nom']).'</a>';
                }

            }
            ?>
        </div>
        </div
    </div>
    <div class="dropdown" style="float:right;">
        <div>
            <img style="width: 40px;margin-right: 0;" src="./includes/images/person.svg">
            <b><?php if (isset($_SESSION['user_id']))echo $_SESSION['user_pseudo']; else echo 'Visiteur';?></b>
        </div>
        <div class="dropdown-content">
            <?php
            if (isset($_SESSION['user_id']))
            {
                echo '<a href="./my_account.php" class="btn">Mon compte</a>';
                if (Role::getUserRole($_SESSION['user_id']) == 'Administrateur')
                {
                    echo '<a href="./admin/index.php" class="btn">Administration</a>';
                }
                echo '<a href="?logout" class="btn">Se déconnecter</a>';
            }
            else{

                echo '<a href="./login.php" class="btn">Se connecter</a>';
            }
            ?>
        </div>
    </div>


</nav>
<body>









