<?php


session_start();


require_once __DIR__ . "/../includes/db.php";
require_once __DIR__ . "/../includes/UserRepository.php";
require_once __DIR__ . "/../includes/RegisterService.php";

$userRepo = new UserRepository($pdo);
$service = new RegisterService($userRepo);

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";

  $result = $service->register($name, $email, $password);

  if ($result === "SUCCESS") {
    $success = "Account aangemaakt!";
  } else {
    $error = $result;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Buchan</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/register.css">
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

    <div class="register-container">
        <div class="register-box">
            <h1>Create Account</h1>
            <p class="register-subtitle">Join Buchan today</p>
            
            <?php if ($error): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <?php if ($success): ?>
              <p style="color:green;"><?= htmlspecialchars($success) ?></p>
            <?php endif; ?>     
            <form class="register-form" method="POST" action="">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password" required>
                </div>

                <button type="submit" class="register-btn">Create Account</button>
            </form>

            <p class="login-link">
                Already have an account? <a href="login.php">Login</a>
            </p>
        </div>
    </div>

</body>
</html>