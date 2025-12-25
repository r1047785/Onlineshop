<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart - Buchan</title>
    <link rel="stylesheet" href="../styles/styles.css   " />
    <link rel="stylesheet" href="../styles/cart.css" />
  </head>
  <body>
    <nav>
      <div class="top-bar">
        Free shipping: from €150 in Europe | from €200 worldwide
      </div>

      <header class="nav">
        <div class="nav-left">
          <button class="search-btn" aria-label="Search">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.35-4.35"></path>
            </svg>
          </button>
        </div>

        <a href="index.html" class="logo">Buchan</a>

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
            <svg
              width="12"
              height="12"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <polyline points="6 9 12 15 18 9"></polyline>
            </svg>
          </div>
          <a href="/login" class="icon-btn" aria-label="Account">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
              <circle cx="12" cy="7" r="4"></circle>
            </svg>
          </a>
          <a href="#"><p>REGISTER</p></a>
          <a href="cart.html" class="icon-btn" aria-label="Cart">
            <svg
              width="20"
              height="20"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
            >
              <circle cx="9" cy="21" r="1"></circle>
              <circle cx="20" cy="21" r="1"></circle>
              <path
                d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
              ></path>
            </svg>
          </a>
        </div>
      </header>
    </nav>

    <div class="cart-container">
      <h1>Shopping Cart</h1>

      <div class="cart-content">
        <div class="cart-items">
          <div class="cart-item">
            <img
              src="../images/item1.png"
              alt="Buchan Cheetah Fleece"
              class="cart-item-image"
            />
            <div class="cart-item-details">
              <h3>Buchan Cheetah Fleece</h3>
              <p class="item-size">Size: M</p>
              <p class="item-price">€249.00</p>
            </div>
            <div class="cart-item-quantity">
              <button class="qty-btn minus">-</button>
              <input type="number" value="1" min="1" class="qty-input" />
              <button class="qty-btn plus">+</button>
            </div>
            <div class="cart-item-total">€249.00</div>
            <button class="remove-btn" aria-label="Remove item">
              <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>

          <div class="cart-item">
            <img
              src="../images/Item4.png"
              alt="Buchan Cow hoodie"
              class="cart-item-image"
            />
            <div class="cart-item-details">
              <h3>Buchan Cow hoodie</h3>
              <p class="item-size">Size: L</p>
              <p class="item-price">€70.00</p>
            </div>
            <div class="cart-item-quantity">
              <button class="qty-btn minus">-</button>
              <input type="number" value="2" min="1" class="qty-input" />
              <button class="qty-btn plus">+</button>
            </div>
            <div class="cart-item-total">€140.00</div>
            <button class="remove-btn" aria-label="Remove item">
              <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>

          <div class="cart-item">
            <img
              src="../images/item7.png"
              alt="Buchan Black Jeans"
              class="cart-item-image"
            />
            <div class="cart-item-details">
              <h3>Buchan Black Jeans</h3>
              <p class="item-size">Size: 32</p>
              <p class="item-price">€80.00</p>
            </div>
            <div class="cart-item-quantity">
              <button class="qty-btn minus">-</button>
              <input type="number" value="1" min="1" class="qty-input" />
              <button class="qty-btn plus">+</button>
            </div>
            <div class="cart-item-total">€80.00</div>
            <button class="remove-btn" aria-label="Remove item">
              <svg
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
              >
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
            </button>
          </div>
        </div>

        <div class="cart-summary">
          <h2>Order Summary</h2>

          <div class="summary-row">
            <span>Subtotal</span>
            <span>€469.00</span>
          </div>

          <div class="summary-row">
            <span>Shipping</span>
            <span>FREE</span>
          </div>

          <div class="summary-row">
            <span>Tax</span>
            <span>€98.49</span>
          </div>

          <div class="summary-divider"></div>

          <div class="summary-row total">
            <span>Total</span>
            <span>€567.49</span>
          </div>

          <button class="checkout-btn">Proceed to Checkout</button>

          <a href="index.html" class="continue-shopping">Continue Shopping</a>
        </div>
      </div>
    </div>
  </body>
</html>
