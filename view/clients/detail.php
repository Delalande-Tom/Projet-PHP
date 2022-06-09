<?php
    echo "<pre>";
    if (Session::is_admin($_SESSION['login']) == true){
    }else {
        $_SESSION['admin'] = false;
    }
    $tab = ModelClients::select($_SESSION['login']);
    $login = htmlspecialchars($tab->getLogin());
    $id_client_echappee = rawurlencode($tab->getId_client());
    $prenom = htmlspecialchars($tab->getPrenom());
    $nom = htmlspecialchars($tab->getNom());
    $mail = htmlspecialchars($tab->getMail());
    $adresse = htmlspecialchars($tab->getAdresse());
    $ville = htmlspecialchars($tab->getVille());
    $code_postal = htmlspecialchars($tab->getCodePostal());
    $date_de_naissance = htmlspecialchars($tab->getDateDeNaissance());

    echo "<p>Login : $login</p>";
    echo "<p>Prénom : $prenom</p>";
    echo "<p>Nom : $nom</p>";
    echo "<p>Adresse mail : $mail</p>";
    echo "<p>Adresse postale : $adresse</p>";
    echo "<p>Ville : $ville</p>";
    echo "<p>Code postal : $code_postal</p>";
    echo "<p>Date de naissance : $date_de_naissance</p>";
    echo "<p>Votre mot de passe n'est bien évidemment pas affiché pour plus de sécurité</p>";
    echo "<button><a href='index.php?action=readAllCommandesByClient&id_client=$id_client_echappee&controller=commandes'>Voir mes commandes</a></button>";
    echo "<button><a href='index.php?action=update&id_client=$id_client_echappee&controller=clients'>Modifier mes infos</a></button>";
    echo "</pre>"
?>