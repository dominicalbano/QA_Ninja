<?php
session_start();
class request{
    
    function recent_domains(){
        if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }

        $sql = "SELECT Domain, code, time, status, URLs_Ran, URLs_Remaining, multidomain, mobile FROM que_log order by time desc LIMIT 30";
           if(!$result = $db->query($sql)){
           die('There was an error running the query [' . $db->error . ']');
           }
           return $result;
    }
    
    function recent_domains_ajax(){
        if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }

        $sql = "SELECT code FROM que_log  WHERE (status = 'running' or status = 'purgatory') order by time desc LIMIT 30";
           if(!$result = $db->query($sql)){
           die('There was an error running the query [' . $db->error . ']');
           }
           return $result;
    }
    
    
    function wanted_domain($code){
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
    
         $stmt = $db->prepare("SELECT Domain, time, multidomain, mobile FROM que_log WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($DOMAIN, $time, $multidomain, $mobile);
         
         $wanted_domain = '';
         $timestamp = '';
         $is_multi_domain = '';
         $is_mobile_domain = '';
         
         while ($stmt->fetch())
         {
            $wanted_domain = $DOMAIN;
            $timestamp = $time;
            $is_multi_domain = $multidomain;
            $is_mobile_domain = $mobile;
         }
         
        $return_vars = array($wanted_domain, $timestamp, $is_multi_domain, $is_mobile_domain);
        return $return_vars;
    }
    
    function urls_ran_func($code){
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
    
         $stmt = $db->prepare("SELECT URLs_Ran FROM que_log WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($URLs_Ran);
         
         $number_ran = 0;
         
         $result = array();
         while ($stmt->fetch())
         {
            $number_ran = $URLs_Ran;
         }
        return $number_ran;
    }
    
    function urls_remain_func($code){
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
    
         $stmt = $db->prepare("SELECT URLs_Remaining FROM que_log WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($URLs_Remain);
         
         $number_ran = 0;
         
         $result = array();
         while ($stmt->fetch())
         {
            $number_remain = $URLs_Remain;
         }
        return $number_remain;
    }
    
        function status($code){
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
         $stmt = $db->prepare("SELECT status FROM que_log WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($Status);
         
         $domain_status = '';
         
         $result = array();
         while ($stmt->fetch())
         {
            $domain_status = $Status;
         }
        return $domain_status;
    }
    
    function number_errors_general($domain, $code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               //Once more types of errrs are being collected. You will want to loop through each of the returned variables
               //and do a count of how many of each error there is
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain = ? and Domain_Code = ?");
         $stmt->bind_param('ss', $domain, $code);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
        
    }
    
 function number_loading_errors_ajax($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "LoadingError";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }

 function number_title_errors($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "TitleError";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }
    
     function number_repetitive_errors($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "RepetitiveText";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }
    
     function number_text_errors($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "TextError";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }
    
    function number_linking_issues($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "LinkingIssue";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }

    function number_spelling_errors($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "SpellingError";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }
    
    function number_ga_errors($code)
    {
         if(isset($db) == false){
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
               
             $type = "GA_E";
               
         $stmt = $db->prepare("SELECT URL FROM errors WHERE Domain_Code = ? and type = ?");
         $stmt->bind_param('ss', $code, $type);
         $stmt->execute();
         $stmt->bind_result($URL);
         $stmt->store_result();
         
        return $stmt->num_rows;
    }
    
    
    
    
 function all_errors($code)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT URL, SourceUrl, type, message FROM errors WHERE Domain_Code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($URL, $SourceUrl, $type, $message);
         
         
        $result = array();
         while($stmt->fetch())
         {
            $result[] = array('URL' => $URL, 'SourceUrl'=> $SourceUrl, 'type' => $type, 'message' => $message);
         }
        return $result;
         

    }
    
    
    function all_code($domain, $multidomain, $mobile)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
        
         $stmt = $db->prepare("SELECT code, time FROM que_log WHERE Domain = ? AND (status = 'done' or status = 'purgatory') and multidomain = '$multidomain' and mobile = '$mobile' ORDER BY time ASC");
         $stmt->bind_param('s', $domain);
         $stmt->execute();
         $stmt->bind_result($all_code, $all_time);
         
        
         
         $result = array();
         while ($stmt->fetch())
         {
            $result[] = array('code' => $all_code, 'time'=> $all_time);
         }
        return $result;
    }
    

    
        // Now that we have the code from the complete prior domain run
        // We can get all the error information needed from that previous run

    
    function code_history($domain, $multidomain)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
        
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' and multidomain = '$multidomain' ORDER BY time ASC");
         $stmt->bind_param('s', $domain);
         $stmt->execute();
         $stmt->bind_result($code_history);
         

         $result = array();
         while ($stmt->fetch())
         {
            $result[] = array('code' => $code_history);
         }
        return $result;
    }
    
    function environment_codes($raw_domain)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
        
        $pro_domain = ($raw_domain . "/");
        $demo_domain = ($raw_domain . ".g5demo.com/");
        $rds_domain = ($raw_domain . ".redesign.g5cloud.me/");
        $rds2_domain = ($raw_domain . ".redesign2.g5cloud.me/");
        $real_stage_domain = ($raw_domain . ".real-staging.g5search.com/");
        $pluto_domain = ($raw_domain . ".pluto.g5search.com/");
        
         $result = array();

         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' ORDER BY time DESC LIMIT 1");
         $stmt->bind_param('s', $pro_domain);
         $stmt->execute();
         $stmt->bind_result($pro_code);
         while ($stmt->fetch()){$result[] = array('env' => 'Production', 'code' => $pro_code);}
         
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' ORDER BY time DESC LIMIT 1");
         $stmt->bind_param('s', $demo_domain);
         $stmt->execute();
         $stmt->bind_result($demo_code);
         while ($stmt->fetch()){$result[] = array('env' => 'Demo', 'code' => $demo_code);}
         
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' ORDER BY time DESC LIMIT 1");
         $stmt->bind_param('s', $rds_domain);
         $stmt->execute();
         $stmt->bind_result($rds_code);
         while ($stmt->fetch()){$result[] = array('env' => 'Redesign', 'code' => $rds_code);}
         
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' ORDER BY time DESC LIMIT 1");
         $stmt->bind_param('s', $rds2_domain);
         $stmt->execute();
         $stmt->bind_result($rds2_code);
         while ($stmt->fetch()){$result[] = array('env' => 'Redesign2', 'code' => $rds2_code);}
         
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' ORDER BY time DESC LIMIT 1");
         $stmt->bind_param('s', $real_stage_domain);
         $stmt->execute();
         $stmt->bind_result($real_stage_code);
         while ($stmt->fetch()){$result[] = array('env' => 'Real-Staging', 'code' => $real_stage_code);}
         
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND status = 'done' ORDER BY time DESC LIMIT 1");
         $stmt->bind_param('s', $pluto_domain);
         $stmt->execute();
         $stmt->bind_result($pluto_code);
         while ($stmt->fetch()){$result[] = array('env' => 'Pluto', 'code' => $pluto_code);}
         
         return $result;
    }
  
   function domain_history($code_value)
    {
        
        if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT type FROM errors WHERE Domain_Code = ?");
         $stmt->bind_param('s', $code_value);
         $stmt->execute();
         $stmt->bind_result($type);
         
         
        $result = array();
         while($stmt->fetch())
         {
            $result[] = array('type' => $type);
         }
        return $result;
         

    }
    
    
    
        
 function all_info($code)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT Domain, time, URLs_Ran, URLs_Remaining FROM que_log WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($Domain, $time, $URLs_Ran, $URLs_Remaining);
         
         
        $result = array();
         while($stmt->fetch())
         {
            $result[] = array('URL' => $URL, 'URLs_Remaining'=> $URLs_Remaining, 'time' => $time, 'URLs_Ran' => $URLs_Ran);
         }
        return $result;
         

    }
    
 function all_urls($code)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT ID, LoadTime FROM alldata WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($ID, $LoadTime);
         
         
        $result = array();
         while($stmt->fetch())
         {
            $result[] = array('ID' => $ID, 'LoadTime' => $LoadTime);
         }
        return $result;
         

    }
    
    function number_meta($code)
    {
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT SourceID, ID, Meta FROM alldata WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($SourceID, $ID, $Meta);
         
        $dupmeta = array();
         while($stmt->fetch())
         {
            $dupmeta[] = array('SourceID' => $SourceID, 'ID' => $ID, 'Meta' => $Meta);
         }
         
// match the logic on the reports page for sorting       
$size_dupmeta = count($dupmeta);

// get rid of urls where we are NOT concerned about duplicate meta
for ($j = 0; $j < $size_dupmeta; $j++)
{
	if (strpos($dupmeta[$j]['ID'] , '/units/') == true ||
	    strpos($dupmeta[$j]['ID'] , 'leads') == true ||
	    strpos($dupmeta[$j]['ID'] , 'sitemap') == true ||
	    strpos($dupmeta[$j]['ID'] , 'site_map') == true ||
	    strpos($dupmeta[$j]['ID'] , 'coupon') == true ||
            strpos($dupmeta[$j]['ID'] , 'site_link') == true ||
	    strpos($dupmeta[$j]['ID'] , 'privacy') == true)
	{
           unset($dupmeta[$j]);
	}
	
	if ($dupmeta[$j]['Meta']  == '')
	{
           unset($dupmeta[$j]);
	}
}
$reset_1_dupmeta = array_values($dupmeta);
$new_size_dupmeta = count($dupmeta);

//Make an array of just meta descriptions
$meta_temp = array();
for ($k = 0; $k < $new_size_dupmeta; $k++)
{
        array_push($meta_temp, $reset_1_dupmeta[$k]['Meta']);
}

// now count how many times each meta D occurs in the array
$meta_counts = array_count_values($meta_temp);

// if that count is more than one clear it from the count array to just get non-dup metas
$just_meta = array();
foreach ($meta_counts as $key => $value)
{
        if ($value == 1)
	{
             array_push($just_meta, $key);
	}
}

// now use that unique list to elimate those unique metas from the larger array
for ($kk = 0; $kk < $new_size_dupmeta; $kk++)
{
        if (in_array($reset_1_dupmeta[$kk]['Meta'] , $just_meta))
	    {
                      unset($reset_1_dupmeta[$kk]);
	    }
}

// might need to add an if ($dupmeta contains no data do not execute below code)
$reset_2_dupmeta = array_values($reset_1_dupmeta);

//make an array of just the remaining duplicate meta D's
$all_duplicate_meta = array();
for ($gg = 0; $gg < count($reset_2_dupmeta); $gg++)
{					
         array_push($all_duplicate_meta, $reset_2_dupmeta[$gg]['Meta']);
}

// the duplicate meta kings will be unqiue Meta D's that all have a duplicate in the list
$dup_meta_kings = array_values(array_unique($all_duplicate_meta));

//how many duplicates in total
$total_dup = count($all_duplicate_meta) - count($dup_meta_kings);
    
    return $total_dup;
        
    }
    
    function all_meta($code)
    {
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT SourceID, ID, Meta FROM alldata WHERE code = ?");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($SourceID, $ID, $Meta);
         
        $dupmeta = array();
         while($stmt->fetch())
         {
            $dupmeta[] = array('SourceID' => $SourceID, 'ID' => $ID, 'Meta' => $Meta);
         } 
        return $dupmeta;
    }
    
    
     function time_elapsed($code)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
            
         $stmt = $db->prepare("SELECT Time FROM alldata WHERE Code = ? order by time desc Limit 1");
         $stmt->bind_param('s', $code);
         $stmt->execute();
         $stmt->bind_result($Time);
         $end_time = "";
         while ($stmt->fetch())
            {
               $end_time = $Time;
            }
         
         return $end_time;
         
    }
    
    function multi($domain, $multidomain, $mobile)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
        
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND (status = 'done' or status = 'purgatory') and multidomain != '$multidomain' and mobile = '$mobile' order by time desc Limit 1");
         $stmt->bind_param('s', $domain);
         $stmt->execute();
         $stmt->bind_result($code);
         
        
         
         $result = array();
         while ($stmt->fetch())
         {
            $result[] = array('code' => $code);
         }
        return $result;
    }
    
    function mobile($domain, $multidomain, $mobile)
    {
        
         if(isset($db) == false){
   
            require_once("/var/www/g5quality_2.0/Data/db_class.php");
            $db_class = new db_class();
            $db = $db_class->db_call();
        }
        
         $stmt = $db->prepare("SELECT code FROM que_log WHERE Domain = ? AND (status = 'done' or status = 'purgatory') and multidomain = '$multidomain' and mobile != '$mobile' order by time desc Limit 1");
         $stmt->bind_param('s', $domain);
         $stmt->execute();
         $stmt->bind_result($code);
         
        
         
         $result = array();
         while ($stmt->fetch())
         {
            $result[] = array('code' => $code);
         }
        return $result;
    }
    
    
    
}//end request class
           
?>
?>
