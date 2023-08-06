<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=annuairedb', 'root', 'root');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $nouveau_num_poste = $_POST['num_poste'];

    // Vérifier si l'employé existe dans la table
    $query = $pdo->prepare('SELECT * FROM annuaire WHERE nom = :nom AND prenom = :prenom');
    $query->execute(array('nom' => $nom, 'prenom' => $prenom));

    if ($query->rowCount() == 0) {
        echo 'Cet employé n\'existe pas dans la base de données.';
    } else {
        // Mettre à jour le numéro de num_poste de l'employé
        $query = $pdo->prepare('UPDATE annuaire SET num_poste = :num_poste WHERE nom = :nom AND prenom = :prenom');
        $query->execute(array('num_poste' => $nouveau_num_poste, 'nom' => $nom, 'prenom' => $prenom));

        echo 'Le numéro de num_poste de l\'employé ' . $prenom . ' ' . $nom . ' a été mis à jour.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mettre à jour l'annuaire</title>
</head>
<body>
    <h1>Mettre à jour l'annuaire</h1>

    <form method="post">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required><br>

        <label for="num_poste">Nouveau numéro de num_poste :</label>
        <input type="text" name="num_poste" required><br>

        <input type="submit" name="submit" value="Mettre à jour">
    </form>
</body>
</html>
