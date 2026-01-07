<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buchan</title>
    <link rel="stylesheet" href="styles/styles.css">
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
    
    <a href="/" class="logo">Buchan</a>
    
    <nav class="menu">
      <a href="/">HOME</a>
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
      <a href="pages/login.php" class="icon-btn" aria-label="Account">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
      </a>

       <a href="pages/register.php"><p>REGISTER</p></a>
       
      <a href="pages/cart.php" class="icon-btn" aria-label="Cart">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <circle cx="9" cy="21" r="1"></circle>
          <circle cx="20" cy="21" r="1"></circle>
          <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
        </svg>
      </a>
    </div>
  </header>
</nav>

<section class="hero-banner">
  <img src="images/banner.png" alt="Banner">
  <a href="#" class="shop-all-btn">SHOP ALL</a>
</section>

<section class="products-section">
  <h2>Featured Products</h2>

  <div class="category-filter">
    <button class="category-btn active" data-category="all">All Products</button>
    <button class="category-btn" data-category="jackets">Jackets</button>
    <button class="category-btn" data-category="shirts">Shirts</button>
    <button class="category-btn" data-category="pants">Pants</button>
  </div>
  
  <div class="products-grid">
   
    <a href="pages/product-detail.php?id=1" class="product-card" data-category="jackets">
      <div class="product-image">
        <div class="product-badge">NEW</div>
        <img src="images/Item1.png" alt="Jacket">
      </div>
      <div class="product-info">
        <div class="product-name">Buchan Cheetah Fleece</div>
        <div class="product-price">€249.00</div>
      </div>
    </a>

   
    <a href="pages/product-detail.php?id=2" class="product-card" data-category="jackets">
      <div class="product-image">
        <img src="images/Item2.png" alt="Buchan Fleece">
      </div>
      <div class="product-info">
        <div class="product-name">Reversible Buchan Fleece - Red</div>
        <div class="product-price">€100.00</div>
        
      </div>
    </a>

   
    <a href="pages/product-detail.php?id=3" class="product-card" data-category="shirts">
      <div class="product-image">
        <div class="product-badge">SALE</div>
        <img src="images/Item3.png" alt="Striped longsleeve">
      </div>
      <div class="product-info">
        <div class="product-name">Star Striped longsleeve</div>
        <div class="product-price">€50.00</div>
     
      </div>
    </a>

   
    <a href="pages/product-detail.php?id=4" class="product-card" data-category="shirts">
      <div class="product-image">
        <img src="images/Item4.png" alt="Buchan Cow hoodie">
      </div>
      <div class="product-info">
        <div class="product-name">Buchan Cow hoodie</div>
        <div class="product-price">€70.00</div>
      </div>
    </a>


       <a href="pages/product-detail.php?id=5" class="product-card" data-category="shirts">
      <div class="product-image">
        <img src="images/Item5.png" alt="Buchan Zip-up Hoodie">
      </div>
      <div class="product-info">
        <div class="product-name">Buchan Zip-up Hoodie</div>
        <div class="product-price">€99.00</div>
      </div>
    </a>



       <a href="pages/product-detail.php?id=6" class="product-card" data-category="pants">
      <div class="product-image">
        <img src="images/Item6.png" alt="Buchen Cow pants">
      </div>
      <div class="product-info">
        <div class="product-name">Buchen Cow pants</div>
        <div class="product-price">€80.00</div>
      </div>
    </a>


       <a href="pages/product-detail.php?id=7" class="product-card" data-category="pants">
      <div class="product-image">
        <img src="images/Item7.png" alt="Buchan Black Jeans">
      </div>
      <div class="product-info">
        <div class="product-name">Buchan Black Jeans</div>
        <div class="product-price">€80.00</div>
      </div>
    </a>


       <a href="pages/product-detail.php?id=8" class="product-card" data-category="pants">
      <div class="product-image">
        <img src="images/Item8.png" alt="Buchan Bleu Jeans">
      </div>
      <div class="product-info">
        <div class="product-name">Buchan Bleu Jeans</div>
        <div class="product-price">€80.00</div>
      </div>
    </a>
  </div>
</section>

</body>
</html>