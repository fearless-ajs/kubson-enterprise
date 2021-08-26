<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization

class WardControl{
    public $message;
    public $wardname;
    public $wardtype;
    public $No_of_beds;
    public $charges;
    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
            $wardName   = $_POST['wardname'];
            $wardType   = $_POST['wardtype'];
            $No_of_beds = $_POST['no_of_beds'];
            $price    = $_POST['price'];
            //$verify_password = $_POST['v_password'];
           // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($wardName, $wardType, $No_of_beds, $price) == true){
                //assigning the variable to the public vars
                $this->wardname    = $wardName;
                $this->wardtype    = $wardType;
                $this->No_of_beds  = $No_of_beds;
                $this->charges     = $price;
                $this->addWard();

            }else{

            }
        }
        if(isset($_POST['update'])){
            $this->update();
        }

    }

    //update function
    public function update(){
        //checks if the update form is posted
        if(isset($_POST['update'])){
            $wardName   = $_POST['wardname'];
            $wardType   = $_POST['wardtype'];
            $No_of_beds = $_POST['no_of_beds'];
            $price    = $_POST['price'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

                //assigning the variable to the public vars
                $this->wardname    = $wardName;
                $this->wardtype    = $wardType;
                $this->No_of_beds  = $No_of_beds;
                $this->charges     = $price;
                $this->updateWard($_GET['key']);

            }

    }

    //Attribute Validation function
    public function validate_input($wardName, $wardType, $No_of_beds, $price){

        //checks for empty fields
        if(empty($wardName) || empty($wardType) || empty($No_of_beds) || empty($price)){
            $message = "You left a blank field";
            $this->message = $message;
            return false;
        }
        //checks for invalid characters
        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $wardName)){
            $message = "Your Ward Name contains invalid characters";
            $this->message = $message;
            return false;
        }

        //validates wardname
        if($this->validate_ward($wardName) == false){
            return false;
        }
        return true;
        /**
        //check if the password matches and checkbox is checked
        return $this->password_and_checkbox($password, $verify_password, $checkbox) == true ? true : false;
        **/
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
    public function validate_ward($wardname){
        $user = new Ward();

        /**
        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message= "Invalid Email, Please verify the mail";
            $this->message = $message;
            return false;
        }
         * */
        //checks if the EMAIL EXIST
        if($user->check_ward($wardname) == false){
            $message = "Ward Exists, Register Another Ward";
            $this->message = $message;
            return false;
        }
        return true;
    }

    //function that validates user email
    public function validate_email($email){
        $user = new User();


        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message= "Invalid Email, Please verify the mail";
        $this->message = $message;
        return false;
        }

        //checks if the EMAIL EXIST
        if($user->check_user_email($email) == false){
            $message = "Ward Exists, Register Another Ward";
            $this->message = $message;
            return false;
        }
        return true;
    }


    //update ward
    public function updateWard($wardname){
        $user = new Ward();
        $user->wardname =  $this->wardname;
        $user->wardtype =  $this->wardtype;
        $user->NoOfBeds =  $this->No_of_beds;
        $user->Charges  =  $this->charges;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($user->update_by_wardname($wardname) == true ){
            $session = new Session();
            $_POST['msg'] = "Ward Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("ward_list.php?msg=Ward Information Updated");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //Registration method
    public function addWard(){

        $user = new Ward();
        $user->wardname =  $this->wardname;
        $user->wardtype =  $this->wardtype;
        $user->NoOfBeds =  $this->No_of_beds;
        $user->Charges  =  $this->charges;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($user->create() == true ){
            $session = new Session();
            $_POST['msg'] = "New Ward Registered";
            $this->message = $_POST['msg'];
            //$session->message("User Created, Login to Activate your session");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //ward deleting method
    public function deleteWard(){
        //pic Must have an id
        if(isset($_GET['key'])){
            $wards = new Ward();
            if($wards && $wards->destroyWard($_GET['key'])){
                $_GET['msg'] = "Ward Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete ward!";
            }

        }


    }


}

