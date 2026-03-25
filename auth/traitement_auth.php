<?php
    session_start();
    require_once '../config/database.php';

    //Traitement connexion
    if (isset($_POST['action']) && $_POST['action'] == 'connexion') {
        $email = trim(htmlspecialchars($_POST['email']));
        $mot_de_passe = trim(htmlspecialchars($_POST['mot_de_passe']));

        if (empty($email) || empty($mot_de_passe)) {
            header("Location: connexion.php?erreur=champs_vides");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: connexion.php?erreur=email_invalide");
            exit();
        } else {
            $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
            $stmt->execute([
                'email' => $email
            ]);
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
                $_SESSION['utilisateur_id'] = $utilisateur['id'];
                $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
                header("Location: ../index.php");
                exit();
            } else {
                header("Location: connexion.php?erreur=identifiants_incorrects");
                exit();
            }
        }
    }


    
    //Traitement inscription
    if (isset($_POST['action']) && $_POST['action'] == 'inscription') {
        $nom = trim(htmlspecialchars($_POST['nom']));
        $email = trim(htmlspecialchars($_POST['email']));
        $mot_de_passe = trim(htmlspecialchars($_POST['mot_de_passe']));


        // Validation
        if (empty($nom) || empty($email) || empty($mot_de_passe)) {
            header("Location: inscription.php?erreur=champs_vides");
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: inscription.php?erreur=email_invalide");
            exit();
        } elseif (strlen($mot_de_passe) < 8) {
            header("Location: inscription.php?erreur=mot_de_passe_court");
            exit();
        } else {
            // Vérifier si l'email existe déjà
            $stmt = $pdo->prepare("SELECT id from utilisateurs WHERE email = :email");
            $stmt->execute([
                ':email' => $email
            ]);

            if ($stmt->rowCount() > 0) {
                header("Location: inscription.php?erreur=email_existe");
                exit();
            } else {
                //Hasher mot de passe
                $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)");
                $stmt->execute([
                    ':nom' => $nom,
                    ':email' => $email,
                    ':mot_de_passe' => $hash
                ]);

                header("Location: connexion.php?success=inscription");
                exit();
            }
        }
    }

    header("Location: connexion.php");
    exit();