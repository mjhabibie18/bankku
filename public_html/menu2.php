<?php
  session_start();
  if($_SESSION["nopin"] == "" || $_SESSION["nopin"] == null){
      echo "<script>alert('Anda belum login, silahkan login terlebih dahulu.....'); window.location='logout.php'</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="img/bank.jpg"/>
  <title>BANKKU.yippytech.COM</title>
  <link rel="shortcut icon" href="img/bank.jpg"/>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        
        <li><a href="logout.php">Logout</a></li>
      </ul>
      
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
  <div class="col-sm-2 sidenav">
      <ul class="nav nav-pills nav-stacked">
    <li class="active"><a href="menu.php">Home</a></li>
    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Informasi Rekening 
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li ><a href="menu.php">Informasi Saldo</a></li>
      <li class="active"><a href="menu2.php">Informasi Mutasi</a></li> 
       
    </ul>
    </li>
     <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transfer<br>Sesama & Antar Bank 
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="transfer.php">Transfer Sesama</a></li>
      <li><a href="#">Transfer Lain Bank</a></li> 
      
    </ul>
    </li>
    <li class="dropdown" class="active">
    <a class="dropdown-toggle" data-toggle="dropdown" href="pembayaran.php">Pembayaran & Tagihan
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li class="active"><?php $_SESSION["buybuy"] = "buybuy.com"; ?><a href="pembayaran3.php">buybuy.com</a></li>
    <li><?php $_SESSION["kongkow"] = "kongkow.com"; ?><a href="pembayaran2.php">KongKow.com</a></li> 
    <li><?php $_SESSION["samali.com"] = "samali.com"; ?><a href="pembayaran4.php">samali.com</a></li>
    <li><?php $_SESSION["wildan.com"] = "wildan.com"; ?><a href="pembayaran5.php">wildan.com</a></li>
    <li><?php $_SESSION["hotelsister.com"] = "wildan.com"; ?><a href="pembayaran6.php">hotelsister.com</a></li>  
    </ul>
    </li>
    <li ><a href="pembelian.html">Pembelian<br>Voucher & Uang Elektronik</a></li>
    <li ><a href="layanan.html">Layanan<br>Nasabah</a></li>
  </ul>
    </div>
    <div class="col-sm-8 text-left"> 
      <!-- Centered Pills -->
		
      <hr>
      <div class="container">
  <h2>Informasi Mutasi</h2>          
  <table class="table table-bordered">
     <tr>
        <th>Nama Pengirim</th>
        <th>Nama Penerima</th>
        <th>Nominal</th>
        <th>Tanggal Transaksi</th>
      </tr>
   <?php 
		$counter = 1; 
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://bankku.yippytech.com/sister_server/service_mutasi.php?cariData=$_SESSION[no_rek]");
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$xml = new SimpleXMLElement(curl_exec($curl));
		curl_close($curl); 
		foreach ($xml as $key){ 
			if($counter == 1){ ?>
			<tr>
				<td><?php echo $key; ?></td>
			<?php $counter++; } else if($counter % 4 == 0){ ?>
				<td><?php echo $key; ?></td></tr>
			<?php $counter = 1;} else { ?>
			<td><?php echo $key; ?></td>
		<?php $counter++; } 
		}?>


  </table>
</div>
    </div>
    
  </div>
</div>

<footer class="container-flull text-center">
  
 <p>Desain By HABIBIE & KRIDHO </p>
</footer>

</body>
</html>
