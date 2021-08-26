<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization

class AdminControl{
    public $message;
    public $fullname;
    public $email;
    public $password;
    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
            $fullname           = $_POST['name'];
            $email              = $_POST['email'];
            $password           = $_POST['f_name'];


            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($fullname, $email, $password) == true){
                //assigning the variable to the public vars
                $this->fullname           = $fullname;
                $this->email              = $email;
                $this->password           = $password;
                $this->addStaff();

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
            $DoctorID            = $_POST['doctor_id'];
            $DoctorName          = $_POST['name'];
            $FatherName          = $_POST['f_name'];
            $Address             = $_POST['address'];
            $ContactNo           = $_POST['number'];
            $Email               = $_POST['email'];
            $Qualifications      = $_POST['qual'];
            $Specialization      = $_POST['spec'];
            $Gender              = $_POST['gender'];
            $BloodGroup          = $_POST['blood_group'];
            $DateOfJoining       = $_POST['date_joined'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

            //assigning the variable to the public vars
            $this->DoctorID             = $DoctorID;
            $this->DoctorName           = $DoctorName;
            $this->FatherName           = $FatherName;
            $this->Address              = $Address;
            $this->ContactNo            = $ContactNo;
            $this->Email                = $Email;
            $this->Qualifications       = $Qualifications;
            $this->Specialization       = $Specialization;
            $this->Gender               = $Gender;
            $this->BloodGroup           = $BloodGroup;
            $this->DateOfJoining        = $DateOfJoining;
            $this->updateStaff($_GET['key']);

        }

    }

    //Attribute Validation function
    public function validate_input($fullname, $email, $password){
        //checks for empty fields
        if(empty($fullname) || empty($email) || empty($password)){
            $message = "You left a blank field";
            $this->message = $message;
            return false;
        }
        //checks for invalid characters
        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $fullname)){
            $message = "Your Ward Name contains invalid characters";
            $this->message = $message;
            return false;
        }

        //validates email
        if($this->validate_email($email) == false){
            return false;
        }

        //validates staff ID
        if($this->validate_staff($email) == false){
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
    public function validate_staff($email){
        $user = new Admin();

        /**
        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message= "Invalid Email, Please verify the mail";
        $this->message = $message;
        return false;
        }
         * */
        //checks if the EMAIL EXIST
        if($user->check_user_email($email) == false){
            $message = "ID taken, Use Another ID";
            $this->message = $message;
            return false;
        }
        return true;
    }

    //function that validates user email
    public function validate_email($Email){
        $user = new Staff();


        //checks for invalid email
        if(!filter_var($Email, FILTER_VALIDATE_EMAIL)){
            $message= "Invalid Email, Please verify the mail";
            $this->message = $message;
            return false;
        }

        //checks if the EMAIL EXIST
        if($user->check_user_email($Email) == false){
            $message = "Email Exists, Register Another Email";
            $this->message = $message;
            return false;
        }
        return true;
    }


    //update ward
    public function updateStaff($ID){

        $staff = new Doctor();
        $staff->DoctorID        =  $this->DoctorID;
        $staff->DoctorName      =  $this->DoctorName;
        $staff->FatherName       =  $this->FatherName;
        $staff->Address         =  $this->Address;
        $staff->ContactNo       =  $this->ContactNo;
        $staff->Email           =  $this->Email;
        $staff->Qualifications  =  $this->Qualifications;
        $staff->Specialization  =  $this->Specialization;
        $staff->Gender          =  $this->Gender;
        $staff->BloodGroup      =  $this->BloodGroup;
        $staff->DateOfJoining   =  $this->DateOfJoining;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->update_by_doctor_ID($ID) == true ){
            $session = new Session();
            $_POST['msg'] = "Doctor Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("doctor_list.php?msg=Ward Information Updated");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //Registration method
    public function addStaff(){

        $staff = new Admin();
        $staff->fullname        =  $this->fullname;
        $staff->email           =  $this->email;
        $staff->password        =  $this->password;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->create() == true ){
            $session = new Session();
            $_POST['msg'] = "New Admin Registered";
            $this->message = $_POST['msg'];
            //$session->message("User Created, Login to Activate your session");
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
            $staffs = new Doctor();
            if($staffs && $staffs->destroyStaff($_GET['key'])){
                $_GET['msg'] = "Doctor Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete Doctor!";
            }

        }


    }


}


