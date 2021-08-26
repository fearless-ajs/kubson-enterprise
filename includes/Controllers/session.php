<?php
//the class that maintains our session
//keep in mind when working with sessions that it is generally
//inadvisable to store DB-related objects in sessions

class Session{
    private   $logged_in = FALSE;
    public    $user_id;
    protected $user_mail;
    public    $user_fullname;
    public    $user_regmonth;
    public    $user_regyear;
    public    $user_image;
    public    $user_role;
    public    $user_education;
    public    $user_location;
    public    $user_quote;
    public    $message;
    


    //everything happens here in the constructor automatically 
    function __construct() {
        session_start();
        $this->check_message();
        $this->check_login();
        if($this->logged_in){
            //actions to take right away if user is logged
            
        }else{
            //actions to take right away if user is not logged in
            
        }
    }
    
    //fuction to access $logged_in variable
    public function is_logged_in(){
        return $this->logged_in;
    }

    //function to log users In
    public function login($user){
        //database should find user based on username/password
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = TRUE;
        }
    }
    
    //fnction that logs Users Out
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->logged_in = FALSE;
    }
    
    //function to set messages
    public function message($msg=""){
        if(!empty($msg)){
            //then this is "set message";
            $_SESSION['message'] = $msg;
        } else {
            //then this is get message
            return $this->message;
        }
    }

    //function to check if the user is logged in
    private function check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = TRUE;
        } else {
            unset($this->user_id);
            $this->logged_in = FALSE;
        }
    }
    
    private function check_message(){
        //Is there a message stored in the session
        if(isset($_SESSION['message'])){
            //Add it as an attribute and clear the stored version
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}
//$session = new Session();
//$message = $session->message();