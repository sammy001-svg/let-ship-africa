<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

if (!empty($_SESSION['admin_id'])) {
    header('Location: ' . SITE_URL . '/admin/dashboard.php');
    exit;
}

$error = null;

// Basic lockout after repeated failed attempts to slow down brute force.
$attempts = $_SESSION['login_attempts'] ?? 0;
$lockedUntil = $_SESSION['login_locked_until'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (time() < $lockedUntil) {
        $error = 'Too many failed attempts. Please try again in a minute.';
    } elseif (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = 'Your session expired. Please try again.';
    } else {
        $username = clean_input($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        $stmt = getDb()->prepare('SELECT id, username, password_hash, full_name FROM admin_users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'];
            unset($_SESSION['login_attempts'], $_SESSION['login_locked_until']);
            header('Location: ' . SITE_URL . '/admin/dashboard.php');
            exit;
        }

        $attempts++;
        $_SESSION['login_attempts'] = $attempts;
        if ($attempts >= 5) {
            $_SESSION['login_locked_until'] = time() + 60;
            $_SESSION['login_attempts'] = 0;
        }
        $error = 'Invalid username or password.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | <?= e(SITE_NAME) ?></title>
    <link rel="icon" type="image/png" href="<?= e(SITE_URL) ?>/assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= e(SITE_URL) ?>/assets/css/style.css">
</head>
<body class="bg-lsa-navy min-vh-100 d-flex align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="lsa-card p-4 p-md-5">
                <h1 class="h3 fw-bold text-center mb-1">Let Ship Africa <span class="text-lsa-accent">Admin</span></h1>
                <p class="text-muted text-center mb-4">Sign in to view submissions</p>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= e($error) ?></div>
                <?php endif; ?>
                <form method="post" novalidate>
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-lsa-accent w-100 fw-semibold">Log In</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
