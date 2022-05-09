<?php

// fonction qui créée une nouvelle instance de PDO
function connexion_BD()
{
        $db = new PDO("mysql:host=localhost;dbname=mythologie;charset=utf8", "root", "");
        return $db;
}