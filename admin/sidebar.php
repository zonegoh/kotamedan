<?php 
$namafile = basename($_SERVER['SCRIPT_FILENAME']);
var_dump($namafile);
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if($namafile=='dashboard.php') { echo ' class="active"'; } ?>>
          <a href="dashboard.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview <?php if($namafile=='data_tanaman.php' OR $namafile=='data_penanam.php' ) { echo ' active menu-open'; } ?> ">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Data</span>
			<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  <ul class="treeview-menu">
            <li <?php if($namafile=='data_tanaman.php') { echo ' class="active"'; } ?>><a href="data_tanaman.php"><i class="fa fa-circle-o"></i> Tanaman</a></li>
            <li <?php if($namafile=='data_penanam.php') { echo ' class="active"'; } ?>><a href="data_penanam.php"><i class="fa fa-circle-o"></i> Penanam</a></li>
          </ul>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>