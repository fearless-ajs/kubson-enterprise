<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization

class PatientControl{
    public $message;
    public $PatientID;
    public $Patientname;
    public $Fathername;
    public $Address;
    public $ContactNo;
    public $Email;
    public $Age;
    public $Gender;
    public $BloodGroup;
    public $Remarks;
    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
            $PatientID           = $_POST['patient_id'];
            $Patientname         = $_POST['name'];
            $Fathername          = $_POST['f_name'];
            $Address             = $_POST['address'];
            $ContactNo           = $_POST['number'];
            $Email               = $_POST['email'];
            $Age                 = $_POST['age'];
            $Gender              = $_POST['gender'];
            $BloodGroup          = $_POST['blood_group'];
            $Remarks             = $_POST['remark'];

            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($PatientID, $Patientname, $Fathername, $Address, $ContactNo, $Email,
                    $Age, $Gender, $BloodGroup, $Remarks) == true){
                //assigning the variable to the public vars
                $this->PatientID            = $PatientID;
                $this->PatientName          = $Patientname;
                $this->FatherName           = $Fathername;
                $this->Address              = $Address;
                $this->ContactNo            = $ContactNo;
                $this->Email                = $Email;
                $this->Age                  = $Age;
                $this->Gender               = $Gender;
                $this->BloodGroup           = $BloodGroup;
                $this->Remarks              = $Remarks;
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
            $PatientID           = $_POST['patient_id'];
            $PatientName         = $_POST['name'];
            $FatherName          = $_POST['f_name'];
            $Address             = $_POST['address'];
            $ContactNo           = $_POST['number'];
            $Email               = $_POST['email'];
            $Age                 = $_POST['age'];
            $Gender              = $_POST['gender'];
            $BloodGroup          = $_POST['blood_group'];
            $Remarks             = $_POST['remark'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input

            //assigning the variable to the public vars
            $this->PatientID            = $PatientID;
            $this->PatientName          = $PatientName;
            $this->FatherName           = $FatherName;
            $this->Address              = $Address;
            $this->ContactNo            = $ContactNo;
            $this->Email                = $Email;
            $this->Age                  = $Age;
            $this->Gender               = $Gender;
            $this->BloodGroup           = $BloodGroup;
            $this->Remarks              = $Remarks;
            $this->updateStaff($_GET['key']);

        }

    }

    //Attribute Validation function
    public function validate_input($PatientID, $Patientname, $Fathername, $Address, $ContactNo, $Email,
                                   $Age, $Gender, $BloodGroup, $Remarks){
        //checks for empty fields
        if(empty($PatientID) || empty($Patientname) || empty($Fathername) || empty($Address) || empty($ContactNo) || empty($Email)
            || empty($Age) || empty($Gender) || empty($BloodGroup) || empty($Remarks)){
            $message = "You left a blank field";
            $this->message = $message;
            return false;
        }
        //checks for invalid characters
        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $Patientname)){
            $message = "Your Ward Name contains invalid characters";
            $this->message = $message;
            return false;
        }

        //validates email
        if($this->validate_email($Email) == false){
            return false;
        }

        //validates staff ID
        if($this->validate_staff($PatientID) == false){
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
    public function validate_staff($ID){
        $user = new Patient();

        /**
        //checks for invalid email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message= "Invalid Email, Please verify the mail";
        $this->message = $message;
        return false;
        }
         * */
        //checks if the EMAIL EXIST
        if($user->check_staff($ID) == false){
            $message = "ID taken, Use Another ID";
            $this->message = $message;
            return false;
        }
        return true;
    }

    //function that validates user email
    public function validate_email($Email){
        $user = new Patient();


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

        $staff = new Patient();
        $staff->PatientID        =  $this->PatientID;
        $staff->Patientname      =  $this->Patientname;
        $staff->Fathername       =  $this->Fathername;
        $staff->Address          =  $this->Address;
        $staff->ContactNo        =  $this->ContactNo;
        $staff->Email            =  $this->Email;
        $staff->Age              =  $this->Age;
        $staff->Gen              =  $this->Gender;
        $staff->BG               =  $this->BloodGroup;
        $staff->Remarks          =  $this->Remarks;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->update_by_Patient_ID($ID) == true ){
            $session = new Session();
            $_POST['msg'] = "Patient Information Updated";
            $this->message = $_POST['msg'];
            redirect_to("patient_list.php?msg=Patient Information Updated");
        } else {
            $message = "Sorry! ): something went wrong";
            $this->message = $message;
            return false;
        }
    }

    //Registration method
    public function addStaff(){

        $staff = new Patient();
        $staff->PatientID        =  $this->PatientID;
        $staff->PatientName      =  $this->PatientName;
        $staff->FatherName       =  $this->FatherName;
        $staff->Address          =  $this->Address;
        $staff->ContactNo        =  $this->ContactNo;
        $staff->Email            =  $this->Email;
        $staff->Age              =  $this->Age;
        $staff->Gen              =  $this->Gender;
        $staff->BG               =  $this->BloodGroup;
        $staff->Remarks          =  $this->Remarks;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->create() == true ){
            $session = new Session();
            $_POST['msg'] = "New Patient Registered";
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
            $staffs = new Patient();
            if($staffs && $staffs->destroyStaff($_GET['key'])){
                $_GET['msg'] = "Patient Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete Patient!";
            }

        }


    }


}


