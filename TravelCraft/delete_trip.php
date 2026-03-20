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

if (isset($_GET['id'])) {
    $tripId = (int) $_GET['id'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("DELETE FROM trips WHERE id = ? AND user_id = ?");
    $stmt->execute([$tripId, $userId]);

    $_SESSION['success_message'] = 'Die Reise wurde erfolgreich gelöscht.';
}

header('Location: my_trips.php');
exit;