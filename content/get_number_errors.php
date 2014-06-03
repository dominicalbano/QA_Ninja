<?php
session_start();
$code = $_POST['code'];

if(isset($code))
   {
    require_once("/var/www/g5quality_2.0/Data/pull.php");
    $request = new request();
 
    //Initiate Array
    $variable_array = array();
    //Push Code to array
     array_push($variable_array, $code);
    
    //Get number of broken pages
        //assign returned variable
        $number_loading_errors = $request->number_loading_errors_ajax($code);
        //Push result to array
        array_push($variable_array, $number_loading_errors);
        
    //Get urls ran
        //Call database query and set variable
        $URLs_Return = $request->urls_ran_func($code); 
        array_push($variable_array, $URLs_Return);
       
    //Get urls remain
        //Call database query and set variable
        $URLs_Remain = $request->urls_remain_func($code); 
        array_push($variable_array, $URLs_Remain);
       
    //Get status
        //Call database query and set variable
        $status_return = $request->status($code);
        array_push($variable_array, $status_return);
        
    //Get number of errors in title tag
        //assign returned variable
        $number_title_errors = $request->number_title_errors($code);
        //Push result to array
        array_push($variable_array, $number_title_errors);
    //Get number repetitive text errors
        $number_repetitive_errors = $request->number_repetitive_errors($code);
        //Push result to array
        array_push($variable_array, $number_repetitive_errors);
    //Get number text errors
        $number_text_errors = $request->number_text_errors($code);
        //Push result to array
        array_push($variable_array, $number_text_errors);
    //Get number linking issues
        $number_linking_issues = $request->number_linking_issues($code);
        //Push result to array
        array_push($variable_array, $number_linking_issues);
    //Get number spelling errors
        $number_spelling_errors = $request->number_spelling_errors($code);
        //Push result to array
        array_push($variable_array, $number_spelling_errors);
        
    //Get number of duplicate meta's
        $number_duplicate_meta = $request->number_meta($code);
        //Push result to array
        array_push($variable_array, $number_duplicate_meta);
        
    //Get number of GA errors
        $number_ga_errors = $request->number_ga_errors($code);
        //Push result to array
        array_push($variable_array, $number_ga_errors);
        
        echo json_encode($variable_array);
   }
   else
   {
    echo "no code";
   }

?>
