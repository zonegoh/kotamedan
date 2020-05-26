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
        Data Penanam
	  <a href="form_penanam.php" class="btn btn-primary">Add New</a>
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
					<th>#</th>
					<th>Id</th>
					<th>Nama</th>
					<th>Tgl. Lahir</th>
					<th>Alamat</th>
					<th>Telepon</th>
					<th>Email</th>
					<th>Pekerjaan</th>
					<th>Aksi</th>
				</tr>
                </thead>
                <tbody>
                <?php
					if ($isAdmin==0) {
						$sql = 'select * from penanam where status=1 order by id DESC';
					} else {
						$sql = 'select * from penanam where status=1 and idx_user="'.$idx_user.'"';
					}
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

					foreach ($result as $data) {
					?>
					<tr>
					<td>
						<img src="<?=$data['gambar']; ?>" alt="<?= $data['idx']; ?>" class="img-thumbnail" style="width:50px;height:50px;">
					</td>
					<td>
						<strong><a href="form_edit_penanam.php?idx=<?= $data['idx']; ?>"><?= $data['idx']; ?></a></strong><br/>
					</td>
					<td>
						<?= strtoupper($data['name']); ?>
					</td>
					<td>
						<?= strtoupper($data['dob']);?>
					</td>
					<td>
						<?= strtoupper($data['alamat']);?>
					</td>
					<td>
						<?= strtoupper($data['phone']);?>
					</td>
					<td>
						<?= strtoupper($data['email']);?>
					</td>
					<td>
						<?= strtoupper($data['pekerjaan']);?>
					</td>
					<td>
						<p><a class="label label-success" style="margin-bottom:5px;margin-right:5px;" href="form_edit_penanam.php?idx=<?= $data['idx']; ?>">Edit</a> &nbsp; </p>
					</td>
					</tr>

				<?php
				}
				?>
                </tbody>
                <tfoot>
                <tr>
					<th>#</th>
					<th>Id</th>
					<th>Nama</th>
					<th>Tgl. Lahir</th>
					<th>Alamat</th>
					<th>Telepon</th>
					<th>Email</th>
					<th>Pekerjaan</th>
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
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
