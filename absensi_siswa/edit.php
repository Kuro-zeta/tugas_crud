<?php
require_once 'config/koneksi.php';

// Ambil ID
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: index.php");
    exit;
}

// Ambil data berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM tb_absensi WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    header("Location: index.php");
    exit;
}

// Proses update
if (isset($_POST['update'])) {

    $nama    = $_POST['nama_siswa'];
    $kelas   = $_POST['kelas'];
    $tanggal = $_POST['tanggal'];
    $status  = $_POST['status'];

    $update = $conn->prepare("UPDATE tb_absensi SET nama_siswa=?, kelas=?, tanggal=?, status=? WHERE id=?");
    $update->bind_param("ssssi", $nama, $kelas, $tanggal, $status, $id);

    if ($update->execute()) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $update->error;
    }

    $update->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
         select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 12px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .btn-kembali {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #555;
            font-size: 13px;
        }

        .btn-kembali:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h2>Edit Data Absensi</h2>

<div class="form-container">
    <form method="POST">

        <input type="text" name="nama_siswa" value="<?= htmlspecialchars($data['nama_siswa']); ?>" required>

        <input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>" required>

        <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required>

        <select name="status" required>
            <option value="Hadir" <?= $data['status']=='Hadir'?'selected':''; ?>>Hadir</option>
            <option value="Izin" <?= $data['status']=='Izin'?'selected':''; ?>>Izin</option>
            <option value="Sakit" <?= $data['status']=='Sakit'?'selected':''; ?>>Sakit</option>
            <option value="Alpha" <?= $data['status']=='Alpha'?'selected':''; ?>>Alpha</option>
        </select>

        <button type="submit" name="update">Update</button>

        <a href="index.php" class="btn-kembali">← Kembali</a>

    </form>
</div>

</body>
</html>