<?php
session_start();
require_once __DIR__ . "/../../includes/db.php";
require_once __DIR__ . "/../../includes/admin-guard.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: /onlinewebshop/pages/admin/products.php");
  exit;
}

$id = (int)($_POST["id"] ?? 0);

if ($id > 0) {
  $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: /onlinewebshop/pages/admin/products.php");
exit;
?>