<?php


$action = $_GET['action'];
if ($action == 'delete'){
    echo "<p> La categorie " . htmlspecialchars($id_categorie) . " a bien été supprimée. </p>";
    $tab_categorie = ModelCategories::selectAll();
}

echo "<p> Voici la liste des différentes catégories : </p>";
echo "<ul>";
foreach ($tab_categorie as $categorie) {
    $nom_categorie = $categorie->getNom_categorie();
    $id_categorie = rawurlencode($categorie->getId_categorie());
    echo '<li>';
    echo "<a href='index.php?action=readAllFromCategorie&categorie=$nom_categorie&controller=tapis'>$nom_categorie</a><br>";
    if (Session::is_admin($_SESSION['login'])) {
        echo " <button><a href='index.php?action=delete&id_categorie=$id_categorie&controller=categories'> Supprimer</a></button>";
        echo " <button><a href='index.php?action=update&id_categorie=$id_categorie&controller=categories'> Modifier</a></button>";
        echo '</li>';
        echo '<br>';
        echo '<br>';
    }

}
if (Session::is_admin($_SESSION['login'])) {
    echo '<br>';
    echo "<button><a href='index.php?action=create&controller=categories'>AjouterCategoire</a></button>";
    echo "</ul>";
}