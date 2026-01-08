<?php
session_start();
require_once __DIR__ . "/../../includes/db.php";
require_once __DIR__ . "/../../includes/admin-guard.php";

$stmt = $pdo->query("SELECT id, name, price, image_url FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Products</title>
  <link rel="stylesheet" href="/onlinewebshop/styles/styles.css" />
</head>
<body style="max-width:1100px;margin:40px auto;padding:0 16px;">
  <h1>Admin – Producten</h1>

  <p>
    <a href="/onlinewebshop/pages/admin/product-create.php">+ Product toevoegen</a>
    | <a href="/onlinewebshop/pages/admin/index.php">Dashboard</a>
  </p>

  <table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse:collapse;">
    <thead>
      <tr>
        <th>ID</th><th>Naam</th><th>Prijs</th><th>Image URL</th><th>Acties</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $p): ?>
        <tr>
          <td><?= (int)$p["id"] ?></td>
          <td><?= htmlspecialchars($p["name"]) ?></td>
          <td>€<?= number_format((float)$p["price"], 2, ".", "") ?></td>
          <td><?= htmlspecialchars($p["image_url"] ?? "") ?></td>
          <td style="white-space:nowrap;">
            <a href="/onlinewebshop/pages/admin/product-edit.php?id=<?= (int)$p["id"] ?>">Edit</a>

            <form method="POST" action="/onlinewebshop/pages/admin/product-delete.php" style="display:inline;">
              <input type="hidden" name="id" value="<?= (int)$p["id"] ?>">
              <button type="submit" onclick="return confirm('Verwijderen?')">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
