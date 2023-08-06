<style>
  body {
  font-family: Arial, sans-serif;
  background-color: #f2f2f2;
}

h1, h2 {
  text-align: center;
  color: #333;
}

table {
  margin: 0 auto;
  border-collapse: collapse;
  border: 2px solid #333;
}

table th, table td {
  padding: 10px;
  border: 1px solid #333;
}

table th {
  background-color: #333;
  color: #fff;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

input[type="text"], input[type="submit"] {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

label {
  display: block;
  margin-bottom: 5px;
  color: #333;
}

button[type="submit"] {
  background-color: #333;
  color: #fff;
  padding: 8px;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #555;
}

</style>
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
