<?php
session_start();
require_once __DIR__ . "/../includes/db.php";

$items = [];
$subtotal = 0;

if (isset($_SESSION["user_id"])) {
  $userId = (int)$_SESSION["user_id"];

  $stmt = $pdo->prepare("SELECT id FROM carts WHERE user_id = ? LIMIT 1");
  $stmt->execute([$userId]);
  $cartId = $stmt->fetchColumn();

  if ($cartId) {
    $stmt = $pdo->prepare("
      SELECT 
        ci.id AS cart_item_id,
        ci.quantity,
        p.id AS product_id,
        p.name,
        p.price,
        p.image_url
      FROM cart_items ci
      JOIN products p ON p.id = ci.products_id
      WHERE ci.cart_id = ?
      ORDER BY ci.id DESC
    ");
    $stmt->execute([$cartId]);
    $items = $stmt->fetchAll();

    foreach ($items as $it) {
      $subtotal += ((float)$it["price"]) * ((int)$it["quantity"]);
    }
  }
}


$taxRate = 0.21; 
$tax = $subtotal * $taxRate;
$total = $subtotal + $tax;


if ($subtotal <= 0) {
  $tax = 0;
  $total = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shopping Cart - Buchan</title>
  <link rel="stylesheet" href="../styles/styles.css" />
  <link rel="stylesheet" href="../styles/cart.css" />
</head>
<body>
  <nav>
    <header class="nav">
      <div class="nav-left">
        <button class="search-btn" aria-label="Search">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.35-4.35"></path>
          </svg>
        </button>
      </div>

      <a href="../index.php" class="logo">Buchan</a>

      <nav class="menu">
        <a href="../index.php">HOME</a>
        <a href="/shop">SHOP</a>
        <a href="/in-stores">IN STORES</a>
        <a href="/our-story">OUR STORY</a>
        <a href="/faq">FAQ</a>
      </nav>

      <div class="nav-right">
        <div class="region-selector">
          Belgium | EUR €
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </div>

        <?php if (isset($_SESSION["user_id"])): ?>
          <span style="margin-left:10px;">Hi, <?= htmlspecialchars($_SESSION["user_name"] ?? "user") ?></span>
          <a href="logout.php" style="margin-left:12px;"><p>LOGOUT</p></a>
        <?php else: ?>
          <a href="login.php" class="icon-btn" aria-label="Account">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </a>
          <a href="register.php" style="margin-left:12px;"><p>REGISTER</p></a>
        <?php endif; ?>

        <a href="cart.php" class="icon-btn" aria-label="Cart">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="9" cy="21" r="1"></circle>
            <circle cx="20" cy="21" r="1"></circle>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
          </svg>
        </a>
      </div>
    </header>
  </nav>

  <div class="cart-container">
    <h1>Shopping Cart</h1>

    <div class="cart-content">
      <div class="cart-items">
        <?php if (!isset($_SESSION["user_id"])): ?>
          <p>Je moet inloggen om je winkelmandje te zien. <a href="login.php">Login</a></p>

        <?php elseif (count($items) === 0): ?>
          <p>Je winkelmandje is leeg.</p>

        <?php else: ?>
          <?php foreach ($items as $item): ?>
            <?php $lineTotal = (float)$item["price"] * (int)$item["quantity"]; ?>

            <?php
              $img = $item["image_url"] ?? "";
              if ($img !== "" && strpos($img, "images/") === 0) {
                $img = "../" . $img;
              }
            ?>

            <div class="cart-item">
              <img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($item["name"]) ?>" class="cart-item-image">

              <div class="cart-item-details">
                <h3><?= htmlspecialchars($item["name"]) ?></h3>
                <p class="item-price">€<?= number_format((float)$item["price"], 2, ".", "") ?></p>
              </div>

              <div class="cart-item-quantity">
                <span><?= (int)$item["quantity"] ?>x</span>
              </div>

              <div class="cart-item-total">
                €<?= number_format($lineTotal, 2, ".", "") ?>
              </div>

              <form method="POST" action="remove-from-cart.php" style="display:inline;">
                <input type="hidden" name="cart_item_id" value="<?= (int)$item["cart_item_id"] ?>">
                <button type="submit" class="remove-btn" aria-label="Remove item">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                </button>
              </form>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="cart-summary">
        <h2>Order Summary</h2>

        <div class="summary-row">
          <span>Subtotal</span>
          <span>€<?= number_format($subtotal, 2, ".", "") ?></span>
        </div>

        <div class="summary-row">
          <span>Shipping</span>
          <span>FREE</span>
        </div>

        <div class="summary-row">
          <span>Tax</span>
          <span>€<?= number_format($tax, 2, ".", "") ?></span>
        </div>

        <div class="summary-divider"></div>

        <div class="summary-row total">
          <span>Total</span>
          <span>€<?= number_format($total, 2, ".", "") ?></span>
        </div>

        <button class="checkout-btn">Proceed to Checkout</button>
        <a href="../index.php" class="continue-shopping">Continue Shopping</a>
      </div>
    </div>
  </div>
</body>
</html>
