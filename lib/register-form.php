<?php

session_start();

?>

<div id="registerInner">
    <div id="registerWrap">
        <div class="maintitle">S'inscrire</div>

        <form action="lib/inscript.php" method="post">
            <label>Pseudo</label>
            <input type="text" name="register-pseudo" id="register-pseudo" required />
            <label>Mot de passe</label>
            <input type="password" name="register-pass1" id="register-pass1" required />
            <label>Répéter mot de passe</label>
            <input type="password" name="register-pass2" id="register-pass2" required />
            <input type="submit" name="register-button" id="register-button" />
        </form>
        <div class="flash"></div>
        <p><a id="login-link" href="#">J'ai déjà un compte. Me connecter</a></p>
    </div>
</div>