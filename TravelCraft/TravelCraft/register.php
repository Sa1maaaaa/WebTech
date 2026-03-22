<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($firstName !== '' && $lastName !== '' && $address !== '' && $email !== '' && $password !== '') {
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $checkStmt->execute([$email]);

        if ($checkStmt->fetch()) {
            $message = '<div class="alert alert-danger">Diese E-Mail ist bereits registriert.</div>';
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (first_name, last_name, address, email, password_hash)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$firstName, $lastName, $address, $email, $passwordHash]);

            $message = '<div class="alert alert-success">Registrierung erfolgreich. Du kannst dich jetzt einloggen.</div>';
        }
    } else {
        $message = '<div class="alert alert-warning">Bitte fülle alle Felder aus.</div>';
    }
}

include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="feature-card">
                <h2 class="mb-4">Registrieren</h2>

                <?= $message ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">Vorname</label>
                        <input type="text" name="first_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nachname</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Adresse</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">E-Mail</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Passwort</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Jetzt registrieren</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>