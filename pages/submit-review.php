<?php

$host = 'localhost';
$dbname = 'buchan';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = (int)$_POST['product_id'];
    $reviewer_name = htmlspecialchars($_POST['reviewer_name']);
    $rating = (int)$_POST['rating'];
    $review_text = htmlspecialchars($_POST['review_text']);
  
    $sql = "INSERT INTO reviews (product_id, reviewer_name, rating, review_text) 
            VALUES (:product_id, :reviewer_name, :rating, :review_text)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':product_id' => $product_id,
        ':reviewer_name' => $reviewer_name,
        ':rating' => $rating,
        ':review_text' => $review_text
    ]);
    
    
    header("Location: product-detail.php?id=" . $product_id);
    exit;
}
?>