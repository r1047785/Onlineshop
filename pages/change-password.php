<?php
session_start();
require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION["user_id"])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  header("Location: account.php");
  exit;
}

$userId = (int)$_SESSION["user_id"];

$current = $_POST["current_password"] ?? "";
$new = $_POST["new_password"] ?? "";
$confirm = $_POST["new_password_confirm"] ?? "";


if ($new === "" || strlen($new) < 4) {
  header("Location: account.php?pw=err");
  exit;
}
if ($new !== $confirm) {
  header("Location: account.php?pw=err");
  exit;
}


$stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ? LIMIT 1");
$stmt->execute([$userId]);
$row = $stmt->fetch();

if (!$row) {
  header("Location: account.php?pw=err");
  exit;
}


if (!password_verify($current, $row["password_hash"])) {
  header("Location: account.php?pw=err");
  exit;
}


$newHash = password_hash($new, PASSWORD_DEFAULT);

$upd = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
$upd->execute([$newHash, $userId]);

header("Location: account.php?pw=ok");
exit;
