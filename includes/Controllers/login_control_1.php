<?php
 // put your code here
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//class that handles login in and sessions
class LoginControl{
   // public $message = "Sign in to start your session";
    //function that runs automatically
    public function __construct() {
    //code that generally needs to run automatically stays within this block
         
    }
    
    //function that check if user is logged in
    public function is_Logged_in(){
         //checking if the user is logged in
         $session = new Session();
         if($session->is_logged_in()){
             redirect_to("index.php");
         }
         
    }


   // function that checks if the user is not logged in'
    public function is_not_Logged_in(){
         //checking if the user is logged in
         $session = new Session();
         if(!$session->is_logged_in()){
             redirect_to("login\index.php");
         }
         
    }
       // function that checks if the user is not logged in'
    public function is_not_Logged_in_within(){
         //checking if the user is logged in
         $session = new Session();
         if(!$session->is_logged_in()){
             redirect_to("login.php");
         }
         
    }



    //function loging user in
    public function loginUser($email="", $password=""){
        
          //Remember to give your form's submit tag a name="submit" attribute
         if(isset($_POST['submit'])){ //if form has been submitted
             $email     = trim($_POST['email']);
             $password  = trim($_POST['password']);
             
             //check the database to see if username and password exist
             $found_user = User::verify_user($email, $password);
             if($found_user != false){
                 $new_session = User::authenticate($email);
                 $session = new Session();
                 $session->login($new_session);
                 log_action('login', "{$found_user->email} logged in.");
                 redirect_to("index.php");
             }
         }
    //end of the form processing
         
   }
   
   
    
     //logout function
    public function logoutUser(){
        $session = new Session();
        $session->logout();
        redirect_to("../../public/login.php");
    }
    
}
