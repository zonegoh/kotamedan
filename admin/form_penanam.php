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
        Penanam baru
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <form role="form" action="save_penanam.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input class="form-control" name="p_nama" placeholder="Nama" type="text" required>
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input class="form-control" name="p_alamat" placeholder="Alamat" type="text">
                </div>
                <div class="form-group">
                  <label for="dob">Tanggal lahir</label>
                  <input value="<?= date("Y-m-d") ?>" class="form-control" name="p_dob" placeholder="Tanggal lahir" type="date">
                </div>
                <div class="form-group">
                  <label for="idcard">ID Card / KTP / SIM / Passport</label>
                  <input class="form-control" name="p_ktp" placeholder="ID Card" type="text">
                </div>
                <div class="form-group">
                  <label for="Email">Email</label>
                  <input class="form-control" name="p_email" placeholder="Alamat surel" type="email">
                </div>
                <div class="form-group">
                  <label for="Telepon">Telepon</label>
                  <input class="form-control" name="p_phone" placeholder="No. Telepon" type="text">
                </div>
                <div class="form-group">
                  <label for="Pekerjaan">Pekerjaan</label>
                  <input class="form-control" name="p_pekerjaan" placeholder="Pekerjaan" type="text">
                </div>
              </div>
			  <div class="col-xs-12 col-md-6">
                <div class="form-group">
                  <label for="Profile">Profile Picture</label>
				  <input type="file" id="preview" name="gambar">
                </div> 
				<div class="text-center" style="padding:5px;border:1px solid #ccc">
					<img id="img-preview" class="img-responsive" style="width:430px;height:430px;opacity:0.5;" src="../assets/upload_image.png"/>
				</div>
			  </div>	
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
				<input value="baru" name="data" type="hidden">
                <button type="submit" class="btn btn-primary">Submit</button>
				<button type="reset" class="btn btn-danger">Cancel</button>
              </div>
            </form>
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
<script>
$(document).ready( function() {
	function tampil(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#img-preview').attr('src', e.target.result);
				$('#img-preview').attr('style', 'opacity:1;width:430px;height:430px;');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#preview").change(function(){
		tampil(this);
	}); 
})
</script>
</body>
</html>