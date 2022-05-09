<?php

function requete_findUser($pseudo) {
    $db = connexion_BD();
    $sql = "SELECT * FROM users WHERE pseudo_user = :pseudo";
    $req = $db->prepare($sql);
    $req->execute([
        ":pseudo"=>$pseudo
    ]);
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function requete_findUserId($id) {
    $db = connexion_BD();
    $sql = "SELECT * FROM users WHERE id_user = :id";
    $req = $db->prepare($sql);
    $req->execute([
        ":id"=>$id
    ]);
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data;
}

function requete_findArticle($titre) {
    $db = connexion_BD();
    $sql = "SELECT * FROM articles WHERE titre_article = :titre";
    $req = $db->prepare($sql);
    $req->execute([
        ":titre"=>$titre
    ]);
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data;
}


function requete_lire_all_user()
{
    $db = connexion_BD();
    $sql = "SELECT * FROM users";
    $req = $db->prepare($sql);
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function requete_lire_all_article()
{
    $db = connexion_BD();
    $sql = "SELECT * FROM articles";
    $req = $db->prepare($sql);
    $req->execute();
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

function requete_inscription($pseudo,$mail,$password) {
    $db = connexion_BD();
    $sql = "INSERT INTO users (pseudo_user, mail_user, password_user, id_role) VALUES (:pseudo, :mail, :password, :role)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":pseudo" => $pseudo,
        ":mail" => $mail,
        ":password" => $password,
        ":role" => 2
    ]);
    return $result;
}

function requete_ajout_article($titre,$contenu,$image, $date, $user) {
    $db = connexion_BD();
    $sql = "INSERT INTO articles (titre_article, contenu_article, image_article, date_article, id_user) VALUES (:titre, :contenu, :image, :date, :user)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":titre" => $titre,
        ":contenu" => $contenu,
        ":image" => $image,
        ":date" => $date,
        ":user" => $user
    ]);
    return $result;
}

function requete_archiver_article($titre,$contenu,$image, $date, $user){
    $db = connexion_BD();
    $sql = "INSERT INTO ancien_articles (titre_ancien, contenu_ancien, image_ancien, date_ancien, id_user) VALUES (:titre, :contenu, :image, :date, :user)";
    $req = $db->prepare($sql);
    $result = $req->execute([
        ":titre" => $titre,
        ":contenu" => $contenu,
        ":image" => $image,
        ":date" => $date,
        ":user" => $user
    ]);
    return $result;
}

function requete_supprimer_article($titre){
    $db = connexion_BD();
    $sql = "DELETE FROM articles WHERE titre_article = :titre";
    $req = $db->prepare($sql);
    $result = $req->execute([
        "titre"=>$titre]);
}