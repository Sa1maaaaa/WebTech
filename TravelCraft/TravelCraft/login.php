<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email !== '' && $password !== '') {
        $stmt = $pdo->prepare("SELECT id, first_name, password_hash FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['first_name'];

            header('Location: index.php');
            exit;
        } else {
            $message = '<div class="alert alert-danger">Ungültige E-Mail oder falsches Passwort.</div>';
        }
    } else {
        $message = '<div class="alert alert-warning">Bitte alle Felder ausfüllen.</div>';
    }
}

include 'includes/header.php';
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="feature-card">
                <h2 class="mb-4">Login</h2>

                <?= $message ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label class="form-label">E-Mail</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Passwort</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Einloggen</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>