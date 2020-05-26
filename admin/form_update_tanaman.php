<?php
include "../dbinfo.php";
include "cek_session.php";
$idx = $_GET["idx"];

if (!$idx) {
	header('Location: data_tanaman.php');
	die();
}

try{
	if ($isAdmin=="0") {
		$query = $conn->prepare("select * from v_markers where idx=:idx");
		$data = array(
		':idx' => $idx
		);
	} else {
		$query = $conn->prepare("select * from v_markers where idx=:idx and id_user=:idx_user");
		$data = array(
		':idx' => $idx,
		':idx_user' => $idx_user
		);
	}
	$query->execute($data);
	$jml = $query->rowCount();
	if ($jml > 0) {
		$result = $query->fetch(PDO::FETCH_ASSOC);
	} else {
		header('Location: data_tanaman.php');
	}
}catch(PDOException $e){
	echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kota Medan Kota Buah - Yakifoundation.org</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
        Update Data tanaman <?= $idx ?>*
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary">
              <div class="box-body">
			  <div class="col-xs-12 col-md-12 table-responsive">
				<table class="table table-bordered">
				<tr>
					<td rowspan="5" class="text-center"><img class="img-thumbnail" style="width:200px;height:200px;" src="<?= $result['gambar'] ?>"/></td>
					<td>Nama pohon:</td> 
					<td><b><?= $result['nama']; ?></b></td>
				</tr>
				<tr>
					<td>Alamat tanaman:</td> 
					<td><?= $result['alamat']; ?></td>
				</tr>
				<tr>
					<td>Koordinat:</td> 
					<td><?= $result['lat']; ?>, <?= $result['lng']; ?></td>
				</tr>
				<tr>
					<td>Tgl. tanam:</td> 
					<td><?= $result['dob']; ?></td>
				</tr>
				<tr>
					<td>Nama penanam:</td> 
					<td><?= $result['p_nama']; ?></td>
				</tr>
				</table>
              </div>

			  <div class="col-xs-12 col-md-12 table-responsive">
				<ul class="timeline">
				<?php
				try{
					$query = $conn->prepare("select * from markers_update where idx_pohon='".$idx."' ORDER BY id DESC");
					$query->execute();
					while ($result2 = $query->fetch(PDO::FETCH_ASSOC)) {
						$vdate = date_create($result2['updated']);
						$date = date_format($vdate, 'Y-m-d');
						$time = date_format($vdate, 'h:i');
				?>
					<li class="time-label">
						<span class="bg-red">
							<?= $date ?>
						</span>
					</li>
					<li>
					<!-- timeline icon -->
					<i class="fa fa-camera bg-purple"></i>
						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> <?= $time ?></span>

							<h3 class="timeline-header"><b><?= $result2['updatedby'] ?></b> uploaded new photos</h3>

							<div class="timeline-body">
								<img src="<?= $result2['gambar'] ?>" class="img-thumbnail" style="max-width:150px;max-height:150px;">
							</div>
							<div class="timeline-footer">
							  <a class="btn btn-danger btn-xs" href="delete_update.php?id=<?= $result2['id'] ?>&gambar=<?= $result2['gambar'] ?>&idx=<?= $idx ?>">Delete</a>
							</div>
							
						</div>
					</li>
					
				<?php
					}
				}catch(PDOException $e){
						echo $e->getMessage();
				}
				?>
				</ul>
				</div>
			  </div>			  
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
	
	<section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary">
		    <div class="box-header with-border">
			  <h3 class="box-title">Upload Images</h3>
			</div>
            <!-- /.box-header -->
              <div class="box-body">
			  <div class="col-xs-12 col-md-12">
				<form action="update_tanaman.php" enctype="multipart/form-data" class="dropzone" id="image-upload">
					<input type="hidden" name="idx" value="<?= $idx ?>">
					<input type="hidden" name="updatedby" value="<?= $nama ?>">
				</form>
              </div>	
              </div>
			  
			  <div class="box-footer">
				&nbsp;
			  </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
<script type="text/javascript">
	Dropzone.options.imageUpload = {
		maxFilesize:5,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>
</body>
</html>