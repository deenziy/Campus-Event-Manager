<?php
session_start();
require 'firebase_config.php';

$errorMsg = null;
$logoutMsg = isset($_GET['logged_out']) ? "Kamu berhasil logout." : null;

// Kalau sudah login, langsung lempar ke halaman utama
if (isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $signInResult = $auth->signInWithEmailAndPassword($email, $password);

        $_SESSION['user_email'] = $email;
        $_SESSION['user_uid']   = $signInResult->firebaseUserId();

        header("Location: index.php");
        exit;
    } catch (Exception $e) {
        $errorMsg = "Login gagal. Periksa kembali email dan password kamu.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container py-5" style="max-width: 480px;">

        <div class="text-center mb-4">
            <h1 class="h3">Campus Event Manager</h1>
            <p class="text-muted">Login untuk melanjutkan</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <?php if ($logoutMsg): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($logoutMsg) ?></div>
                <?php endif; ?>

                <?php if ($errorMsg): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errorMsg) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Belum punya akun? <a href="register.php">Register di sini</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
