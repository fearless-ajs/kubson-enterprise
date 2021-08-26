<?php
  //define the core path
  //define them as absolute paths to make sure that require_once works as expected

//DIRECTORY_SEPARATOR is a php pre-defined constant
// C\ for windows, / for Unix


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
 

defined('SITE_ROOT') ? null:
define('SITE_ROOT', 'C:'.DS.'xampp'.DS.'htdocs'.DS.'kubson'.DS.'admin');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
           
        //load config file first
        require_once(LIB_PATH.DS. 'Models'.DS.'config.php');
        
        //loading basic functions next so that everything after can use them
        require_once(LIB_PATH.DS.'Helpers'.DS.'functions.php');
        
        //load core objects
        require_once(LIB_PATH.DS.'Controllers'.DS.'session.php');
        require_once(LIB_PATH.DS.'Models'.DS.'database.php');
        require_once(LIB_PATH.DS.'Models'.DS.'database_object.php');
        require_once(LIB_PATH.DS.'Models'.DS.'pagination_model.php');
        require_once(LIB_PATH.DS.'Models'.DS.'createdb.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'pagination_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'photo_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'user_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'comment_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'login_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'room_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'ward_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'staff_control.php');
       // require_once(LIB_PATH.DS.'Controllers'.DS.'patient_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'service_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'admit_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'admin_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'customers_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'women_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'men_control.php');
        require_once(LIB_PATH.DS.'Controllers'.DS.'kids_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'discharge_control.php');
        //require_once(LIB_PATH.DS.'Controllers'.DS.'specialist_control.php');
        require_once(LIB_PATH.DS.'Helpers'.DS."PHPMailer".DS."PHPMailerAutoload.php");
        require_once(LIB_PATH.DS.'Helpers'.DS."PHPMailer".DS."mail_credentials.php");
        require_once(LIB_PATH.DS.'Helpers'.DS."image_processor.php");
        
        //load database(Model) related classes
        require_once(LIB_PATH.DS.'Models'.DS.'user.php');
        require_once(LIB_PATH.DS.'Models'.DS.'photograph.php');
        require_once(LIB_PATH.DS.'Models'.DS.'comment.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'ward.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'room.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'staff.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'ward_list.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'patient.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'service.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'admit.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'discharge.php');
        //require_once(LIB_PATH.DS.'Models'.DS.'specialist.php');
        require_once(LIB_PATH.DS.'Models'.DS.'admin.php');
        require_once(LIB_PATH.DS.'Models'.DS.'customers.php');
        require_once(LIB_PATH.DS.'Models'.DS.'men.php');
         require_once(LIB_PATH.DS.'Models'.DS.'kids.php');
        require_once(LIB_PATH.DS.'Models'.DS.'women.php');
