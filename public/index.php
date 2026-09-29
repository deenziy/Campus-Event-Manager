<?php require 'auth_check.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Event Manager (PHP)</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-light bg-white border-bottom">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Campus Event Manager</span>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted small"><?= htmlspecialchars($_SESSION['user_email']) ?></span>
                <a href="logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">

        <div class="text-center mb-5">
            <h1>Campus Event Manager</h1>
            <p class="text-muted">Manage campus events easily (PHP + Firebase Realtime Database)</p>
        </div>

        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h4 class="mb-4">Add New Event</h4>

                <form action="insert.php" method="POST">

                    <div class="mb-3">
                        <label for="namaEvent" class="form-label">Event Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="namaEvent"
                            name="namaEvent"
                            placeholder="e.g. Seminar AI"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Category</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">Choose category</option>
                            <option value="Seminar">Seminar</option>
                            <option value="Workshop">Workshop</option>
                            <option value="Competition">Competition</option>
                            <option value="Organization">Organization</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Date</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Location</label>
                        <input
                            type="text"
                            class="form-control"
                            id="lokasi"
                            name="lokasi"
                            placeholder="e.g. UC Hall"
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
                            placeholder="e.g. HIMATIKA"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">+ Add Event</button>
                </form>
            </div>
        </div>

        <div class="text-center">
            <a href="view_data.php" class="btn btn-outline-primary">Lihat Semua Event</a>
        </div>

    </div>

</body>
</html>
