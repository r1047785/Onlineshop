<?php
session_start();
require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

$userId = (int)$_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT id, total, created_at FROM orders WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$userId]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Account - Buchan</title>
  <link rel="stylesheet" href="../styles/styles.css" />
</head>
<body>
  <div style="max-width:1000px;margin:40px auto;padding:20px;">
    <h1>ACCOUNT</h1>
    <p>Hi, <?= htmlspecialchars($_SESSION["user_name"] ?? "user") ?> 👋</p>

    <h2 style="margin-top:30px;">Mijn bestellingen</h2>

    <?php if (!$orders || count($orders) === 0): ?>
      <p>Je hebt nog geen bestellingen.</p>
    <?php else: ?>
      <div style="display:grid;gap:12px;">
        <?php foreach ($orders as $o): ?>
          <div style="border:1px solid #ddd;border-radius:12px;padding:14px;">
            <div style="display:flex;justify-content:space-between;gap:10px;flex-wrap:wrap;">
              <div><strong>Order #<?= (int)$o["id"] ?></strong></div>
              <div><strong>€<?= number_format((float)$o["total"], 2, ".", "") ?></strong></div>
              <div style="color:#666;"><?= htmlspecialchars($o["created_at"]) ?></div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <p style="margin-top:24px;"><a href="logout.php">Logout</a></p>
  </div>
</body>
</html>
