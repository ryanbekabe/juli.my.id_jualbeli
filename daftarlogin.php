<?php
//https://www.flaticon.com/free-icon/online-shopping_2919940
include 'header.html';
date_default_timezone_set('Asia/Jakarta');
//$fullinfo = print_r($_SERVER,true);
//echo $fullinfo.'<br/>';
$waktu=date('Y-m-d H:i:s');
$ip=$_SERVER['REMOTE_ADDR'];
$ua=$_SERVER['HTTP_USER_AGENT'];
$ref=$_SERVER['HTTP_REFERER'];
$URI='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$vartime = date('Y-m-d H:i:s', time() + 60);

$_SESSION['sesiid'] = md5($ip.$ua.$vartime);
$sesiuserid=$_SESSION['sesiid'];
echo 'sesiuserid = '.$sesiuserid;

?>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar / Login</h1>
          </div>
		  <div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<!-- https://getbootstrap.com/docs/4.3/components/forms/ 
			https://getbootstrap.com/docs/4.0/components/buttons/ -->
			<div class="row d-flex justify-content-center">
			  <div class="col-lg-7">
				<div class="p-5">
				  <div class="text-center">
					<h1 class="h4 text-gray-900 mb-4">Buat Sebuah Akun / Login!</h1>
				  </div>
				  <form class="user" action="daftarlogin_get.php" method="POST">
					<div class="form-group">
					  <input type="email" class="form-control form-control-user" id="InputEmail" name="InputEmail" placeholder="Alamat EMail">
					</div>
					<div class="form-group">
					  <input type="password" class="form-control form-control-user" id="InputPassword" name="InputPassword" placeholder="Password">
					</div>
					<button type="submit" class="btn btn-primary btn-user btn-block">Daftarkan Akun / Login</button>
				  </form>
				  <hr>
				</div>
			  </div>
			</div>
		  </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
    </div>
  </div>
<?php
include 'footer.html';
?>