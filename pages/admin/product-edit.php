<?php
session_start();
require_once __DIR__ . "/../../includes/db.php";
require_once __DIR__ . "/../../includes/admin-guard.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) { header("Location: /onlinewebshop/pages/admin/products.php"); exit; }

$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? LIMIT 1");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) { header("Location: /onlinewebshop/pages/admin/products.php"); exit; }

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $price = (float)($_POST["price"] ?? 0);
  $image_url = trim($_POST["image_url"] ?? "");

  if ($name === "" || $price <= 0) {
    $error = "Naam en prijs zijn verplicht.";
  } else {
    $stmt = $pdo->prepare("UPDATE products SET name=?, description=?, price=?, image_url=? WHERE id=?");
    $stmt->execute([$name, $description, $price, $image_url, $id]);

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
  <title>Admin - Edit product</title>
  <link rel="stylesheet" href="/onlinewebshop/styles/styles.css" />
</head>
<body style="max-width:800px;margin:40px auto;padding:0 16px;">
  <h1>Product aanpassen (#<?= (int)$id ?>)</h1>

  <?php if ($error): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST">
    <p>
      <label>Naam</label><br>
      <input type="text" name="name" required style="width:100%;" value="<?= htmlspecialchars($product["name"]) ?>">
    </p>
    <p>
      <label>Beschrijving</label><br>
      <textarea name="description" rows="5" style="width:100%;"><?= htmlspecialchars($product["description"] ?? "") ?></textarea>
    </p>
    <p>
      <label>Prijs</label><br>
      <input type="number" step="0.01" name="price" required style="width:200px;" value="<?= htmlspecialchars($product["price"]) ?>">
    </p>
    <p>
      <label>Image URL</label><br>
      <input type="text" name="image_url" style="width:100%;" value="<?= htmlspecialchars($product["image_url"] ?? "") ?>">
    </p>

    <button type="submit">Opslaan</button>
    <a href="/onlinewebshop/pages/admin/products.php" style="margin-left:12px;">Annuleren</a>
  </form>
</body>
</html>
