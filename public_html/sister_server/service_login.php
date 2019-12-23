<?php
	include("../config.php");
   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   		$pin = $_POST['pin'];
     	$password = md5( $_POST['password']); 
    	$sql = "SELECT * FROM data WHERE pin = '$pin' and password = '$password'";
      	$result = mysqli_query($db,$sql);
	//echo $result.$sql;
      	$numResult = mysqli_num_rows($result);
	//echo $numResult;
      	if($numResult > 0){
			$row = mysqli_fetch_array($result);
		//	$Status = $xml->addChild("Status", "Sukses Login");
			$_SESSION['nopin'] = $row['pin'];
	        $_SESSION['pass'] = $row['password']; 
	        $_SESSION['no_rek'] = $row['no_rekening']; 
	        $_SESSION['nama_pemilik'] = $row['nama']; 
	        header("location: ../menu.php");
      	} else {
      		echo "<script>alert('Your login name or password is invalid'); window.location = '../index.php'</script>";
      	//	$Status = $xml->addChild("Status", "Gagal Login");
   //    		echo '<script language="javascript">';
			// echo 'alert("Your Login Name or Password is invalid")';
			// echo '</script>';
			// header("location: ../index.php");
      	}
   }
?>
