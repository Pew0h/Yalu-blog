<?php
require_once('../includes/class/User.php');
require_once('../includes/class/Role.php');
require_once('../includes/class/Main.php');
require_once('../includes/class/Article.php');
require_once('../includes/class/Commentaire.php');
require_once('../includes/class/Categorie.php');
require_once('../includes/class/Menu.php');

session_start();

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        http_response_code(403);
        exit;
    }
}

?>

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="../includes/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="../includes/css/admin.css" rel="stylesheet">
    <script src="../includes/js/bootstrap.min.js"></script>
    <script src="../includes/js/jquery.min.js"></script>
    <title>Yalu Blog - Administrateur</title>
</head>

<body>

<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a style="color: white; font-size: 20px" href="index.php">
                    Espace Adminitrateur
                </a>
            </li>
            <li>
                <a href="./admin_users.php">Utilisateurs</a>
            </li>
            <li>
                <a href="./admin_roles.php">Rôles</a>
            </li>
            <li>
                <a href="./admin_menus.php">Menu</a>
            </li>
            <li>
                <a href="./admin_articles.php">Articles</a>
            </li>
            <li>
                <a href="./admin_categories.php">Catégories</a>
            </li>
            <li>
                <a href="./admin_commentaires.php">Commentaires</a>
            </li>
            <hr>
            <li>
                <a href="../index.php">Revenir dans le site</a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->