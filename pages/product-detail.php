<?php

$products = [
    1 => [
        'name' => 'Buchan Cheetah Fleece',
        'price' => '249.00',
        'image' => '../images/Item1.png',
        'description' => 'Stay warm and stylish with our premium Cheetah Fleece. Made from high-quality materials for ultimate comfort.',
        'sizes' => ['S', 'M', 'L', 'XL'],
        'badge' => 'NEW'
    ],
    2 => [
        'name' => 'Reversible Buchan Fleece - Red',
        'price' => '100.00',
        'image' => '../images/Item2.png',
        'description' => 'Two looks in one! This reversible fleece offers versatility and comfort for any occasion.',
        'sizes' => ['S', 'M', 'L', 'XL'],
        'badge' => ''
    ],
    3 => [
        'name' => 'Star Striped longsleeve',
        'price' => '50.00',
        'image' => '../images/Item3.png',
        'description' => 'Classic striped design meets modern comfort. Perfect for casual everyday wear.',
        'sizes' => ['S', 'M', 'L', 'XL'],
        'badge' => 'SALE'
    ],
    4 => [
        'name' => 'Buchan Cow hoodie',
        'price' => '70.00',
        'image' => '../images/Item4.png',
        'description' => 'Unique cow print design on a comfortable premium hoodie. Stand out from the crowd.',
        'sizes' => ['S', 'M', 'L', 'XL'],
        'badge' => ''
    ],
    5 => [
        'name' => 'Buchan Zip-up Hoodie',
        'price' => '99.00',
        'image' => '../images/Item5.png',
        'description' => 'Premium zip-up hoodie with perfect fit and premium quality materials.',
        'sizes' => ['S', 'M', 'L', 'XL'],
        'badge' => ''
    ],
    6 => [
        'name' => 'Buchan Cow pants',
        'price' => '80.00',
        'image' => '../images/Item6.png',
        'description' => 'Matching cow print pants to complete your unique style.',
        'sizes' => ['28', '30', '32', '34', '36'],
        'badge' => ''
    ],
    7 => [
        'name' => 'Buchan Black Jeans',
        'price' => '80.00',
        'image' => '../images/Item7.png',
        'description' => 'Classic black jeans with modern fit. A wardrobe essential.',
        'sizes' => ['28', '30', '32', '34', '36'],
        'badge' => ''
    ],
    8 => [
        'name' => 'Buchan Bleu Jeans',
        'price' => '80.00',
        'image' => '../images/Item8.png',
        'description' => 'Traditional blue denim with premium quality and comfortable fit.',
        'sizes' => ['28', '30', '32', '34', '36'],
        'badge' => ''
    ]
];


$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

if (!isset($products[$productId])) {
    header('Location: ../index.php');
    exit;
}

$product = $products[$productId];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $product['name']; ?> - Buchan</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/product.css">
</head>
<body>
    <nav>
        <div class="top-bar">
            Free shipping: from €150 in Europe | from €200 worldwide
        </div>

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
                <a href="login.php" class="icon-btn" aria-label="Account">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
                <a href="register.php"><p>REGISTER</p></a>
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
                <?php if ($product['badge']): ?>
                    <div class="product-badge"><?php echo $product['badge']; ?></div>
                <?php endif; ?>
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>

           
            <div class="product-info-section">
                <h1><?php echo $product['name']; ?></h1>
                <div class="product-price">€<?php echo $product['price']; ?></div>
                
                <p class="product-description">
                    <?php echo $product['description']; ?>
                </p>

                <form class="product-form">
                    <div class="form-group">
                        <label>Size</label>
                        <div class="size-options">
                            <?php foreach ($product['sizes'] as $size): ?>
                                <label class="size-option">
                                    <input type="radio" name="size" value="<?php echo $size; ?>" required>
                                    <span><?php echo $size; ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <div class="quantity-selector">
                            <button type="button" class="qty-btn minus">-</button>
                            <input type="number" value="1" min="1" class="qty-input">
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
    </div>

    <script src="../scripts/product.js"></script>
</body>
</html>