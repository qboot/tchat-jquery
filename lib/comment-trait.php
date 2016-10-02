<?php

session_start();

// CONNEXION BDD
try
{
    $bdd = new \PDO('mysql:host=XXX;dbname=XXX;charset=utf8','XXX','XXX');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

// ENVOI DU MESSAGE

$id = $_SESSION['user']['id'];
$message = $_POST['message'];
$date = (new \Datetime())->format('Y-m-d H:i:s');

$req = $bdd->prepare('SELECT * FROM tchatmessage WHERE idUser = ? ORDER BY date DESC LIMIT 1');
$req->execute(array($id));

$result = $req->fetch();

if(!empty($result)) {
    if($result['message'] == htmlspecialchars($message)) {
        echo "Merci d'éviter de flood";
        return;
    }
}

$req = $bdd->prepare('INSERT INTO tchatmessage(idUser, message, date) VALUES(:idUser,:message,:date)');
$req->execute(array(
    'idUser' => $id,
    'message' => htmlspecialchars($message),
    'date' => $date
));

$req = $bdd->prepare('UPDATE tchatuser SET connecte = :connecte, lastAction = :lastAction WHERE id = :id');
$req->execute(array(
    'connecte' => true,
    'lastAction' => (new \Datetime())->format('Y-m-d H:i:s'),
    'id' => $id
));

echo 'Message envoyé';