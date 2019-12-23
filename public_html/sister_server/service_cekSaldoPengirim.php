<?php
	include("../config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_rek = mysqli_real_escape_string($db,$_SESSION['no_rek']);
   	$nom = $_SESSION['jumlah']; 
    $sql = "SELECT * FROM data where no_rekening = '$no_rek'";
    $result = mysqli_query($db,$sql);
    $numResult = mysqli_num_rows($result);
    $saldo = 0;
    if($numResult > 0){ 
      $row = mysqli_fetch_array($result);
      $saldo = $row['saldo'];
    }
    $sisa = $saldo - $nom;
    if($sisa < 0){
	    $xml = new SimpleXMLElement("<data-saldo-pengirim/>");
      $status = $xml->addChild("status", "Saldo anda kurang");
      echo "<script>window.location = '../transfer.php'</script>";
    } else {
      $xml = new SimpleXMLElement("<data-saldo-pengirim/>");
      $status = $xml->addChild("status", "Sukses");
      echo "<script>window.location = '../sister_server/service_transfer.php'</script>";
    }
  }
    echo $xml->asXml();
    //mysqli_free_result($result);
    mysqli_close($db);   
?>