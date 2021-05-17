<?php
require_once('../includes/class/User.php');
require_once('../includes/class/Role.php');
require_once('../includes/class/Main.php');
require_once('../includes/class/Article.php');
require_once('../includes/class/Commentaire.php');
require_once('../includes/class/Categorie.php');
session_start();

if(isset($_SESSION['user_id'])) // Si appuie du bouton
{
    if (Role::getUserRole($_SESSION['user_id']) != 'Administrateur'){
        header('Location: index.php');
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
                <a style="color: white; font-size: 20px" href="#">
                    Espace Adminitrateur
                </a>
            </li>
            <li>
                <a href="./admin_users.php">Gestion des utilisateurs</a>
            </li>
            <li>
                <a href="#">Gestion des rôles</a>
            </li>
            <li>
                <a href="#">Gestion du menu</a>
            </li>
            <li>
                <a href="#">Gestion des articles</a>
            </li>
            <li>
                <a href="#">Gestion des catégories</a>
            </li>
            <li>
                <a href="#">Gestion des commentaires</a>
            </li>
            <hr>
            <li>
                <a href="#">Revenir dans le site</a>
            </li>
        </ul>
    </div>
    <!-- Sidebar -->
