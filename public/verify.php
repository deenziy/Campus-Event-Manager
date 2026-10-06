<?php
require 'firebase_config.php';

$status = null;
$message = '';

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    try {

        $user = $auth->getUserByEmail($email);

        if ($user->emailVerified) {
            $database->getReference('users/' . md5($email) . '/is_verified')->set(true);

            $status  = 'success';
            $message = 'Email berhasil diverifikasi! Silakan login.';
        } else {
            $status  = 'not_verified';
            $message = 'Email belum diverifikasi. Silakan cek kembali email kamu dan klik link verifikasinya.';
        }
    } catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
        $status  = 'not_found';
        $message = 'Akun dengan email ini tidak ditemukan.';
    } catch (Exception $e) {
        $status  = 'error';
        $message = 'Terjadi kesalahan: ' . $e->getMessage();
    }
} else {
    $status  = 'error';
    $message = 'Parameter email tidak ditemukan pada link verifikasi.';
}

$alertClass = $status === 'success' ? 'alert-success' : 'alert-warning';
$loginLink  = $status === 'success' ? 'login.php?verified=1' : 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>

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
            <p class="text-muted">Verifikasi Email</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body text-center">
                <div class="alert <?= $alertClass ?>"><?= htmlspecialchars($message) ?></div>
                <a href="<?= htmlspecialchars($loginLink) ?>" class="btn btn-primary w-100">Ke Halaman Login</a>
            </div>
        </div>

    </div>

</body>
</html>
