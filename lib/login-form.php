<?php

session_start();

?>

<div id="loginInner">
    <div id="loginWrap">
        <div class="maintitle">Se connecter</div>

        <form action="lib/login.php" method="post">

            <label>Pseudo</label>
            <input type="text" name="login-pseudo" id="login-pseudo" required />
            <label>Mot de passe</label>
            <input type="password" name="login-pass" id="login-pass" required />
            <input type="submit" name="login-button" id="login-button" />
        </form>
        <div class="flash"></div>
        <p><a id="register-link" href="#">Créer mon compte</a></p>
    </div>
</div>