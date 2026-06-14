<?php include 'views/layout/header.php'; ?>
<h2>Tambah Data Sensor</h2>
<?php if(isset($error)): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>

<form action="index.php?page=sensor&action=create" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Lokasi / Area:</label>
        <input type="text" name="location_name" required>
    </div>
    <div class="form-group">
        <label>Ketinggian Air (cm):</label>
        <input type="number" name="water_level" required>
        <small style="color:#666;">Status (Aman/Siaga/Bahaya) ditentukan otomatis.</small>
    </div>
    <div class="form-group">
        <label>Foto Kondisi (Opsional, JPG/PNG):</label>
        <input type="file" name="photo" accept="image/*">
    </div>
    <button type="submit" class="btn btn-success">Simpan Data</button>
    <a href="index.php?page=sensor&action=index" class="btn" style="background:#7f8c8d;">Batal</a>
</form>
<?php include 'views/layout/footer.php'; ?>