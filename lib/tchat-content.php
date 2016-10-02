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

$limit = $_POST['limit'];

$response = $bdd->query(' SELECT * FROM tchatmessage
                          INNER JOIN tchatuser ON tchatmessage.idUser = tchatuser.id
                          ORDER BY tchatmessage.date DESC LIMIT ' . $limit);
$messages = $response->fetchAll();

$messages = array_reverse($messages);


function setEmoticons($message) {

    $phrase = $message;
    $search = array(
        '&gt;:o',
        '&gt;:(',
        '-_-',
        ':@',
        ':\'(',
        ':(',
        ':E',
        '3:)',
        ':o',
        ':|',
        '8|',
        '8/',
        ':D',
        ':]',
        ':C',
        ':p',
        '&lt;3',
        '8)',
        ':$',
        ':\'D',
        ':*(',
        ':zzz',
        ':)',
        ':G',
    );
    $replace = array(
        '<img src="assets/images/emoticons/angry.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/angry2.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/blase.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/buzz.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/cry.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/cry.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/dents.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/diable.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/etonne.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/etonne2.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/frappe.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/frappe2.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/happy.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/happy2.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/hungry.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/langue.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/love.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/lunettes.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/money.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/reallyhappy.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/seek.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/sleep.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/smile.png" width="30" class="emoticon" />',
        '<img src="assets/images/emoticons/vomi.png" width="30" class="emoticon" />',
    );

    $message = str_replace($search, $replace, $phrase);
    return $message;
}

echo '<div id="tchat-comments">';

foreach($messages as $message) {
    $text = setEmoticons($message['message']);

    $date = Datetime::createFromFormat('Y-m-d H:i:s', $message['date']);
    $date = 'le ' . $date->format('d/m/Y') . ' à ' . $date->format('H') . 'h' . $date->format('i');

    if($message['idUser'] == $_SESSION['user']['id'])
    {
        echo '<div class="comment">';
            echo '<div class="commentRightPerso">';
                echo '<div class="date"><p>'.$date . '</p></div>';
                echo '<div class="innerCommentRight">' .$text. '</div>';
            echo '</div>';
            echo '<div class="commentLeftPerso">';
                echo '<div class="commentPseudo">' . $message['pseudo'] . '</div>';
                echo '<div class="commentPicture" style="background: url(assets/uploads/'. $message['profilePicture'].') no-repeat center center; background-size: cover;"></div>';
            echo '</div>';
        echo '</div>';
    } else {
        if($_SESSION['user']['theme'] == 'blue') {
            echo '<div class="comment comment-blue">';
        } elseif($_SESSION['user']['theme'] == 'orange') {
            echo '<div class="comment comment-orange">';
        } else {
            echo '<div class="comment">';
        }
            echo '<div class="commentLeft">';
                echo '<div class="commentPicture" style="background: url(assets/uploads/'. $message['profilePicture'].') no-repeat center center; background-size: cover;"></div>';
                echo '<div class="commentPseudo">' . $message['pseudo'] . '</div>';
            echo '</div>';
            echo '<div class="commentRight">';
                echo '<div class="date">'.$date . '</div>';
                echo '<div class="innerCommentRight">' .$text. '</div>';
            echo '</div>';
        echo '</div>';
    }
}

echo '</div>';

