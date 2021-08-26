<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization 

class CustomersControl{
    public $message; 
    public $fullname;
    public $email;
    public $phone;
    public $password;
    //constructor that loads automatimally when the class in called
    public function __construct() {
   
        //checks if the form is posted
        if(isset($_POST['submit'])){
            $fullname = $_POST['name'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
            $phone    = $_POST['phone'];
            (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted 
            //validating user input
            if($this->validate_input($fullname, $email, $phone, $password, $checkbox) == true){
             //assigning the variable to the public vars
            $this->fullname = $fullname;
            $this->email    = $email;
            $this->phone    = $phone;
            $this->password = $password;
            $this->addUser();
             
           }else{

           }
          
       }
        if(isset($_POST['reset'])){
            $this->resetPassword();
        }
        
        if(isset($_POST['update'])){
            $this->update();
        }
   }

   
   
   //update function
    public function update(){
        //checks if the update form is posted
        if(isset($_POST['update'])){
    
            $fullname = $_POST['name'];
            $email    = $_POST['email'];
            $phone    = $_POST['phone'];
            $password = $_POST['password'];
        
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

            //assigning the variable to the public vars
            $this->fullname = $fullname;
            $this->email    = $email;
            $this->phone    = $phone;
            $this->password = $password;
            $this->updateUser($_GET['key']);

        }

    }
    
     //update ward
    public function updateUser($ID){

        $staff = new Customers();
        $staff->id              =  $ID;
        $staff->fullname        =  $this->fullname;
        $staff->email           =  $this->email;
        $staff->phone           = $this->phone;
        $staff->password        =  $this->password;
 
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->update_by_id($ID) == true ){
            $session = new Session();
            $_POST['msg'] = "Customer Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("customers_list.php?msg=Customer Information Updated");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }
   
   //function that reset passwords
    public function resetPassword(){
        //checks if the update form is posted
        if(isset($_POST['reset'])){
            $email          = $_POST['email'];
            $old_password   = $_POST['old_password'];
            $new_password = $_POST['new_password'];
            $v_password    = $_POST['v_password'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if ($this->validate_reset_input($email, $old_password, $new_password, $v_password) == true){
                //assigning the variable to the public vars
                $this->email         = $email;
                $this->new_password  = $new_password;
                $this->updatePassword();
            }else{

            }

        }
    }

    //update ward
    public function updatePassword(){
        $user = new User();
        $user->email    =  $this->email;
        $user->password =  $this->new_password;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($user->update_password_by_email($this->email, $this->new_password) == true ){
            $session = new Session();
            $_POST['msg'] = "Passsword Updated";
            $this->message = $_POST['msg'];
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }
    //function that validates user input for password reset
    public function validate_reset_input($email, $old_password, $new_password, $v_password){
            $user = new User();
            //checks for empty fields
            if(empty($email) || empty($old_password) || empty($new_password) || empty($v_password)){
                $message = "You left a blank field";
                $this->message = $message;
                return false;
            }

            //checks for invalid email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $message= "Invalid Email, Please verify the mail";
                $this->message = $message;
                return false;
            }

            //checks if the EMAIL EXIST
            if($user->check_user_mail($email)){
                $message = "Unregistered Email";
                $this->message = $message;
                return false;
            }

            //check if the password matches and checkbox is checked
            if($new_password != $v_password){
                    $message = "Password doesn't match";
                    $this->message = $message;
                    return false;
            }

            //checks if the password is correct
            if(User::verify_password($email, $old_password)==false){
                $message = "Invalid User";
                $this->message = $message;
                return false;
            }
            return TRUE;
    }
    //Attribute Validation function
    public function validate_input($fullname, $email, $phone, $password, $checkbox){
               
              //checks for empty fields
              if(empty($fullname) || empty($email) || empty($phone) || empty($password)){        
                  $message = "You left a blank field";
                  $this->message = $message;
                  return false;
                    }
                    //checks for invalid characters  
                    if(!preg_match("/^[a-zA-Z0-9 ]*$/", $fullname)){
                    $message = "Your name contains invalid characters";
                    $this->message = $message;
                    return false;
                    } 
                    //validates email
                    if($this->validate_email($email) == false){
                     return false;             
                    }
                    return true;
                   //check if the password matches and checkbox is checked
                   //return $this->password_and_checkbox($password, $verify_password, $checkbox) == true ? true : false;
                    
    }
    
    //password verification and checkbox
    public function password_and_checkbox($password, $verify_password, $checkbox){
                           //check if the password matches
                   if($password != $verify_password){
                   $message = "Password doesn't match";
                   $this->message = $message;
                   return false;
                    }
                    //check if the checkbox is.. checked
                    if(!empty($checkbox) && $checkbox == 'yes'){
                        return true;
                    }else{
                   $message = "You need to agree to the terms of use";
                   $this->message = $message;
                   return false;
                    }
    }

    //function that validates user email
    public function validate_email($email){
                $user = new Customers();
               //checks for invalid email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $message= "Invalid Email, Please verify the mail";
                $this->message = $message;
                return false;
              }
              //checks if the EMAIL EXIST
              if($user->check_user_mail($email) == false){
                $message = "Email Exists, Please use another email";
                $this->message = $message;
                return false;
              }
              return true;
    }
    
    //Registration method
    public function addUser(){
        
         $user = new Customers();
         $user->fullname = $this->fullname;
         $user->email    =  $this->email;       
         $user->phone    = $this->phone;
         //$user->image_path = "uploads\images\oyin.jpg"; //default image.
         //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
         $user->password = $this->password;
         
         if($user->create() == true ){
         $session = new Session();
         $_POST['msg'] = "Registered, Click OK to Login";
         $session->message("User Created, Login to Activate your session");
         redirect_to("index.php?msg=New Customer Registered");
         } else {
                 $message = "Sorry! ): something went wrong";
                 $this->message = $message;
                 return false;
         }
    }
   
    //ward deleting method
    public function deleteStaff(){
        //pic Must have an id
        if(isset($_GET['key'])){
            $staffs = new Customers();
            if($staffs && $staffs->destroyUser($_GET['key'])){
           
                $_GET['msg'] = "Customer Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete User!";
            }

        }


    }

}

