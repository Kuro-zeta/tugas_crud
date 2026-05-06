<?php
require_once 'config/koneksi.php';

if (isset($_POST['tambah'])) {

    $nama    = $_POST['nama_siswa'] ?? '';
    $kelas   = $_POST['kelas'] ?? '';
    $tanggal = $_POST['tanggal'] ?? '';
    $status  = $_POST['status'] ?? '';

    if ($nama && $kelas && $tanggal && $status) {

        $stmt = $conn->prepare("INSERT INTO tb_absensi (nama_siswa, kelas, tanggal, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $kelas, $tanggal, $status);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
    }
}

$result = $conn->query("SELECT * FROM tb_absensi ORDER BY id DESC");
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
    margin: 0;
    padding: 20px;
}

h2 {
    text-align: center;
    margin: 15px 0;
}

/* BUTTON TAMBAH */
.top-link {
    display: block;
    width: fit-content;
    margin: 0 auto 20px;
    padding: 8px 14px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
}

.top-link:hover {
    background: #218838;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
    background: #007bff;
    color: white;
}

tr:nth-child(even) {
    background: #f8f8f8;
}

/* BUTTON */
.btn-edit, .btn-hapus {
    display: inline-block;
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
}

.btn-edit {
    background: #007bff;
}

.btn-edit:hover {
    background: #0056b3;
}

.btn-hapus {
    background: red;
}

.btn-hapus:hover {
    background: darkred;
}
</style>
</head>

<body>

<h2>Data Absensi XI PPLG 3</h2>

<a href="tambah.php" class="top-link">+ Tambah Data</a>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php $no = 1; ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['id']; ?></td>
            <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
            <td><?= htmlspecialchars($row['kelas']); ?></td>
            <td><?= htmlspecialchars($row['tanggal']); ?></td>
            <td><?= htmlspecialchars($row['status']); ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn-edit">Edit</a>
                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn-hapus"
                   onclick="return confirm('Yakin ingin hapus?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="7">Tidak ada data</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

</body>
</html>