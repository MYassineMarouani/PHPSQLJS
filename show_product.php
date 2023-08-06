<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Selected Product</title>
  
</head>
<body>
  <h1>Selected Product</h1>
  <?php
    // check if product has been selected
    if (isset($_GET['product'])) {
      // get selected product ID
      $product_id = $_GET['product'];
      
      // connect to the database
      $pdo = new PDO('mysql:host=localhost;dbname=menusdb', 'root', 'root');
      
      // execute a SELECT query to fetch product details
      $stmt = $pdo->prepare('SELECT designation, marque, prix_uht, qstock FROM PRODUIT WHERE id_pro = :product_id');
      $stmt->bindParam(':product_id', $product_id);
      $stmt->execute();
      
      // display product details
      if ($row = $stmt->fetch()) {
        echo '<p><strong>Designation:</strong> ' . htmlspecialchars($row['designation']) . '</p>';
        echo '<p><strong>Marque:</strong> ' . htmlspecialchars($row['marque']) . '</p>';
        echo '<p><strong>Prix UHT:</strong> ' . htmlspecialchars($row['prix_uht']) . '</p>';
        echo '<p><strong>Quantité en stock:</strong> ' . htmlspecialchars($row['qstock']) . '</p>';
      } else {
        // display error message if product not found
        echo '<p>Product not found.</p>';
      }
    } else {
      // display error message if product has not been selected
      echo '<p>Please select a product first.</p>';
    }
  ?>
</body>
</html>
