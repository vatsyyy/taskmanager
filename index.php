<?php
    session_start();
    require_once 'config/database.php';

    if (!isset($_SESSION['utilisateur_id'])) {
        header("Location: auth/connexion.php");
        exit();
    }

    $uid = $_SESSION['utilisateur_id'];


    // Récupérer les tâches de l'utilisateur connecté et filtre par statut
    $filtre = isset($_GET['filtre']) ? $_GET['filtre'] : 'toutes';
    
    if ($filtre == 'en_cours') {
        $stmt = $pdo->prepare("SELECT * FROM taches WHERE utilisateur_id = :uid AND statut = 'en_cours' ");
    } elseif ($filtre == 'terminée') {
        $stmt = $pdo->prepare("SELECT * FROM taches WHERE utilisateur_id = :uid AND statut = 'terminée' ");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM taches WHERE utilisateur_id = :uid");
    }

    $stmt->execute([
        ':uid' => $uid
    ]);
    $taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once 'includes/header.php';
?>


<section class="formulaire">
    <form method="POST" action="traitement.php">
        <input type="text" name="titre" placeholder="Nouvelle tâche...">
        <button type="submit">Ajouter</button>
    </form>
</section>

<section class="filtres">
    <a href="?filtre=toutes" class="<?= $filtre == 'toutes' ? 'actif' : '' ?>">Toutes</a>
    <a href="?filtre=en_cours" class="<?= $filtre == 'en_cours' ? 'actif' : '' ?>">En cours</a>
    <a href="?filtre=terminée" class="<?= $filtre == 'terminée' ? 'actif' : '' ?>">Terminée</a>
</section>

<section class="liste-taches">
    <?php if (count($taches) > 0): ?>
        <ul>
            <?php foreach($taches as $tache): ?>
                <li class="tache <?= $tache['statut'] == 'terminée' ? 'terminée' : '' ?>">
                    <span> <?= htmlspecialchars($tache['titre']) ?> </span>
                    <div class="actions">
                        <?php if ($tache['statut'] === 'en_cours'): ?>
                            <form method="POST" action="traitement.php" style="display: inline;">
                                <input type="hidden" name="terminer_id" value="<?= $tache['id'] ?>">
                                <button type="submit"> ✅ Terminer</button>
                            </form>
                        <?php endif; ?>
    
                        <form method="POST" action="traitement.php" style="display: inline;">
                            <input type="hidden" name="supprimer_id" value="<?= $tache['id'] ?>">
                            <button type="submit"> ❌ Supprimer</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>Aucune tâche pour le moment.</p>
    <?php endif; ?>
</section>

<?php require_once 'includes/footer.php'; ?>
    