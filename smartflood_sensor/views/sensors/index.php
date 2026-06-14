<?php include 'views/layout/header.php'; ?>
<h2>Data Ketinggian Air (Sensor)</h2>

<?php if(isset($_GET['msg'])): ?>
    <div style="background:#d4edda; color:#155724; padding:10px; margin-bottom:15px; border-radius:4px;">
        <?= htmlspecialchars($_GET['msg']) ?>
    </div>
<?php endif; ?>

<a href="index.php?page=sensor&action=create" class="btn btn-success">+ Tambah Data Baru</a>

<table>
    <tr>
        <th>No</th>
        <th>Lokasi</th>
        <th>Level Air</th>
        <th>Status</th>
        <th>Foto</th>
        <th>Aksi</th>
    </tr>
    <?php $no=1; foreach($sensors as $s): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($s['location_name']) ?></td>
        <td><?= $s['water_level_cm'] ?> cm</td>
        <td>
            <?php 
                $c = 'bg-aman'; 
                if($s['status']=='Siaga') $c = 'bg-siaga';
                if($s['status']=='Bahaya') $c = 'bg-bahaya';
            ?>
            <span class="badge <?= $c ?>"><?= strtoupper($s['status']) ?></span>
        </td>
        <td>
            <?php if($s['latest_photo']): ?>
                <a href="<?= $s['latest_photo'] ?>" target="_blank">Lihat</a>
            <?php else: ?> - <?php endif; ?>
        </td>
        <td>
            <a href="index.php?page=sensor&action=edit&id=<?= $s['id'] ?>" class="btn">Edit</a>
            <a href="index.php?page=sensor&action=delete&id=<?= $s['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus?');">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include 'views/layout/footer.php'; ?>