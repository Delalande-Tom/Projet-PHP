<form method="post"

    <?php
    $controller = static::$object;
    $action = $_GET['action'];
    $val_id_tap = ModelTapis::SelectMaxIdTapis() + 1;
    if ($action === 'create' || $action === 'created'){
        ?>

        action='index.php?action=created&controller=<?php echo"$controller";?>'

        <?php
    } else if ($action === 'update' || $action === 'updated'){
        ?>

        action='index.php?action=updated&controller=<?php echo"$controller";?>'

        <?php
    }
    ?>

>
    <fieldset>
        <legend>MON FORMULAIRE A MOI :</legend>
        <p>
            <?php
            $action = $_GET['action'];
            if ($action === 'create' || $action === 'created'){
                ?>

                <label for="id_tapis_id">Identifiant du tapis :</label>
                <input type="number" value="<?php echo $val_id_tap; ?>" min="<?php echo $val_id_tap; ?>" max="<?php echo $val_id_tap; ?>"
                    name="id_tapis" id="id_tapis_id"/>

                <label for="nom_tapis_id">Nom :</label>
                <input type="text" placeholder="Tapis..." name="nom_tapis" id="nom_tapis_id" required/>

                <label for="largeur_id">Largeur (en cm) :</label>
                <input type="number" min="1" placeholder="35" name="largeur" id="largeur_id" required/>

                <label for="longueur_id">Longueur (en cm) :</label>
                <input type="number" min="1" ="text" placeholder="35" name="longueur" id="longueur_id" required/>

                <label for="prix_id">Prix :</label>
                <input type="number" min="0" placeholder="25" name="prix" id="prix_id" required/>

                <label for="coefficient_solde_id">Pourcentage solde :</label>
                <input type="number" min="0" max="99" placeholder="1" name="coefficient_solde" id="coefficient_solde_id" required/>

                <label for="marque_id">Marque :</label>
                <input type="text" placeholder="Carpets & Co" name="marque" id="marque_id" required/>

                <label for="stock_id">Stock :</label>
                <input type="number" min="0" placeholder="150" name="stock" id="stock_id" required/>
                <?php
                foreach ($categories as $cat){
                    $nom_categorie = $cat->getNom_categorie();
                    if ($nom_categorie == 'Produit'){
                    } else {
                        ?>
                        <br><label for="Non">Non</label>
                        <input type="radio" name="<?php echo"$nom_categorie";?>" id="non_id" value="non" checked/>


                        <label for="Oui">Oui</label>
                        <input type="radio" name="<?php echo"$nom_categorie";?>" id="oui_id" value="oui"/>
                        <?php
                        echo " : $nom_categorie";
                    }
                }

            } else if ($action === 'update' || $action === 'updated'){
                $id_tapis = $tapis->getId_tapis();
                $nom_tapis = $tapis->getNom_tapis();
                $largeur = $tapis->getLargeur();
                $longueur = $tapis->getLongueur();
                $prix = $tapis->getPrix();
                $coefficient_solde = $tapis->getCoefficient_solde();
                $marque = $tapis->getMarque();
                $stock = $tapis->getStock();
                ?>

                <label for="id_tapis_id">Identifiant du tapis :</label>
                <input type="number" value="<?php echo"$id_tapis";?>" min="<?php echo "$val_id_tap"; ?>" max="<?php echo "$val_id_tap";?>" name="id_tapis" id="id_tapis_id" readonly/>

                <label for="nom_tapis_id">Nom :</label>
                <input type="text" value="<?php echo"$nom_tapis";?>" name="nom_tapis" id="nom_tapis_id" required/>

                <label for="largeur_id">Largeur (en cm) :</label>
                <input type="number" min="1" value="<?php echo"$largeur";?>" name="largeur" id="largeur_id" required/>

                <label for="longueur_id">Longueur (en cm) :</label>
                <input type="number" min="1" value="<?php echo"$longueur";?>" name="longueur" id="longueur_id" required/>

                <label for="prix_id">Prix :</label>
                <input type="number" min="0" value="<?php echo"$prix";?>" name="prix" id="prix_id" required/>

                <label for="coefficient_solde_id">Pourcentage solde :</label>
                <input type="number" min="0" max="99" value="<?php echo"$coefficient_solde";?>" name="coefficient_solde" id="coefficient_solde_id" required/>

                <label for="marque_id">Marque :</label>
                <input type="text" value="<?php echo"$marque";?>" name="marque" id="marque_id" required/>

                <label for="stock_id">Stock :</label>
                <input type="number" min="0" value="<?php echo"$stock";?>" name="stock" id="stock_id" required/>

                <?php
                foreach ($categories as $cat){
                    $nom_categorie = $cat->getNom_categorie();
                    $id_categorie = $cat->getId_categorie();
                    if ($nom_categorie == 'Produit'){

                    } else {
                        if($tapis->isTapisInCateogorie($id_categorie)){
                            ?>
                            <br><label for="Non">Non</label>
                            <input type="radio" name="<?php echo"$nom_categorie";?>" id="non_id" value="delete" />


                            <label for="Oui">Oui</label>
                            <input type="radio" name="<?php echo"$nom_categorie";?>" id="oui_id" value="ouiBase" checked/>
                            <?php
                        } else {
                            ?>
                            <br><label for="Non">Non</label>
                            <input type="radio" name="<?php echo"$nom_categorie";?>" id="non_id" value="non" checked/>


                            <label for="Oui">Oui</label>
                            <input type="radio" name="<?php echo"$nom_categorie";?>" id="oui_id" value="oui"/>
                            <?php
                        }
                    }
                    echo " : $nom_categorie";
                }
            }
            ?>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>
