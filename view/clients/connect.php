
<form method="post"
<?php
$controller = static::$object;
?>
      action='index.php?action=connected&controller=<?php echo"$controller";?>'
    <fieldset>
        <legend>Connexion :</legend>
            <p>
                <input type="text" value="" name="login" id="login_id" required/>
                <label for="login_id">Login</label>
            </p>
            <p>
                 <input type="password" value="" name="mdp" id="mdp_id" required/>
                 <label for="mdp_id">Mot de passe</label>
            </p>

            <p>
                <input type="submit" value="Envoyer" />
            </p>
    </fieldset>
</form>

<p>
    <small><a href='index.php?action=create&controller=clients'>vous n'avez pas de compte inscrivez vous </a></small>
</p>

