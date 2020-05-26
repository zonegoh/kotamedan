<?php
include "../dbinfo.php";
include "cek_session.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kota Medan Kota Buah - Yakifoundation.org</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="../assets/medankotabuahlogos-removebg-preview.png" type="image/png" sizes="16x16"> 
  <?php include "style.php"; ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php include "top.php"; ?>
  <?php include "sidebar.php"; ?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tanaman
	  <a href="form_tanaman.php" class="btn btn-primary">Add New</a>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
          <div class="box">
            <div class="box-body table-responsive">
              <table id="tanaman" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Data Tanaman</th>
                  <th>ID</th>
                  <th>Nama Tanaman</th>
                  <th>Tanggal Tanam</th>
                  <th>Alamat</th>
                  <th>Koordinat</th>
                  <th>Penanam</th>
                  <th>Pengawas</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
					if ($isAdmin==0) {
						$sql = 'select * from v_markers';
					} else {
						$sql = 'select * from v_markers where id_user="'.$idx_user.'"';
					}
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result as $data) {
					?>
					<tr>
					<td>
						<img src="<?= $data['gambar'] ?>" class="img-thumbnail" style="width:50px;height:50px;margin-right:10px;">
					</td>
					<td>
						<a href="form_edit_tanaman.php?idx=<?= $data['idx']; ?>"><h4><?= $data['idx']; ?></h4></a>
						<p>
						<a class="btn btn-xs btn-warning" style="margin-bottom:5px;margin-right:5px;" href="form_update_tanaman.php?idx=<?= $data['idx']; ?>">Update</a>
						<a class="btn btn-xs btn-success" style="margin-bottom:5px;margin-right:5px;" href="form_edit_tanaman.php?idx=<?= $data['idx']; ?>">Edit</a>
						</p>
					</td>
					<td>
						<?= strtoupper($data['nama']); ?>
					</td>
					<td>
						<?= $data['dob']; ?>
					</td>
					<td>
						<?= strtoupper($data['alamat']); ?>
					</td>
					<td>
						<a target="_blank" href="https://www.google.com/maps/@<?= $data['lat']; ?>,<?= $data['lng']; ?>,18z"><?= $data['lat']; ?>, <?= $data['lng']; ?></a>
					</td>
					<td>
						<img src="<?=$data['p_gambar']; ?>" alt="<?= $data['nama']; ?>" class="img-thumbnail" style="width:50px;height:50px;"><br>
						<b><?= strtoupper($data['p_nama']);?></b><br/>
						<small><?= strtoupper($data['p_pekerjaan']);?></small>
					</td>
					<td>
						<img src="<?= $data['pgambar'] ?>" class="img-thumbnail" style="width:50px;height:50px;margin-right:10px;"><br>
						<b><?= $data['pengawas'] ?></b>
					</td>
					<td>
						<a class="btn btn-xs btn-danger" href="delete_tanaman.php?idx=<?= $data['idx']; ?>">Delete</span></a>
						
					</td>
					
					</tr>

				<?php
				}
				?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Data Tanaman</th>
                  <th>ID</th>
                  <th>Nama Tanaman</th>
                  <th>Tanggal Tanam</th>
                  <th>Alamat</th>
                  <th>Koordinat</th>
                  <th>Penanam</th>
                  <th>Pengawas</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include "footer.php"; ?>
  <?php include "pengaturan.php"; ?>

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include "footer_script.php"; ?>
<script>
  $(function () {
    $('#tanaman').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
</body>
</html>
