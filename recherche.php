<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "annuairedb";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Traitement de la recherche
if(isset($_POST['rechercher'])) {
    // Récupération des données envoyées par le formulaire de recherche
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];

    // Requête SQL pour rechercher les entrées correspondantes
    $sql = "SELECT * FROM ANNUAIRE WHERE nom LIKE '$nom%' AND prenom LIKE '$prenom%'";

    $result = $conn->query($sql);

    // Affichage des résultats de la recherche
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "Nom: " . $row["nom"]. " - Prénom: " . $row["prenom"]. " - Numéro de poste: " . $row["num_poste"]. "<br>";
        }
    } else {
        echo "Aucune entrée trouvée.";
    }
}

// Traitement de l'ajout
if(isset($_POST['ajouter'])) {
    // Récupération des données envoyées par le formulaire d'ajout
    $nom = $_POST["nom_ajout"];
    $prenom = $_POST["prenom_ajout"];
    $poste = $_POST["poste_ajout"];

    // Requête SQL pour ajouter l'entrée
    $sql = "INSERT INTO ANNUAIRE (nom, prenom, num_poste) VALUES ('$nom', '$prenom', '$poste')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouvelle entrée ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'entrée: " . $conn->error;
    }
}

// Traitement de la modification
if(isset($_POST['modifier'])) {
    // Récupération des données envoyées par le formulaire de modification
    $nom = $_POST["nom_modif"];
    $prenom = $_POST["prenom_modif"];
    $poste = $_POST["poste_modif"];

    // Requête SQL pour modifier le numéro de poste de l'entrée
    $sql = "UPDATE ANNUAIRE SET num_poste='$poste' WHERE nom='$nom' AND prenom='$prenom'";

    if ($conn->query($sql) === TRUE) {
        echo "Numéro de poste modifié avec succès.";
    } else {
        echo "Erreur lors de la modification du numéro de poste: " . $conn->error;
    }
}

// Traitement de la suppression
if(isset($_POST['supprimer'])) {
    // Récupération des données envoyées par le formulaire de suppression
    $nom = $_POST["nom_suppr"];
    $prenom = $_POST["prenom_suppr"];

    // Requête SQL pour supprimer l'entrée
    $sql = "DELETE FROM ANNUAIRE WHERE nom='$nom' AND prenom='$prenom'";

    if ($conn->query($sql) === TRUE) {
        echo"Entrée supprimée avec succès.";
    } else {
    echo "Erreur lors de la suppression de l'entrée: " . $conn->error;
    }
    }
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Annuaire</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Annuaire</h1>
        <hr>
        <div class="table-container">
  <?php
    // connect to the database
    $pdo = new PDO('mysql:host=localhost;dbname=annuairedb', 'root', 'root');

    // execute a SELECT query
    $stmt = $pdo->query('SELECT nom, prenom, num_poste FROM ANNUAIRE');

    // display the fetched records in an HTML table
    echo '<table>';
    echo '<tr><th>Nom</th><th>Prénom</th><th>Numéro de poste</th></tr>';
    while ($row = $stmt->fetch()) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($row['nom']) . '</td>';
      echo '<td>' . htmlspecialchars($row['prenom']) . '</td>';
      echo '<td>' . htmlspecialchars($row['num_poste']) . '</td>';
      echo '</tr>';
    }
    echo '</table>';
  ?>
</div>
        <h2>Recherche</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Nom:</label>
    <input type="text" name="nom">
    <label>Prénom:</label>
    <input type="text" name="prenom">
    <input type="submit" name="rechercher" value="Rechercher">
</form>
<hr>

<h2>Ajout</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Nom:</label>
    <input type="text" name="nom_ajout">
    <label>Prénom:</label>
    <input type="text" name="prenom_ajout">
    <label>Numéro de poste:</label>
    <input type="text" name="poste_ajout">
    <input type="submit" name="ajouter" value="Ajouter">
</form>
<hr>
<h2>Modification</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Nom:</label>
    <input type="text" name="nom_modif">
    <label>Prénom:</label>
    <input type="text" name="prenom_modif">
    <label>Nouveau numéro de poste:</label>
    <input type="text" name="poste_modif">
    <input type="submit" name="modifier" value="Modifier">
</form>
<hr>
<h2>Suppression</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label>Nom:</label>
    <input type="text" name="nom_suppr">
    <label>Prénom:</label>
    <input type="text" name="prenom_suppr">
    <input type="submit" name="supprimer" value="Supprimer">
</form>

</body>
</html>