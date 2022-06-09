<form method="post"

    <?php
    $controller = static::$object;
    $action = $_GET['action'];
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
                <p>
                    <input type="text" value="" name="prenom" id="prenom_id" required/>
                    <label for="prenom_id">Prenom</label>
                </p>

                <p>
                    <input type="text" value="" name="nom_client" id="nom_client_id" required/>
                    <label for="nom_client_id">Nom</label>
                </p>

                <p>
                    <input type="email" value="" name="mail" id="mail_id" required/>
                    <label for="mail_id">Mail</label>
                </p>
                <p>
                    <input type="text" value="" name="login" id="login_id" required/>
                    <label for="login_id">Login</label>
                </p>
                <p>
                    <input type="password" value="" name="mdp" id="mdp_id" required/>
                    <label for="mdp_id">Mot de passe</label>
                </p>
                <p>
                    <input type="password" value="" name="confirm_mdp" id="confirm_mdp_id" required/>
                    <label for="confirm_mdp_id">Confirmation mot de passe</label>
                </p>
                <p>
                    <input type="text" value="" name="adresse" id="adresse_id" required/>
                    <label for="adresse_id">Adresse</label>
                </p>
                <p>
                    <input type="text" value="" name="ville" id="ville_id" required/>
                    <label for="ville_id">Ville</label>
                </p>
                <p>
                    <input type="text" value="" name="code_postal" id="code_postal_id" required/>
                    <label for="code_postal_id">Code Postal</label>
                </p>

                <p>
                    <input type="date" value="" name="date_naissance" id="date_naissance_id" required/>
                    <label for="date_naissance_id">Date de naissance</label>
                </p>
        </p>
        <p>
            <input type="submit" value="Envoyer" />
        </p>



                <?php
            } else if ($action === 'update' || $action === 'updated'){
                $sql = "SELECT COUNT(*) AS nb FROM p_clients WHERE login = :login";
                $req_prep = Model::getPDO()->prepare($sql);
                $value = array('login' => $_SESSION['login']);
                $req_prep->execute($value);
                $tab = $req_prep->fetch();
                if (!($tab == '1')){
                    $nom_client = $client->getNom();
                    $prenom = $client->getPrenom();
                    $mail = $client->getMail();
                    $adresse = $client->getAdresse();
                    $ville = $client->getVille();
                    $code_postal = $client->getCodePostal();
                    $mdp = $client->getMdp();
                    $date_naissance = $client->getDateDeNaissance();
                    $login = $client->getLogin();
                    $admin = $client->getAdmin();
                    if (Session::is_admin($_SESSION['login']) || $_SESSION['login'] == $login){
                        ?>
                        <p>
                            <input type="text" value="<?php echo"$prenom";?>" name="prenom" id="prenom_id" required/>
                            <label for="prenom_id">Prenom</label>
                        </p>
                        <p>
                            <input type="text" value="<?php echo"$nom_client";?>" name="nom_client" id="nom_client_id" required/>
                            <label for="nom_client_id">Nom</label>
                        </p>

                        <p>
                            <input type="email" value="<?php echo"$mail";?>" name="mail" id="mail_id" required/>
                            <label for="mail_id">Mail</label>
                        </p>

                        <p>
                            <input type="text" value="<?php echo"$login";?>" name="login" id="login_id" required/>
                            <label for="login_id">Login</label>
                        </p>
                        <p>
                            <input type="password" value="" name="mdp" id="mdp_id" required/>
                            <label for="mdp_id">Mot de passe</label>
                        </p>
                        <p>
                            <input type="password" value="" name="confirm_mdp" id="confirm_mdp_id" required/>
                            <label for="confirm_mdp_id">Confirmer mot de passe</label>
                        </p>
                        <p>
                            <input type="text" value="<?php echo"$adresse";?>" name="adresse" id="adresse_id" required/>
                            <label for="adresse_id">Adresse</label>
                        </p>

                        <p>
                            <input type="text" value="<?php echo"$ville";?>" name="ville" id="ville_id" required/>
                            <label for="ville_id">Ville</label>
                        </p>

                        <p>
                            <input type="text" value="<?php echo"$code_postal";?>" name="code_postal" id="code_postal_id" required/>
                            <label for="code_postal_id">Code Postal</label>
                        </p>

                        </p>

                        <p>
                            <input type="date" value="<?php echo"$date_naissance";?>" name="date_naissance" id="date_naissance_id" required/>
                            <label for="date_naissance_id">Date de naissance</label>
                        </p>
                        <?php
                        if (Session::is_admin($_SESSION['login'])){
                            ?>

                            <p>Administrateur :</p>
                            <br><label for="Oui">Oui</label>
                            <input type="radio" name="admin" id="oui_id" value="oui"/>

                            <br><label for="Non">Non</label>
                            <input type="radio" name="admin" id="non_id" value="non" checked/>

                            </p>
                            <p>
                                <input type="submit" value="Envoyer" />
                            </p>
                            <?php
                        }
                    }else{
                        $view = 'error/errorHack';
                        $pagetitle = "Hacker c'est mal";
                        $path_array = array('view/view.php');
                        require(File::build_Path($path_array));
                    }
                }else{
                    $view = 'error/errorIdMissing';
                    $pagetitle = "Id client non reconnu";
                    $path_array = array('view/view.php');
                    require(File::build_Path($path_array));
                }
            }
            ?>
    </fieldset>
</form>
