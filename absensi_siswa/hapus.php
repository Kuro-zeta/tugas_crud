<?php
require_once 'config/koneksi.php';

// Ambil & validasi ID
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);

// Cek ID valid
if (!$id) {
    header("Location: index.php");
    exit;
}

// Prepare statement (aman)
$stmt = $conn->prepare("DELETE FROM tb_absensi WHERE id = ?");
$stmt->bind_param("i", $id);

// Eksekusi
$stmt->execute();

// Tutup statement
$stmt->close();

// Redirect balik
header("Location: index.php");
exit;