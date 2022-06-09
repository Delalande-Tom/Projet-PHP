<form method="post" action="index.php?action=updated&controller=categories"
      <p>
        <label for="nom_categorie">Nom :</label>
          <?php $id_categorie = $_GET['id_categorie'];
                    $categorie = ModelCategories::select($id_categorie);
                    $nom_categorie = $categorie->getNom_categorie();
        echo "<input type='text' placeholder='Nom' name='nom_categorie' id='nom_categorie' value='$nom_categorie' required/>";
          echo "<input type='hidden' name='id_categorie' id='id_categorie' value='$id_categorie'/>";
        ?>
      </p>
    <p>
        <input type="submit" value="Envoyer" />
    </p>
</form>