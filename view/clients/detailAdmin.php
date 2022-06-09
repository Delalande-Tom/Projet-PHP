<?php
echo "<pre>";
$login = htmlspecialchars($client->getLogin());
$id_client_echappee = rawurlencode($client->getId_client());
$prenom = htmlspecialchars($client->getPrenom());
$nom = htmlspecialchars($client->getNom());
$mail = htmlspecialchars($client->getMail());
$adresse = htmlspecialchars($client->getAdresse());
$ville = htmlspecialchars($client->getVille());
$code_postal = htmlspecialchars($client->getCodePostal());
$date_de_naissance = htmlspecialchars($client->getDateDeNaissance());

echo "<p>Login : $login</p>";
echo "<p>Prénom : $prenom</p>";
echo "<p>Nom : $nom</p>";
echo "<p>Adresse mail : $mail</p>";
echo "<p>Adresse postale : $adresse</p>";
echo "<p>Ville : $ville</p>";
echo "<p>Code postal : $code_postal</p>";
echo "<p>Date de naissance : $date_de_naissance</p>";
echo "<button><a href='index.php?action=readAllCommandesByClientForAdmin&id_client=$id_client_echappee&controller=commandes'>Voir les commandes de ce client</a></button>";
echo "</pre>";

?>

