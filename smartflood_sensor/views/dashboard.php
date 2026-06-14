<?php
$totalSensors = count($sensors);
$aman = 0; $siaga = 0; $bahaya = 0;

foreach ($sensors as $s) {
    if ($s['status'] == 'Aman') $aman++;
    if ($s['status'] == 'Siaga') $siaga++;
    if ($s['status'] == 'Bahaya') $bahaya++;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Smart Flood Monitor - Bandung Selatan</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #eef2f3; padding: 20px; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { border-bottom: 2px solid #3498db; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { color: #2c3e50; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .badge { padding: 5px 10px; border-radius: 20px; color: white; font-weight: bold; font-size: 0.85em; }
        .bg-aman { background: #27ae60; }
        .bg-siaga { background: #f39c12; }
        .bg-bahaya { background: #e74c3c; }
        .form-update { margin-top: 30px; padding: 20px; background: #f8f9fa; border-left: 4px solid #3498db; border-radius: 4px; }
        .stats-box { display: flex; gap: 15px; margin-bottom: 20px; }
        .stat-card { padding: 15px; border-radius: 8px; color: white; flex: 1; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Dashboard Monitoring Banjir Pintar (Smart Flood)</h2>
            <p>Pemantauan Debit Air Area Telkom University & Sekitarnya</p>
        </div>

        <div class="stats-box">
            <div class="stat-card" style="background: #27ae60;">Aman: <?= $aman ?> Titik</div>
            <div class="stat-card" style="background: #f39c12;">Siaga: <?= $siaga ?> Titik</div>
            <div class="stat-card" style="background: #e74c3c;">Bahaya: <?= $bahaya ?> Titik</div>
        </div>
        
        <?php if(isset($_GET['status'])): ?>
            <div style="padding: 10px; background: #d1ecf1; color: #0c5460; border-radius: 4px; margin-bottom: 15px;">
                Status Sistem: <strong><?= htmlspecialchars($_GET['status']) ?></strong>
            </div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Lokasi Sensor</th>
                <th>Ketinggian Air (cm)</th>
                <th>Status</th>
                <th>Waktu Pengukuran</th>
                <th>Foto Kondisi</th>
                <th>Aksi</th>
            </tr>
            <?php foreach($sensors as $sensor): ?>
            <tr>
                <td><strong><?= htmlspecialchars($sensor['location_name']) ?></strong></td>
                <td><?= htmlspecialchars($sensor['water_level_cm']) ?> cm</td>
                <td>
                    <?php 
                        $badgeClass = 'bg-aman';
                        if($sensor['status'] == 'Siaga') $badgeClass = 'bg-siaga';
                        if($sensor['status'] == 'Bahaya') $badgeClass = 'bg-bahaya';
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= strtoupper($sensor['status']) ?></span>
                </td>
                <td><?= $sensor['last_updated'] ?></td>
                <td>
                    <?php if($sensor['latest_photo']): ?>
                        <a href="<?= $sensor['latest_photo'] ?>" target="_blank">Lihat Foto</a>
                    <?php else: ?>
                        <span style="color: #999;">Tidak ada foto</span>
                    <?php endif; ?>
                </td>
                <td>
                    <button onclick="document.getElementById('up_sensor_id').value='<?= $sensor['id'] ?>'; document.getElementById('up_loc_name').innerText='<?= htmlspecialchars($sensor['location_name']) ?>'; document.getElementById('up_water_level').value='<?= $sensor['water_level_cm'] ?>'">Update Data</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <div class="form-update">
            <h3>Update Data Sensor Manual: <span id="up_loc_name" style="color: #3498db;">(Pilih Lokasi di Tabel)</span></h3>
            <form action="index.php?page=flood&action=update" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="sensor_id" id="up_sensor_id" required>
                <p>Ketinggian Air (cm): <br><input type="number" name="water_level" id="up_water_level" required style="padding: 8px; width: 200px; margin-top: 5px;"></p>
                <p>Upload Foto Bukti (Opsional): <br><input type="file" name="condition_photo" accept="image/*" style="margin-top: 5px;"></p>
                <button type="submit" style="background: #3498db; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Simpan Update</button>
            </form>
        </div>
    </div>
</body>
</html>