<?php
echo "<ul>";
if (Session::is_admin($_SESSION['login'])) {
    echo "<li>";
    echo"<a href='index.php?action=create&controller=tapis'>Creare un tappeto</a>";
    echo "</li>";
}
if (Session::is_admin($_SESSION['login'])) {
    echo "<li>";
    echo "<a href='index.php?action=readAll&controller=clients'>Liste des clients</a>";
    echo "</li>";
}

if (Session::is_admin($_SESSION['login'])) {
    echo "<li>";
    echo "<a href='index.php?action=readAll&controller=commandes'>Liste des commandes</a>";
    echo "</li>";
}
echo "</ul>";
?>