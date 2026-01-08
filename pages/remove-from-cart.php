<?php
session_start();
require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: cart.php");
  exit;
}

$cartItemId = (int)($_POST["cart_item_id"] ?? 0);
if ($cartItemId <= 0) {
  header("Location: cart.php");
  exit;
}


$stmt = $pdo->prepare("
  DELETE ci FROM cart_items ci
  JOIN carts c ON c.id = ci.cart_id
  WHERE ci.id = ? AND c.user_id = ?
");
$stmt->execute([$cartItemId, (int)$_SESSION["user_id"]]);

header("Location: cart.php");
exit;
