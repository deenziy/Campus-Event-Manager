<?php
require 'firebase_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaEvent     = $_POST['namaEvent'];
    $kategori      = $_POST['kategori'];
    $tanggal       = $_POST['tanggal'];
    $lokasi        = $_POST['lokasi'];
    $penyelenggara = $_POST['penyelenggara'];

    $database->getReference('events')->push([
        'namaEvent'     => $namaEvent,
        'kategori'      => $kategori,
        'tanggal'       => $tanggal,
        'lokasi'        => $lokasi,
        'penyelenggara' => $penyelenggara,
    ]);

    // Redirect balik ke halaman list biar user langsung lihat hasilnya
    header("Location: view_data.php");
    exit;
}
?>
