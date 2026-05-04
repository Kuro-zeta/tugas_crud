<?php
require_once 'config/koneksi.php';

// Proses tambah data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_siswa'];
    $kelas = $_POST['kelas'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    // Query sesuai kolom database
    $insert = "INSERT INTO tb_absensi (nama_siswa, kelas, tanggal, status) 
               VALUES ('$nama', '$kelas', '$tanggal', '$status')";

    if ($conn->query($insert) === TRUE) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data
$query = "SELECT * FROM tb_absensi ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        .form-container {
            width: 400px;
            margin: 0 auto 20px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .no-data {
            padding: 20px;
        }
    </style>
</head>
<body>

<h2>Tambah Data Absensi</h2>

<div class="form-container">
    <form method="POST">
        <input type="text" name="nama_siswa" placeholder="Nama" required>
        <input type="text" name="kelas" placeholder="Kelas" required>
        <input type="date" name="tanggal" required>

        <select name="status" required>
            <option value="">-- Pilih Status --</option>
            <option value="Hadir">Hadir</option>
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
            <option value="Alpha">Alpha</option>
        </select>

        <button type="submit" name="tambah">Tambah</button>
    </form>
</div>

<h2>Data Absensi</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
                    <td><?= htmlspecialchars($row['kelas']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                    <td><?= htmlspecialchars($row['status']); ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-data">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>