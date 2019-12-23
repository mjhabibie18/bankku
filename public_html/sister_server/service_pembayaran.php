<?php
	include("../config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $no_rek_pengirim = $_SESSION['no_rek'];
//      $_SESSION['nomer_telp'] = $_POST['tlp'];
      $nama_pengirim = $_SESSION['nama_pemilik'];
      $nama_penerima = $_POST['nama_penerima'];
   		$_SESSION['namaPenerima_pembayaran'] = $nama_penerima;
     	$nom = mysqli_real_escape_string($db,$_POST['nominal']);
      $_SESSION['jumlah_pembayaran'] = $nom;
      $tgl = date("d/m/Y");
      $cekSaldo = "SELECT * FROM data where nama = '$nama_penerima'";
      $result1 = mysqli_query($db,$cekSaldo);
      $numResult1 = mysqli_num_rows($result1);
      $saldo = 0;
      if($numResult1 > 0){
        $row1 = mysqli_fetch_array($result1);
        $norek_penerima = $row1['no_rekening'];
        $_SESSION['no_rek_penerima'] = $norek_penerima;
      }
      $sql = "INSERT INTO transaksi (no_rekening, no_rekening_tujuan, nama_pengirim, nama_penerima, nominal, tanggal_transaksi) values ('$no_rek_pengirim', '$norek_penerima', '$nama_pengirim', '$nama_penerima', '$nom', '$tgl')";
        // $result = mysqli_query($db,$sql);
        // $numResult = mysqli_free_result($result);
       //  echo "<script>alert('$numResult');</script>";
        if(mysqli_query($db,$sql)){
          $xml = new SimpleXMLElement("<data-transaksi/>");
          $status = $xml->addChild("status", "Sukses");
            echo "<script>alert('$_SESSION[rek]'); window.location = '../sister_server/service_updateSaldoPengirimPembayaran.php'</script>";
        } else {
          $xml = new SimpleXMLElement("<data-transaksi/>");
          $status = $xml->addChild("status", "Gagal");
          echo "<script>alert('Transfer anda $status'); window.location = '../pembayaran.php'</script>";
        }
        echo $xml->asXml();
        //mysqli_free_result($result);
        mysqli_close($db);   
   }
?>
