<?php

session_start();

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

$req = $bdd->prepare('UPDATE tchatuser SET connecte = :connecte WHERE id = :id');
$req->execute(array(
    'connecte' => false,
    'id' => $id
));

session_unset();
session_destroy();