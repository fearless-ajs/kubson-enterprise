<?php
//function to remove 0 from dates and time
function strip_zeros_from_date($marked_string=""){
    //first remove the marked zeroes
    $no_zero = str_replace("*0", "", $marked_string);
    //then remove any remaining marks
    $cleaned_string = str_replace('*', '', $no_zero);
    return $cleaned_string;
}

//redirecting function
function redirect_to($location = NULL){
    if($location != NULL){
        header("Location: {$location}");
        exit;
    }
}

//function that displays messages
function output_message($message = ''){
    if(!empty($message)){
        return "<p class=\"message\">{$message}</p>";
    } else {
        return "";
    }
}

//autoload function for unknown links
function __autoload($class_name){
    $class_name = strtolower($class_name);
    $path  = LIB_PATH.DS."{$class_name}.php";
    if(file_exists($path)){
        require_once($path);
    } else {
        die("The file {$class_name}.php could not be found");
    }
}

//function that include layout template
//it is advisable to roll all layout tempalate intointo a class
function include_layout_template($template=""){
    include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

//function for log action
function log_action($action, $message=""){
    $logfile = SITE_ROOT.DS. 'logs' .DS. 'log.txt';
    $new = file_exists($logfile)?FALSE:TRUE;
    if($handle = fopen($logfile, 'a')){ //append mode
        $timestamp = strftime("%Y-%m-%d %H:%M:S", time());
        $content = "{$timestamp} | {$action}: {$message}\n";
        fwrite($handle, $content);
        fclose($handle);
        if($new){
            chmod($logfile, 0755);
        }
    } else {
        echo 'Could not open logfile for writting';
    }
}

function datetime_to_text($datetime=""){
    $unixdatetime = strtotime($datetime);
    return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}