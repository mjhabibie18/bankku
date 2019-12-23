<?php
	include("../config.php");
   session_start();
    $no_rek = mysqli_real_escape_string($db,$_SESSION['no_rek']);
   	$nom = $_SESSION['jumlah_pembayaran']; 
    $sql = "SELECT * FROM data where no_rekening = '$no_rek'";
    $result = mysqli_query($db,$sql);
    $numResult = mysqli_num_rows($result);
    $saldo = 0;
    if($numResult > 0){ 
      $row = mysqli_fetch_array($result);
      $saldo = $row['saldo'];
    }
    $sisa = $saldo - $nom;
    // echo "<script>alert('$sisa');</script>";
    $update = "UPDATE data SET saldo = '$sisa' where no_rekening = '$no_rek'";
  	if(mysqli_query($db,$update)){
	    $xml = new SimpleXMLElement("<data-saldo-pengirim/>");
      $status = $xml->addChild("status", "Sukses");
      echo "<script>window.location = '../sister_server/service_updateSaldoPenerimaPembayaran.php';</script>";
    } else {
      $xml = new SimpleXMLElement("<data-saldo-pengirim/>");
      $status = $xml->addChild("status", "Gagal");
      echo "<script>window.location = '../pembayaran2.php';</script>";
    }
    echo $xml->asXml();
    //mysqli_free_result($result);
    mysqli_close($db);   
?>