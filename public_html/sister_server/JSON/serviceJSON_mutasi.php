<?php
	include "../config/koneksi.php";	
	$norek = $_GET["cariData"];
	// on = mysqli_connect("localhost", "root", "", "client");
	$k = new db();
	$con = mysqli_connect($k->server, $k->username, $k->password, $k->database);
	if($norek != "" || $norek != null){
		$sql = "SELECT * FROM transaksi WHERE no_rekening = $norek";
		$result = mysqli_query($con, $sql);
		$cek = mysqli_num_rows($result);
		$no=0;
		$json = '{"data": {';
		$json .= '"object":[ ';
		while($r=mysqli_fetch_array($result))
		{					
			$json .= '{';
				$json .= 
				   '"nama_pengirim":"'.$r['nama_pengirim'].'",
				    "nama_penerima":"'.$r['nama_penerima'].'",
					"nominal":"'.$r['nominal'].'",
					"tanggal_transaksi":"'.$r['tanggal_transaksi'].'"
				}';					
			$no++;
			if($no < $cek)
			{
				$json .= ',';
			}		
		}
		$json .= ']';
		$json .= '}}';
		// echo $json;

		
		echo $json;
		mysqli_close($con);		
	}
