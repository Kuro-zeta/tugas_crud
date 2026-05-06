<?php
require_once 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama_siswa = trim($_POST['nama_siswa']);
    $kelas      = $_POST['kelas']; 
    $tanggal    = $_POST['tanggal'];
    $status     = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO tb_absensi (nama_siswa, kelas, tanggal, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama_siswa, $kelas, $tanggal, $status);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Absensi</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: black;
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* FORM */
.form-container {
    max-width: 420px;
    margin: 0 auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

input{
width: 95%;
padding: 10px;
margin-top: 12px;
border: 1px solid #ccc;
border-radius: 6px;
font-size: 14px;
}
select {
  width: 100%;
  padding: 10px;
  margin-top: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
}
button {
    width: 100%;
    padding: 10px;
    margin-top: 12px;
    background: #28a745;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #218838;
}
</style>

</head>
<body>

<h2>Tambah Data Absensi</h2>

<div class="form-container">
    <form method="POST">

        <input type="text" name="nama_siswa" placeholder="Nama Siswa" required>

        <input type="text" name="kelas" placeholder="Kelas" required>

        <input type="date" name="tanggal" required>

        <select name="status" required>
            <option value="">-- Pilih Status --</option>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpha">Alpha</option>
        </select>

        <button type="submit">Tambah</button>

    </form>
</div>

</body>
</html>