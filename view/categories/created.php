<?php
$nom_categorie = htmlspecialchars($categorie->getNom_categorie());
echo "<p> La categorie " . $nom_categorie . " a bien été ajoutée. </p>";
ControllerCategories::readAll(); // On affiche la vue readAll
?><?php
