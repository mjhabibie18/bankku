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
  <title>BANKKU.EPIZY>COM</title>
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
  <script type="text/javascript">
    function submit_form(){
      document.form1.submit();
    }
  </script>
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
    <li class="active"><a href="#">Home</a></li>
    <li class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Informasi Rekening 
    <span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li ><a href="menu.php">Informasi Saldo</a></li>
      <li><a href="#">Informasi Mutasi</a></li> 
       
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
    </ul>
    </li>
    <li ><a href="pembelian.html">Pembelian<br>Voucher & Uang Elektronik</a></li>
    <li ><a href="layanan.html">Layanan<br>Nasabah</a></li>
  </ul>
    </div>
    <div class="col-sm-8 text-left"> 
      <!-- Centered Pills -->
      
        <hr>
      
      <table class="table-responsive table-condensed">
        <tr>
          <form id="myForm" method="get" action="<?php $_SERVER['PHP_SELF'] ?>">
            <td><label for="ex3">No Invoice</label></td>
            <?php
              if($_SESSION['rek'] == ""){ ?>
                <td><input class="form-control" id="id_pembelian" name="id_pembelian" type="text"></td>
              <?php } else { ?>
                <td><input class="form-control" id="id_pembelian" name="id_pembelian" type="text"></td>
             <?php }
            ?>
          </form>
        </tr>
        <form id="form1" action="https://ilhamsidqi97.000webhostapp.com/server_UpdatePembelian.php" method="post">
        <tr>
          <td><label for="ex3">Nama Tujuan</label></td>
          <td><input type='text' name='nama_penerima' class="form-control" id='nama_penerima' value='<?php echo $_SESSION["samali.com"]; ?>' readonly /></td>
        </tr>
        <?php
        //include("koneksiD.php");
        if(empty($_GET['id_pembelian'])){
          $_SESSION['rek'] = "";
        //   //header("location: transfer.php");
        //   echo "<td><input type='text' class='form-control' name='nama_penerima' value='' id='nama_penerima' readonly /></td>";
        } else {
          $id_pembelian = $_GET['id_pembelian'];
          $_SESSION['rek'] = $id_pembelian;
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_URL, "https://ilhamsidqi97.000webhostapp.com/server_AmbilDataEqi.php?id_pembelian=$id_pembelian");
          curl_setopt($curl, CURLOPT_HEADER, 0);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
          $xml = new SimpleXMLElement(curl_exec($curl));
          curl_close($curl);
          foreach ($xml as $key){
            if($key == "no rekening tidak ada"){
              echo "<td><input type='text' class='form-control' name='nama_penerima' value='' id='nama_penerima' readonly /></td>";
              echo "<script>alert('$key');</script>";
            } else {
                echo "<tr>";
              echo "<td><label for='ex3'>Total Pembayaran</label></td>";
              echo "<td><input type='text' class='form-control' name='nominal' id='nominal' value='$key' readonly /></td>";
              echo "</tr>";
              echo "<script>document.getElementById('id_pembelian').value = '$_GET[id_pembelian]';</script>";
              echo "<input type='hidden' class='form-control' name='idpembelian' id='idpembelian' value='$_GET[id_pembelian]' readonly />";
            }
          }
        }
        ?>
        <!--</tr>-->
        <!--<tr>-->
        <!--  <td><label for="ex3">Total Pembayaran</label></td>-->
        <!--  <td><input class="form-control" id="nominal" name="nominal" type="text"></td>-->
        <!--</tr>-->
        <tr height="80">
          <td><button type="submit" name="submit" class="btn btn-success btn-md">Bayar</button></td>
        </tr>
        </form>
      </table>

      <!---<div class="form-group row">
        <div class="col-xs-4">
          <label for="ex3">No-Rekening Tujuan</label>
          <input class="form-control" id="ex3" type="text" on>
        </div>
        <div class="col-xs-4">
         <center> <label for="ex3">Nama Tujuan</label><br>
          <div>No Name</div></center>
        </div>
        <div class="col-xs-4">
          <label for="ex3">Jumlah Nominal</label>
          <input class="form-control" id="ex3" type="text">
          <br>
          <button style="float: right;" type="button" class="btn btn-primary btn-sm">Kirim</button>
        </div>
      </div>-->
    </div>
    
  </div>
</div>

<footer class="container-flull text-center">
  
 <p>Desain By HABIBIE & KRIDHO </p>
</footer>

</body>
</html>
