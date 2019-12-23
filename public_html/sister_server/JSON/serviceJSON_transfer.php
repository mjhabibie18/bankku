<?php
	include("../../config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      $no_rek_pengirim = mysqli_real_escape_string($con, $_POST['no_rek_pengirim']);
   		//$nama_pengirim = mysqli_real_escape_string($db,$_SESSION['nama_pemilik']);
      $no_rek_penerima = mysqli_real_escape_string($con, $_POST['no_rek_penerima']); 
      //$nama_penerima = mysqli_real_escape_string($db,$_POST['nama_penerima']); 
     	$nom = mysqli_real_escape_string($con, $_POST['nominal']);
      // $_SESSION['jumlah'] = $nom;
      // $_SESSION['rek_penerima'] = $no_rek_penerima; 
      $tgl = date("d/m/Y");
      $cekSaldo = "SELECT * FROM data where no_rekening = '$no_rek_pengirim'";
      $result1 = mysqli_query($con,$cekSaldo);
      $numResult1 = mysqli_num_rows($result1);
      $saldo = 0;
      if($numResult1 > 0){
        $row1 = mysqli_fetch_array($result1);
        $saldo = $row1['saldo'];
      }
      $sisa = $saldo - $nom;


      $sql_update_penerima = "SELECT * FROM data where no_rekening = '$no_rek_penerima'";
      $result_update_penerima = mysqli_query($con, $sql_update_penerima);
      $numResult = mysqli_num_rows($result_update_penerima);
      $saldo1 = 0;
      if($numResult > 0){ 
        $row = mysqli_fetch_array($result_update_penerima);
        $saldo1 = $row['saldo'];
      }
      $sisa1 = $saldo1 + $nom;

      if($sisa < 0) {
        $out = array(
          'status' => 400,
          'message' => "Saldo anda tidak cukup untuk transfer",
          'data' => null
          );
        echo json_encode($out);
        // echo "<script>alert('Saldo anda tidak cukup untuk transfer'); window.location = '../transfer.php'</script>";
      } else {
        mysqli_query($con, "SET AUTOCOMMIT=0");
        mysqli_query($con, "START TRANSACTION");
        $sql = mysqli_query($con,"INSERT INTO transaksi (no_rekening, no_rekening_tujuan, nama_pengirim, nama_penerima, nominal, tanggal_transaksi) values ('$no_rek_pengirim', '$no_rek_penerima', '', '', '$nom', '$tgl')");
        
        // INI BUAT UPDATE PENERIMA
        $update_penerima = mysqli_query($con, "UPDATE data SET saldo = '$sisa1' where no_rekening = '$no_rek_penerima'");

        //INI BUAT UPDATE PENGIRIM
        $update_pengirim = mysqli_query($con, "UPDATE data SET saldo = '$sisa' where no_rekening = '$no_rek_pengirim'");

        // $result = mysqli_query($db,$sql);
        // $numResult = mysqli_free_result($result);
       //  echo "<script>alert('$numResult');</script>";
        if($sql & $update_penerima & $update_pengirim) {
          mysqli_query($con, "COMMIT");
          $out = array(
            'status' => 200,
            'message' => "sukses",
            'data' => null
          );
          echo json_encode($out);

          // $xml = new SimpleXMLElement("<data-transaksi/>");
          // $status = $xml->addChild("status", "Sukses");
          // echo "<script>window.location = '../sister_server/service_updateSaldoPengirim.php'</script>";
        } else {
          mysqli_query($con, "ROLLBACK");
          $out = array(
            'status' => 400,
            'message' => "Transfer Anda Gagal!!!",
            'data' => null
          );
          echo json_encode($out);
          // $xml = new SimpleXMLElement("<data-transaksi/>");
          // $status = $xml->addChild("status", "Gagal");
          // echo "<script>alert('Transfer anda $status'); window.location = '../transfer.php'</script>";
        }
        // echo $xml->asXml();
        //mysqli_free_result($result);
        mysqli_close($con);   

      }
   }
?>