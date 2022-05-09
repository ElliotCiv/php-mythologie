<?php
session_start();

if (empty($_SESSION['user'])) {
    header('location: connexion.php');
}

session_destroy();

header('location: connexion.php');
