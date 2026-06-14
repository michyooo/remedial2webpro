<?php include 'views/layout/header.php'; ?>
<h2>Edit Data Sensor</h2>
<?php if(isset($error)): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>

<form action="index.php?page=sensor&action=edit&id=<?= $sensors['id'] ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label>Nama Lokasi / Area:</label>
        <input type="text" name="location_name" value="<?= htmlspecialchars($sensors['location_name']) ?>" required>
    </div>
    <div class="form-group">
        <label>Ketinggian Air Terbaru (cm):</label>
        <input type="number" name="water_level" value="<?= $sensors['water_level_cm'] ?>" required>
    </div>
    <div class="form-group">
        <label>Update Foto Kondisi (Opsional):</label>
        <input type="file" name="photo" accept="image/*">
        <?php if($sensors['latest_photo']): ?>
            <p><small>Foto saat ini: <a href="<?= $sensors['latest_photo'] ?>" target="_blank">Lihat</a>.</small></p>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success">Update Data</button>
    <a href="index.php?page=sensor&action=index" class="btn" style="background:#7f8c8d;">Batal</a>
</form>
<?php include 'views/layout/footer.php'; ?>