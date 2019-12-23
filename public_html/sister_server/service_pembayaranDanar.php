<?php
	include("../koneksiD.php");
   session_start();
   if($_DANAR["REQUEST_METHOD"] == "POST") {
      $no_rek_pengirim = mysqli_real_escape_string($db,$_SESSION['no_rek']);
   		$nama_pengirim = mysqli_real_escape_string($db,$_SESSION['nama_pemilik']);
      $no_rek_penerima = mysqli_real_escape_string($db,$_SESSION['rek']); 
      $nama_penerima = mysqli_real_escape_string($db,$_POST['nama_penerima']); 
     	$nom = mysqli_real_escape_string($db,$_POST['nominal']);
      $_SESSION['jumlah'] = $nom;
      $_SESSION['rek_penerima'] = $no_rek_penerima; 
      $tgl = date("d/m/Y");
      $cekSaldo = "SELECT * FROM data where no_rekening = '$no_rek_pengirim'";
      $result1 = mysqli_query($db,$cekSaldo);
      $numResult1 = mysqli_num_rows($result1);
      $saldo = 0;
      if($numResult1 > 0){
        $row1 = mysqli_fetch_array($result1);
        $saldo = $row1['saldo'];
      }
      $sisa = $saldo - $nom;
      if($sisa < 0){
        echo "<script>alert('Saldo anda tidak cukup untuk transfer'); window.location = '../pembayaran2.php'</script>";
      } else {
        $sql = "INSERT INTO transaksi (no_rekening, no_rekening_tujuan, nama_pengirim, nama_penerima, nominal, tanggal_transaksi) values ('$no_rek_pengirim', '$no_rek_penerima', '$nama_pengirim', '$nama_penerima', '$nom', '$tgl')";
        // $result = mysqli_query($db,$sql);
        // $numResult = mysqli_free_result($result);
       //  echo "<script>alert('$numResult');</script>";
        if(mysqli_query($db,$sql)){
          $xml = new SimpleXMLElement("<data-transaksi/>");
          $status = $xml->addChild("status", "Sukses");
          echo "<script>window.location = '../sister_server/service_updateSaldoPengirim.php'</script>";
        } else {
          $xml = new SimpleXMLElement("<data-transaksi/>");
          $status = $xml->addChild("status", "Gagal");
          echo "<script>alert('Transfer anda $status'); window.location = '../sister_client/transfer.php'</script>";
        }
        echo $xml->asXml();
        //mysqli_free_result($result);
        mysqli_close($db);   

      }
   }
?>