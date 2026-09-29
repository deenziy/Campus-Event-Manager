<?php
require 'firebase_config.php';

$errorMsg = null;
$successMsg = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $auth->createUser([
            'email'         => $email,
            'password'      => $password,
            'displayName'   => $name,
        ]);

        $successMsg = "Registrasi berhasil! Silakan login.";
    } catch (\Kreait\Firebase\Exception\Auth\EmailExists $e) {
        $errorMsg = "Email sudah terdaftar. Silakan login.";
    } catch (Exception $e) {
        $errorMsg = "Registrasi gagal: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
            <p class="text-muted">Buat akun baru</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <?php if ($errorMsg): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($errorMsg) ?></div>
                <?php endif; ?>

                <?php if ($successMsg): ?>
                    <div class="alert alert-success">
                        <?= htmlspecialchars($successMsg) ?>
                        <a href="login.php" class="alert-link">Login sekarang</a>
                    </div>
                <?php else: ?>

                <form method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            minlength="6"
                            required
                        >
                        <div class="form-text">Minimal 6 karakter.</div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>

                <?php endif; ?>

                <p class="text-center mt-3 mb-0">
                    Sudah punya akun? <a href="login.php">Login di sini</a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
