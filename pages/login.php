<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Buchan</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/login.css">
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
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </div>
                <a href="login.html" class="icon-btn" aria-label="Account">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                </a>
                <a href="register.html"><p>REGISTER</p></a>
                <a href="../pages/cart.php" class="icon-btn" aria-label="Cart">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1"></circle>
                        <circle cx="20" cy="21" r="1"></circle>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                    </svg>
                </a>
            </div>
        </header>
    </nav>

    <div class="login-container">
        <div class="login-box">
            <h1>Welcome Back</h1>
            <p class="login-subtitle">Login to your Buchan account</p>

            <form class="login-form" action="login-process.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <button type="submit" class="login-btn">Login</button>
            </form>

            <p class="signup-link">
                Don't have an account? <a href="register.php">Sign up</a>
            </p>
        </div>
    </div>

</body>
</html>