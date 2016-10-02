<?php
    session_start();
?>

<div id="tchatInner">
    <div id="tchatWrap">
        <div id="tchatColumns">
		
			<div class="logout mobile logout-link"></div>
		
            <div id="columnLeft">
                <?php

                if($_SESSION['user']['theme'] == 'blue') {
                    echo '<div id="tchatTop" class="tchatTop-blue">';
                } elseif($_SESSION['user']['theme'] == 'orange') {
                    echo '<div id="tchatTop" class="tchatTop-orange">';
                } else {
                    echo '<div id="tchatTop">';
                }

                ?>

                    <div class="smallTitle">Hello <?= $_SESSION['user']['pseudo'] ?></div>
                    <div id="myProfilePicture" style="background: url('assets/uploads/<?= $_SESSION['user']['profilePicture'] ?>') no-repeat center; background-size: cover;"></div>

                    <div id="tchatTopRight">
                        <p><a class="logout-link" id="logout-link" href="#">Se déconnecter ?</a></p>

                        <form action="lib/upload-trait.php" method="post" enctype="multipart/form-data">
                            <p class="change-tof">Changer de photo de profil ?</p>
                            <input type="file" name="upload-picture" id="upload-picture">
                            <input class="modifPicture" type="submit" name="upload-button" id="upload-button" value="Changer ma photo" name="submit">
                        </form>

                        <div><p class="change-color">Changer de thème ?</p>
                            <?php
                            if($_SESSION['user']['theme'] == 'green') {
                                echo '<div class="choice-color choice-active" data="green" style="background:rgb(0,191,129);"></div>';
                                echo '<div class="choice-color" data="blue" style="background:rgb(52, 73, 94);"></div>';
                                echo '<div class="choice-color" data="orange" style="background:rgb(231, 76, 60);"></div>';
                            } elseif($_SESSION['user']['theme'] == 'blue') {
                                echo '<div class="choice-color" data="green" style="background:rgb(0,191,129);"></div>';
                                echo '<div class="choice-color choice-active" data="blue" style="background:rgb(52, 73, 94);"></div>';
                                echo '<div class="choice-color" data="orange" style="background:rgb(231, 76, 60);"></div>';
                            } elseif($_SESSION['user']['theme'] == 'orange') {
                                echo '<div class="choice-color" data="green" style="background:rgb(0,191,129);"></div>';
                                echo '<div class="choice-color" data="blue" style="background:rgb(52, 73, 94);"></div>';
                                echo '<div class="choice-color choice-active" data="orange" style="background:rgb(231, 76, 60);"></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>



                <div id="listFonctionnalites">
                    <div class="smallTitle">Fonctionnalités</div>
                    <ul>
                        <li>Inscription / Connexion / Déconnexion</li>
                        <li>Pseudo unique</li>
                        <li>Upload photo de profil</li>
                        <li>Aspect différent pour ses messages</li>
                        <li>Rechargement automatique de + de messages quand scrollbar est en haut</li>
                        <li>Émoticones</li>
                        <li>Empêcher 2 fois le même message</li>
                        <li>Empêcher envoi message vide</li>
                        <li>Liste des connectés</li>
                        <li>Liste des émoticones</li>
                        <li>Scrollbar intelligente : se positionne en bas ou reste à l'endroit du message lu, redescend quand on envoi un message</li>
                        <li>Différents thèmes disponibles</li>
                        <li>Protection contre injection SQL/HTML/CSS</li>
                        <li>Messages flash</li>
                        <li>Membre hors ligne après 10min d'inactivité ou déconnexion</li>
                    </ul>
                </div>



            </div> <!-- col left -->
            <div id="columnMid">
                <div id="tchatMain">
                        <?php

                        if($_SESSION['user']['theme'] == 'blue') {
                            echo '<div id="bigBloc" class="bigBloc-blue"></div>';
                        } elseif($_SESSION['user']['theme'] == 'orange') {
                            echo '<div id="bigBloc" class="bigBloc-orange"></div>';
                        } else {
                            echo '<div id="bigBloc"></div>';
                        }

                        ?>

                        <?php

                        if($_SESSION['user']['theme'] == 'blue') {
                            echo '<div id="tchatBody" class="tchatBody-blue">';
                        } elseif($_SESSION['user']['theme'] == 'orange') {
                            echo '<div id="tchatBody" class="tchatBody-orange">';
                        } else {
                            echo '<div id="tchatBody">';
                        }

                        ?>


                        <div id="tchat-content"></div>

                        <form action="lib/trait.php" method="post">
                            <input type="text" id="comment-message" name="comment-message" placeholder="Écrire un message..." autofocus required />
                            <input type="submit" id="comment-button" name="comment-button" value="Envoyer" />
                        </form>

                        <div class="flash"></div>
                    </div>
                </div>
            </div>  <!-- col mid -->
            <div id="columnRight">

                <?php

                if($_SESSION['user']['theme'] == 'blue') {
                    echo '<div id="listConnectes" class="listCo-blue"></div>';
                } elseif($_SESSION['user']['theme'] == 'orange') {
                    echo '<div id="listConnectes" class="listCo-orange"></div>';
                } else {
                    echo '<div id="listConnectes"></div>';
                }

                ?>






                <div id="listEmoticons">
                    <div class="smallTitle">Émoticones</div>
                    <ul>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/angry.png" width="30" />
                            <p> <span>>:o</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/angry2.png" width="30" />
                            <p> <span>>:(</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/blase.png" width="30" />
                            <p> <span>-_-</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/buzz.png" width="30" />
                            <p> <span>:@</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/cry.png" width="30" />
                            <p> <span>:'(</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/dents.png" width="30" />
                            <p> <span>:E</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/diable.png" width="30" />
                            <p> <span>3:)</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/etonne.png" width="30" />
                            <p> <span>:o</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/etonne2.png" width="30" />
                            <p> <span>:|</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/frappe.png" width="30" />
                            <p> <span>8|</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/frappe2.png" width="30" />
                            <p> <span>8/</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/happy.png" width="30" />
                            <p> <span>:D</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/happy2.png" width="30" />
                            <p> <span>:]</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/hungry.png" width="30" />
                            <p> <span>:C</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/langue.png" width="30" />
                            <p> <span>:p</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/love.png" width="30" />
                            <p><span><3</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/lunettes.png" width="30" />
                            <p> <span>8)</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/money.png" width="30" />
                            <p> <span>:$</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/reallyhappy.png" width="30" />
                            <p> <span>:'D</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/seek.png" width="30" />
                            <p> <span>:*(</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/sleep.png" width="30" />
                            <p> <span>:zzz</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/smile.png" width="30" />
                            <p> <span>:)</span></p>
                        </li>
                        <li>
                            <img class="emoImg" src="assets/images/emoticons/vomi.png" width="30" />
                            <p> <span>:G</span></p>
                        </li>
                    </ul>
                </div>


            </div>  <!-- col right -->
        </div>
    </div>
</div>