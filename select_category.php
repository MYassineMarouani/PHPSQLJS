<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Select Category</title>
</head>
<body>
  <h1>Select a Category</h1>
  <form action="select_product.php" method="get">
    <label for="category">Category:</label>
    <select id="category" name="category">
      <!-- generate options dynamically from database -->
      <?php
        // connect to the database
        $pdo = new PDO('mysql:host=localhost;dbname=menusdb', 'root', 'root');
        
        // execute a SELECT query to fetch categories
        $stmt = $pdo->query('SELECT id_cat, designation FROM CATEGORIE');
        
        // generate options for each category
        while ($row = $stmt->fetch()) {
          echo '<option value="' . htmlspecialchars($row['id_cat']) . '">' . htmlspecialchars($row['designation']) . '</option>';
        }
      ?>
    </select>
    <input type="submit" value="Select">
  </form>
</body>
</html>
