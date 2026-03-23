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

$stmt = $pdo->prepare("SELECT * FROM trips WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<div class="container py-5">
    <h1 class="section-title mb-4">Meine Reisen</h1>
    <?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>
<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

    <?php if (empty($trips)): ?>
        <div class="alert alert-info">Du hast noch keine Reisen gespeichert.</div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($trips as $trip): ?>
                <div class="col-lg-4">
                    <div class="feature-card">
                    <h4><?= htmlspecialchars($trip['destination']) ?></h4>

<p><strong>Unterkunft:</strong> <?= htmlspecialchars($trip['accommodation']) ?></p>
<!-- <p><strong>Extras:</strong> <?= htmlspecialchars($trip['extras']) ?: 'Keine' ?></p> -->
<p><strong>Tage:</strong> <?= htmlspecialchars($trip['travel_days']) ?></p>
<p><strong>Preis:</strong> <?= htmlspecialchars($trip['total_price']) ?> €</p>

<?php if (!empty($trip['coupon_code'])): ?>
    <p><strong>Gutschein:</strong> <?= htmlspecialchars($trip['coupon_code']) ?></p>
<?php endif; ?>

<a
    href="delete_trip.php?id=<?= $trip['id'] ?>"
    class="btn btn-danger btn-sm mt-2"
    onclick="return confirm('Möchtest du diese Reise wirklich löschen?');"
>
    Reise löschen
</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>