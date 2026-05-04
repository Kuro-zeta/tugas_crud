<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_siswa = trim($_POST['nama_siswa']);
    $kelas      = trim($_POST['kelas']);
    $tanggal    = $_POST['tanggal'];
    $status     = $_POST['status'];
}
?>