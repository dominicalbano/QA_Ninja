<?php
//php script that connects to the database
require 'VariableHouse.php';
  
//format in 12 h cycle instead of 24 h cycle
  $hourchange = date('h');
  if ($hourchange > 12)
  {
  $hourchange = $hourchange - 12;
  }
  
  date_default_timezone_set('America/Vancouver');
  $Time = date("Y-m-d H:i:s");
  $User_ID = 'false';

  // code
      $Code = $_POST['code'];
      $Domain = $_POST['domain'];

      $Multi_Domain = $_POST['multi_domain'];
      $Mobile = $_POST['mobile'];
      

      //$Browser_Type = $_POST['browser_type'];
      $Browser_Type = 'Firefox'; 

      //connect to the database
      if (!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db))
      {
          die ($connection_error);    
      }
      else
      {
        // for dev purposes
        // echo ($conncection_confirm);
      }
  //storing variables from the form on page

  if (mysql_query("INSERT INTO $pass_domain VALUES('$Domain', '$User_ID', '$Time', '$Browser_Type', '$Code' , '$Multi_Domain' , '$Mobile')"))
    echo "<span class='label label-default' style='background-color:#78cd51;'><i class ='fa fa-arrow-circle-down' style='padding-right:20px; color:#34383C;'></i><span style='color:#34383C;'>Your Request has been processed<span><i class ='fa fa-arrow-circle-down' style='padding-left:20px; color:#34383C;'></i></span>";
  else
    echo "Your Request Was Not Processed, Please Try Again";

    if (mysql_query("INSERT INTO que_log VALUES('$Domain', '$Code', 'false', '$Time', 'waiting', '0', '0', '$Multi_Domain' , '$Mobile')"))




//close connections
mysql_close(mysql_connect($mysql_host, $mysql_user, $mysql_pass));


?>
