<?php
require 'firebase_config.php';

// Ambil semua data dari node "events"
$events = $database->getReference('events')->getValue();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event List</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container py-5">

        <div class="text-center mb-5">
            <h1>Event List</h1>
            <p class="text-muted">Semua event yang tersimpan di Firebase Realtime Database</p>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Organizer</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($events): ?>
                                <?php foreach ($events as $id => $ev): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($ev['namaEvent']) ?></td>
                                        <td><span class="badge bg-secondary"><?= htmlspecialchars($ev['kategori']) ?></span></td>
                                        <td><?= htmlspecialchars($ev['tanggal']) ?></td>
                                        <td><?= htmlspecialchars($ev['lokasi']) ?></td>
                                        <td><?= htmlspecialchars($ev['penyelenggara']) ?></td>
                                        <td class="text-end">
                                            <a href="update_data.php?id=<?= urlencode($id) ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a
                                                href="delete_data.php?id=<?= urlencode($id) ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Yakin ingin menghapus event ini?')"
                                            >Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center text-muted">Belum ada event.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">+ Tambah Event Baru</a>
        </div>

    </div>

</body>
</html>
