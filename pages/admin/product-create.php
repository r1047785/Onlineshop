<?php
session_start();
require_once __DIR__ . "/../../includes/db.php";
require_once __DIR__ . "/../../includes/admin-guard.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $price = (float)($_POST["price"] ?? 0);
  $image_url = trim($_POST["image_url"] ?? "");

  if ($name === "" || $price <= 0) {
    $error = "Naam en prijs zijn verplicht.";
  } else {
    $stmt = $pdo->prepare("INSERT INTO products (name, description, price, image_url) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $description, $price, $image_url]);

    header("Location: /onlinewebshop/pages/admin/products.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Add product</title>
  <link rel="stylesheet" href="/onlinewebshop/styles/styles.css" />
</head>
<body style="max-width:800px;margin:40px auto;padding:0 16px;">
  <h1>Product toevoegen</h1>

  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST">
    <p>
      <label>Naam</label><br>
      <input type="text" name="name" required style="width:100%;">
    </p>
    <p>
      <label>Beschrijving</label><br>
      <textarea name="description" rows="5" style="width:100%;"></textarea>
    </p>
    <p>
      <label>Prijs</label><br>
      <input type="number" step="0.01" name="price" required style="width:200px;">
    </p>
    <p>
      <label>Image URL (bv: images/Item1.png)</label><br>
      <input type="text" name="image_url" style="width:100%;">
    </p>

    <button type="submit">Opslaan</button>
    <a href="/onlinewebshop/pages/admin/products.php" style="margin-left:12px;">Annuleren</a>
  </form>
</body>
</html>
