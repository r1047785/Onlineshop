<?php
session_start();
require_once __DIR__ . "/../../includes/admin-guard.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin</title>
  <link rel="stylesheet" href="/onlinewebshop/styles/styles.css" />
</head>
<body style="max-width:900px;margin:40px auto;padding:0 16px;">
  <h1>Admin Dashboard</h1>

  <ul>
    <li><a href="/onlinewebshop/pages/admin/products.php">Producten beheren</a></li>
    <li><a href="/onlinewebshop/index.php">Terug naar site</a></li>
  </ul>
</body>
</html>
