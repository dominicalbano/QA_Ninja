<?php
require('/var/www/g5quality_2.0/VariableHouse.php');
class db_class{

   public function db_call(){
            
        $db =  new mysqli("192.168.2.44","app_user1","","g5_qa_dev");
        if ($db->connect_errno) {
        echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
        }
        
 
        return $db;
    }
}
?>
