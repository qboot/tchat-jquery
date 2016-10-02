<?php

session_start();

$pseudo = $_POST['pseudo'];
$pass = $_POST['pass'];

// CONNEXION BDD
try
{
    $bdd = new \PDO('mysql:host=XXX;dbname=XXX;charset=utf8','XXX','XXX');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare('SELECT * FROM tchatuser WHERE pseudo = ?');
$req->execute(array($pseudo));
$result = $req->fetch();

if(!empty($result)) {
    if($result['password'] == sha1($pass)) {

        $req = $bdd->prepare('UPDATE tchatuser SET connecte = :connecte, lastAction = :lastAction WHERE pseudo = :pseudo');
        $req->execute(array(
            'connecte' => true,
            'lastAction' => (new \Datetime())->format('Y-m-d H:i:s'),
            'pseudo' => $pseudo
        ));

        $_SESSION['user'] = array(
            'id' => $result['id'],
            'pseudo' => $pseudo,
            'password' => sha1($pass),
            'profilePicture' => $result['profilePicture'],
            'theme' => $result['theme']
        );

        echo "Success";
        return;
    } else {
        echo "Mot passe est incorrect";
        return;
    }
} else {
    echo "Login n'existe pas";
    return;
}