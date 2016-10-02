<?php

session_start();

$pseudo = $_POST['pseudo'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if($pass1 != $pass2) {
    echo "Mots de passe ne correspondent pas";
    return;
}

if(strlen($pseudo) < 3) {
    echo "Pseudo doit faire au moins 3 caractères";
    return;
}

if(strlen($pass1) < 6) {
    echo "Mot de passe doit faire au moins 6 caractères";
    return;
}

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
    echo "Pseudo est déjà utilisé";
    return;
}

$req = $bdd->prepare('INSERT INTO tchatuser(pseudo, password, profilePicture, theme, connecte, lastAction) VALUES(:pseudo,:password, :profilePicture, :theme, :connecte, :lastAction)');
$req->execute(array(
    'pseudo' => htmlspecialchars($pseudo),
    'password' => sha1($pass1),
    'profilePicture' => 'default.png',
    'theme' => 'green',
    'connecte' => true,
    'lastAction' => (new \Datetime())->format('Y-m-d H:i:s')
));

$lastID = $bdd->lastInsertId();

$req = $bdd->prepare('SELECT * FROM tchatuser WHERE id = ?');
$req->execute(array($lastID));
$result = $req->fetch();

$_SESSION['user'] = array(
                        'id' => $result['id'],
                        'pseudo' => $result['pseudo'],
                        'password' => $result['password'],
                        'profilePicture' => $result['profilePicture'],
                        'theme' => 'green'
                    );

echo "Success";
return;