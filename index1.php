<style>
    /* Style for the selection form */
form {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 20px;
}

select {
    padding: 8px;
    border: none;
    border-radius: 4px;
    background-color: #f2f2f2;
    margin-right: 10px;
    font-size: 16px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #3e8e41;
}

/* Style for the selected product information */
div {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 50px;

}

h2 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    background-color:green;
}

p {
    font-size: 18px;
    margin-bottom: 10px;
}
span {
    border-style:solid;
    margin-left:-5px;
}
.c {
    display:flex;
    flex-direction: row
}
.a {
    display:flex;
    flex-direction:column;
    
}
.select {
    border-style:solid;
    margin-top:-20px;
    width:540px;
}

</style>
<!-- Connexion à la base de données -->
<?php
require_once('connexion.php');// Inclure le fichier de connexion
?>
<div class='a'>
<!-- Cadre de sélection de catégorie -->
<div class='c'>
    <span>
    <h2>Sélectionnez une catégorie :</h2>
    <form id="category-form" action="" method="get">
    <select name="id_cat" onchange="document.getElementById('category-form').submit()">
            <?php
            // Récupérer la liste des catégories depuis la base de données
            $result = $conn->query("SELECT * FROM CATEGORIE");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                // Afficher une option pour chaque catégorie
                $selected = '';
                if (isset($_GET['id_cat']) && intval($_GET['id_cat']) === intval($row['id_cat'])) {
                    $selected = 'selected';
                }
                echo "<option value='" . $row['id_cat'] . "' $selected>" . $row['designation'] . "</option>";
            }
            ?>
        </select>
    </form>
    </span>
<hr>
<!-- Cadre de sélection de produit -->
<?php
if (isset($_GET['id_cat'])) { // Vérifier si une catégorie a été sélectionnée
    $id_cat = intval($_GET['id_cat']);
    // Récupérer la liste des produits de la catégorie sélectionnée depuis la base de données
    $result = $conn->query("SELECT * FROM PRODUIT WHERE id_cat=$id_cat");
?>
   <span>
        <h2>Sélectionnez un produit :</h2>
        <form action="" method="get">
            <select name="id_pro">
                <?php
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    // Afficher une option pour chaque produit de la catégorie sélectionnée
                    echo "<option value='" . $row['id_pro'] . "'>" . $row['designation'] . "</option>";
                }
                ?>
            </select>
            <input type="hidden" name="id_cat" value="<?php echo $id_cat; ?>">
            <input type="submit" value="Valider">
        </form>
            </span>
    </div>
    <hr>
<?php
}
?>

<!-- Cadre d'affichage du produit sélectionné -->
<?php
if (isset($_GET['id_pro'])) { // Vérifier si un produit a été sélectionné
    $id_pro = intval($_GET['id_pro']);
    // Récupérer les informations du produit sélectionné depuis la base de données
    $result = $conn->query("SELECT * FROM PRODUIT WHERE id_pro=$id_pro");
    $row = $result->fetch(PDO::FETCH_ASSOC);
?>
    <div class='select'>
        <h2>Produit sélectionné :</h2>
        <p>Désignation : <?php echo $row['designation']; ?></p>
        <p>Marque : <?php echo $row['marque']; ?></p>
        <p>Prix : <?php echo $row['prix_uht'];?>  </p>
        <p>Stock : <?php echo $row['qstock']; ?></p>
 </div>
 <hr>
 </div>
 <?php
 }
 ?>
 <!-- Fermer la connexion à la base de données -->