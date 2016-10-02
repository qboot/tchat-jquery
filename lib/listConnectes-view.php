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

$req = $bdd->query(' SELECT * FROM tchatuser ORDER BY lastAction DESC');
$users = $req->fetchAll();

echo '<div class="smallTitle">Liste des membres</div>';

foreach($users as $user) {

    $lastAction = Datetime::createFromFormat('Y-m-d H:i:s', $user['lastAction']);
    $currentDate = new \Datetime();
    $lastAction->modify('+10 minutes');
    if($currentDate > $lastAction) {
        $req2 = $bdd->prepare('UPDATE tchatuser SET connecte = :connecte WHERE id = :id');
        $req2->execute(array(
            'connecte' => false,
            'id' => $user['id']
        ));
    }

    $last = Datetime::createFromFormat('Y-m-d H:i:s', $user['lastAction']);
    $diff = findDiff($last);

    if($user['connecte'] == true) {
        $connecte = true;
    } else {
        $connecte = false;
    }

    ?>

    <?php if($connecte == true) : ?>
        <div class="membre membreCo">
    <?php else : ?>
        <div class="membre">
    <?php endif ?>
        <div class="profilePictureMembre" style="background: url('assets/uploads/<?= $user['profilePicture'] ?>') no-repeat center center; background-size:cover";></div>

        <?php if($connecte == true) : ?>
            <div class="pseudoMembre"><?= $user['pseudo'] ?> - connecté</div>
            <div class="derniereActivite">il y a <?= $diff ?></div>
        <?php else : ?>
            <div class="pseudoMembre"><?= $user['pseudo'] ?> - hors ligne</div>
            <div class="derniereActivite">il y a <?= $diff ?></div>
        <?php endif ?>
    </div>

<?php

}

function findDiff($last) {

    $now = new \Datetime();

    $interval = $now->diff($last);

    $doPlural = function($nb,$str){return $nb>1?$str.'s':$str;}; // adds plurals

    $format = array();
    if($interval->y !== 0) {
        return $interval->format("%y ".$doPlural($interval->y, "an"));
    }
    if($interval->m >= 2) {
        return $interval->format("%m ".$interval->m, "mois");
    }
    if($interval->days !== 0) {
        return $interval->format("%a ".$doPlural($interval->days, "jour"));
    }
    if($interval->h !== 0) {
        return $interval->format("%h ".$doPlural($interval->h, "heure"));
    }
    if($interval->i !== 0) {
        return $interval->format("%i ".$doPlural($interval->i, "minute"));
    } else {
        return "moins d'une minute";
    }
}