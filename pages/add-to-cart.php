<?php
session_start();
require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: ../index.php");
  exit;
}

$userId = (int)$_SESSION["user_id"];
$productId = (int)($_POST["product_id"] ?? 0);
$qty = (int)($_POST["quantity"] ?? 1);

if ($productId <= 0) {
  header("Location: ../index.php");
  exit;
}
if ($qty < 1) $qty = 1;


$stmt = $pdo->prepare("SELECT id FROM carts WHERE user_id = ? LIMIT 1");
$stmt->execute([$userId]);
$cartId = $stmt->fetchColumn();

if (!$cartId) {
  $stmt = $pdo->prepare("INSERT INTO carts (user_id) VALUES (?)");
  $stmt->execute([$userId]);
  $cartId = (int)$pdo->lastInsertId();
}


$stmt = $pdo->prepare("SELECT id, quantity FROM cart_items WHERE cart_id = ? AND products_id = ? LIMIT 1");
$stmt->execute([$cartId, $productId]);
$row = $stmt->fetch();

if ($row) {
  $newQty = (int)$row["quantity"] + $qty;
  $upd = $pdo->prepare("UPDATE cart_items SET quantity = ? WHERE id = ?");
  $upd->execute([$newQty, $row["id"]]);
} else {
  $ins = $pdo->prepare("INSERT INTO cart_items (cart_id, products_id, quantity) VALUES (?, ?, ?)");
  $ins->execute([$cartId, $productId, $qty]);
}

header("Location: cart.php");
exit;
