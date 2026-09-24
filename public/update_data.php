<?php
require 'firebase_config.php';

$id = $_GET['id'];
$eventRef = $database->getReference("events/$id");
$event = $eventRef->getValue();

if (!$event) {
    die("Event tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventRef->update([
        'namaEvent'     => $_POST['namaEvent'],
        'kategori'      => $_POST['kategori'],
        'tanggal'       => $_POST['tanggal'],
        'lokasi'        => $_POST['lokasi'],
        'penyelenggara' => $_POST['penyelenggara'],
    ]);

    header("Location: view_data.php");
    exit;
}

$kategoriOptions = ['Seminar', 'Workshop', 'Competition', 'Organization', 'Other'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container py-5">

        <div class="text-center mb-5">
            <h1>Edit Event</h1>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST">

                    <div class="mb-3">
                        <label for="namaEvent" class="form-label">Event Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="namaEvent"
                            name="namaEvent"
                            value="<?= htmlspecialchars($event['namaEvent']) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Category</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <?php foreach ($kategoriOptions as $opt): ?>
                                <option value="<?= $opt ?>" <?= $event['kategori'] === $opt ? 'selected' : '' ?>>
                                    <?= $opt ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Date</label>
                        <input
                            type="date"
                            class="form-control"
                            id="tanggal"
                            name="tanggal"
                            value="<?= htmlspecialchars($event['tanggal']) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Location</label>
                        <input
                            type="text"
                            class="form-control"
                            id="lokasi"
                            name="lokasi"
                            value="<?= htmlspecialchars($event['lokasi']) ?>"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="penyelenggara" class="form-label">Organizer</label>
                        <input
                            type="text"
                            class="form-control"
                            id="penyelenggara"
                            name="penyelenggara"
                            value="<?= htmlspecialchars($event['penyelenggara']) ?>"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Update Event</button>
                    <a href="view_data.php" class="btn btn-outline-secondary">Cancel</a>
                </form>
            </div>
        </div>

    </div>

</body>
</html>
