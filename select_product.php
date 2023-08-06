<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Select Product</title>
  
</head>
<body>
  <h1>Select a Product</h1>
  <?php
    // check if category has been selected
    if (isset($_GET['category'])) {
      // get selected category ID
      $category_id = $_GET['category'];
      
      // connect to the database
      $pdo = new PDO('mysql:host=localhost;dbname=menusdb', 'root', 'root');
      
      // execute a SELECT query to fetch products for the selected category
      $stmt = $pdo->prepare('SELECT id_pro, designation FROM PRODUIT WHERE id_cat = :category_id');
      $stmt->bindParam(':category_id', $category_id);
      $stmt->execute();
      
      // generate options for each product
      echo '<form action="show_product.php" method="get">';
      echo '<label for="product">Product:</label>';
      echo '<select id="product" name="product">';
      while ($row = $stmt->fetch()) {
        echo '<option value="' . htmlspecialchars($row['id_pro']) . '">' . htmlspecialchars($row['designation']) . '</option>';
      }
      echo '</select>';
      echo '<input type="hidden" name="category" value="' . htmlspecialchars($category_id) . '">';
      echo '<input type="submit" value="Select">';
      echo '</form>';
    } else {
      // display error message if category has not been selected
      echo '<p>Please select a category first.</p>';
    }
  ?>
</body>
</html>
