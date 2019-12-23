<?php
  include "../config/koneksi.php";
  $k = new db();
  $con = mysqli_connect($k->server, $k->username, $k->password, $k->database);
  $pin = $_GET["pin"];
  $password = $_GET["password"];
  
  $sql = "SELECT * FROM data WHERE pin = '$pin' AND password = '$password' ";
  $result = mysqli_query($con, $sql);
  $cek = mysqli_num_rows($result);

  $array = array();
  $subArray=array();
  while($row =mysqli_fetch_array($result))
    {
        $subArray['id'] = $row['no_rekening'];
        $subArray['nama'] = $row['pin'];
        $_SESSION["pin"] = $subArray['nama'];
        
    }
  if ($cek>0)
  { 
    $subArray['status'] = "OK";
    $array[] =  $subArray ;
  } else {
    $subArray['status'] = "FAILED";
    $array[] =  $subArray ;
  }
  echo'{"data":{"object":'.json_encode($array).'}}';
  mysqli_close($con);
?>