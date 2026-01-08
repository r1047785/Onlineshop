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

$userId = (int)$_SESSION["user_id"];


$stmt = $pdo->prepare("SELECT id FROM carts WHERE user_id = ? LIMIT 1");
$stmt->execute([$userId]);
$cartId = (int)$stmt->fetchColumn();

if ($cartId <= 0) {
  header("Location: cart.php");
  exit;
}


$stmt = $pdo->prepare("
  SELECT ci.products_id, ci.quantity, p.price
  FROM cart_items ci
  JOIN products p ON p.id = ci.products_id
  WHERE ci.cart_id = ?
");
$stmt->execute([$cartId]);
$cartItems = $stmt->fetchAll();

if (!$cartItems || count($cartItems) === 0) {
  header("Location: cart.php");
  exit;
}


$subtotal = 0.0;
foreach ($cartItems as $it) {
  $subtotal += ((float)$it["price"]) * ((int)$it["quantity"]);
}
$taxRate = 0.21;
$tax = $subtotal * $taxRate;
$total = $subtotal + $tax;

try {
  $pdo->beginTransaction();


  $stmt = $pdo->prepare("INSERT INTO orders (user_id, total) VALUES (?, ?)");
  $stmt->execute([$userId, $total]);
  $orderId = (int)$pdo->lastInsertId();

 
  $stmt = $pdo->prepare("
    INSERT INTO order_items (order_id, products_id, quantity, price)
    VALUES (?, ?, ?, ?)
  ");

  foreach ($cartItems as $it) {
    $stmt->execute([
      $orderId,
      (int)$it["products_id"],
      (int)$it["quantity"],
      (float)$it["price"],
    ]);
  }


  $stmt = $pdo->prepare("DELETE FROM cart_items WHERE cart_id = ?");
  $stmt->execute([$cartId]);

  $pdo->commit();

  header("Location: payment-success.php?order_id=" . $orderId);
  exit;

} catch (Exception $e) {
  $pdo->rollBack();
  die("Checkout mislukt: " . $e->getMessage());
}
