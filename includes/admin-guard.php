<?php
if (!isset($_SESSION["user_id"])) {
  header("Location: /onlinewebshop/pages/login.php");
  exit;
}

if (($_SESSION["user_role"] ?? "user") !== "admin") {
  header("Location: /onlinewebshop/index.php");
  exit;
}
?>