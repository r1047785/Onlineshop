<?php
session_start();
require_once __DIR__ . "/../includes/db.php";



$productId = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

if ($productId <= 0) {
  header("Location: ../index.php");
  exit;
}


$stmt = $pdo->prepare("SELECT id, name, description, price, image_url FROM products WHERE id = ? LIMIT 1");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
  header("Location: ../index.php");
  exit;
}

$sizes = ["S", "M", "L", "XL"];


$reviews = [];
try {
  $stmt = $pdo->prepare("SELECT * FROM reviews WHERE product_id = :product_id ORDER BY created_at DESC");
  $stmt->execute([":product_id" => $productId]);
  $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $reviews = [];
}


$imageUrl = $product["image_url"] ?? "";
if ($imageUrl !== "" && strpos($imageUrl, "images/") === 0) {
  $imageUrl = "../" . $imageUrl;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($product["name"]) ?> - Buchan</title>
  <link rel="stylesheet" href="../styles/styles.css">
  <link rel="stylesheet" href="../styles/product.css">
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

  <div class="product-container">
    <div class="product-layout">

      <div class="product-image-section">
        <img src="<?= htmlspecialchars($imageUrl) ?>" alt="<?= htmlspecialchars($product["name"]) ?>">
      </div>

      <div class="product-info-section">
        <h1><?= htmlspecialchars($product["name"]) ?></h1>
        <div class="product-price">€<?= number_format((float)$product["price"], 2, ".", "") ?></div>

        <p class="product-description">
          <?= nl2br(htmlspecialchars($product["description"] ?? "")) ?>
        </p>

        <form class="product-form" method="POST" action="add-to-cart.php">
          <input type="hidden" name="product_id" value="<?= (int)$productId ?>">

          <div class="form-group">
            <label>Size</label>
            <div class="size-options">
              <?php foreach ($sizes as $size): ?>
                <label class="size-option">
                  <input type="radio" name="size" value="<?= htmlspecialchars($size) ?>" required>
                  <span><?= htmlspecialchars($size) ?></span>
                </label>
              <?php endforeach; ?>
            </div>
          </div>

          <div class="form-group">
            <label>Quantity</label>
            <div class="quantity-selector">
              <button type="button" class="qty-btn minus">-</button>
              <input type="number" name="quantity" value="1" min="1" class="qty-input">
              <button type="button" class="qty-btn plus">+</button>
            </div>
          </div>

          <button type="submit" class="add-to-cart-btn">Add to Cart</button>
        </form>

        <div class="product-details">
          <h3>Product Details</h3>
          <ul>
            <li>Premium quality materials</li>
            <li>Comfortable fit</li>
            <li>Machine washable</li>
            <li>Free shipping on orders over €150</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="reviews-section">
      <h2>Customer Reviews</h2>

      <div class="reviews-list">
        <?php if (count($reviews) > 0): ?>
          <?php foreach ($reviews as $review): ?>
            <div class="review-item">
              <div class="review-header">
                <div class="review-author">
                  <strong><?= htmlspecialchars($review["reviewer_name"] ?? "Anonymous") ?></strong>
                  <div class="review-stars">
                    <?php
                      $rating = (int)($review["rating"] ?? 0);
                      for ($i = 0; $i < 5; $i++) echo ($i < $rating) ? "★" : "☆";
                    ?>
                  </div>
                </div>
                <span class="review-date">
                  <?php
                    if (!empty($review["created_at"])) {
                      $date = new DateTime($review["created_at"]);
                      echo $date->format("M d, Y");
                    }
                  ?>
                </span>
              </div>
              <p class="review-text"><?= htmlspecialchars($review["review_text"] ?? "") ?></p>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p style="color:#666; text-align:center; padding:20px;">No reviews yet. Be the first to review this product!</p>
        <?php endif; ?>
      </div>

      <div class="add-review">
        <h3>Write a Review</h3>
        <form class="review-form" action="submit-review.php" method="POST">
          <input type="hidden" name="product_id" value="<?= (int)$productId ?>">

          <div class="form-group">
            <label>Your Name</label>
            <input type="text" name="reviewer_name" placeholder="Enter your name" required>
          </div>

          <div class="form-group">
            <label>Rating</label>
            <div class="star-rating">
              <input type="radio" name="rating" value="5" id="star5" required><label for="star5">★</label>
              <input type="radio" name="rating" value="4" id="star4"><label for="star4">★</label>
              <input type="radio" name="rating" value="3" id="star3"><label for="star3">★</label>
              <input type="radio" name="rating" value="2" id="star2"><label for="star2">★</label>
              <input type="radio" name="rating" value="1" id="star1"><label for="star1">★</label>
            </div>
          </div>

          <div class="form-group">
            <label>Your Review</label>
            <textarea name="review_text" rows="4" placeholder="Share your experience..." required></textarea>
          </div>

          <button type="submit" class="submit-review-btn">Submit Review</button>
        </form>
      </div>
    </div>
  </div>

  <script src="/onlinewebshop/scripts/product.js"></script>
</body>
</html>
