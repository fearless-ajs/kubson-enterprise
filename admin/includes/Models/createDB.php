<?php
require_once(LIB_PATH.DS. 'Models'.DS.'database.php');
//Class that creates database automatically if it doesnt exist
class CreateDb{
    //this creates database when called
   
    public function newDatabase($db_name){
        global $database;
        $sql = "CREATE DATABASE IF NOT EXISTS {$db_name}";
        $result = $database->query($sql);
        if($database->num_rows($result) <= 0){
            return FALSE;            
            //proceeds with selection but no tables
            
        } else {
            return TRUE;
            //proceeds with selectio and table creation
            
        }
    }
}