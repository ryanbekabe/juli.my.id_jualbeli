<?php
//https://stackoverflow.com/questions/11305230/alternative-for-mysql-num-rows-using-pdo
include_once 'connection_dbjualol.php';
date_default_timezone_set('Asia/Jakarta');
//$fullinfo = print_r($_SERVER,true);
//echo $fullinfo.'<br/>';
$waktu=date('Y-m-d H:i:s');
$ip=$_SERVER['REMOTE_ADDR'];
$ua=$_SERVER['HTTP_USER_AGENT'];
$ref=$_SERVER['HTTP_REFERER'];
$URI='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$vartime = date('Y-m-d H:i:s', time() + 60);
$tgllog = date("Y-m-d H:i:s");
if (isset($_POST['InputEmail']) && isset($_POST['InputPassword']))
{
	$vInputEmail	= $_POST['InputEmail'];
	$vInputPassword	= $_POST['InputPassword'];
	//echo 'STRLEN vInputPassword = '.strlen($vInputPassword);

	if (strlen($vInputPassword) < 4)
	{
		echo 'Password harus diisi, paling sedikit 4 karakter!';
		exit;
	}

	if (strlen($vInputEmail) <10)
	{
		echo 'Pastikan data diisi dengan benar!';
		exit;
	}
	else
	{
		try
		{
			$database = new Connection();
			$db = $database->openConnection();
			$res = $db->query("SELECT COUNT(*) FROM pengguna WHERE email = '$vInputEmail'");
			$num_rows = $res->fetchColumn();
			//echo "num_row = ".$num_rows;
			if ($num_rows == 1)
			{
				echo "Anda sudah terdaftar,";
				$sql = "SELECT * FROM pengguna WHERE email = '$vInputEmail' " ;
				foreach ($db->query($sql) as $row)
				{
					if ($row['password'] == $vInputPassword)
					{
						echo " akan diarahkan ke halaman Dashboard.<br>";
						echo " ID: ".$row['id'] . "<br>";
						echo " Nama: ".$row['nama'] . "<br>";
						echo " user: ".$row['username'] . "<br>";
						echo " Daftar pada: ".$row['tgl_daftar'] . "<br>";
					}
					elseif ($row['password'] != $vInputPassword)
					{
						echo " tetapi password yang Anda masukkan salah, silakan isi dengan benar!";
						exit;
					}
				}
			}
			else
			{
				echo "Anda belum terdaftar, akun Anda akan dibuatkan.<br>";
				$database = new Connection();
				$db = $database->openConnection();
				$stm = $db->prepare("INSERT INTO pengguna (id, email, nohp, nama, username, password, alamat, kota, domain, tgl_daftar) VALUES ( :id, :email, :nohp, :nama, :username, :password, :alamat, :kota, :domain, :tgl_daftar)") ;
				$stm->execute(array(':id' => 0, ':email' => $vInputEmail, ':nohp' => '0', ':nama' => '', ':username' => '', ':password' => $vInputPassword, ':alamat' => '', ':kota' => '', ':domain' => '', ':tgl_daftar' => $tgllog));
				echo "Silakan lengkapi data Anda pada Dashboard Anda!";
			}
		}
		catch (PDOException $e)
		{
			echo "Terdapat masalah koneksi: " . $e->getMessage();
		}

		//cek apakah ada di DB, jika ada maka masuk ke halaman Dashboard/Index
		//jika tidak ada di db buat akun baru
	}
}

?>
