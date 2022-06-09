<form method="post"

<?php
    $controller = static::$object;
?>
        action='index.php?action=created&controller=<?php echo"$controller";?>'
    <fieldset>
    <legend>MON FORMULAIRE A MOI :</legend>
    <p>
                <label for="id_categorie_id">Identifiant</label> :
                <input type="text" placeholder="1" name="id_categorie" id="id_categorie_id" required/>

                <label for="nom_categorie_id">Nom</label> :
                <input type="text" placeholder="Categorie..." name="nom_categorie" id="nom_categorie_id" required/>

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

