<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_SESSION['user_id'];
    $destination = $_POST['destination'] ?? '';
    $accommodation = $_POST['accommodation'] ?? '';
    $extras = isset($_POST['extras']) ? implode(', ', $_POST['extras']) : '';
    $travelDays = $_POST['travel_days'] ?? 1;
    $couponCode = $_POST['coupon_code'] ?? '';
    $totalPrice = $_POST['total_price'] ?? 0;

    $stmt = $pdo->prepare("
        INSERT INTO trips 
        (user_id, destination, accommodation, extras, travel_days, coupon_code, total_price)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $userId,
        $destination,
        $accommodation,
        $extras,
        $travelDays,
        $couponCode,
        $totalPrice
    ]);

    $_SESSION['success_message'] = 'Deine Reise wurde erfolgreich gespeichert.';
header('Location: my_trips.php');
exit;
?>