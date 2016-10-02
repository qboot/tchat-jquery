<?php

session_start();

$color = $_POST['color'];
$id = $_SESSION['user']['id'];

// CONNEXION BDD
try
{
    $bdd = new \PDO('mysql:host=XXX;dbname=XXX;charset=utf8','XXX','XXX');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$req = $bdd->prepare('UPDATE tchatuser SET theme = :color WHERE id = :id');
$req->execute(array(
    'color' => $color,
    'id' => $id
));

$_SESSION['user']['theme'] = $color;