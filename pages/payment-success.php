<?php
session_start();

$BASE = "/onlinewebshop"; 

if (!isset($_SESSION["user_id"])) {
  header("Location: $BASE/pages/login.php");
  exit;
}

$orderId = (int)($_GET["order_id"] ?? 0);

$flash = $_SESSION["flash_success"] ?? "Betaling gelukt!";
unset($_SESSION["flash_success"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Betaling gelukt - Buchan</title>
  <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
  <div style="max-width:800px;margin:80px auto;padding:20px;text-align:center;">
    <h1><?= htmlspecialchars($flash) ?></h1>

    <?php if ($orderId > 0): ?>
      <p>Ordernummer: <strong>#<?= $orderId ?></strong></p>
    <?php endif; ?>

    <div style="margin-top:30px;">
      <a href="<?= $BASE ?>/pages/account.php" style="margin-right:16px;">Bekijk mijn bestellingen</a>
      <a href="<?= $BASE ?>/index.php">Verder winkelen</a>
    </div>
  </div>
</body>
</html>
