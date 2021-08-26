<?php
require_once(LIB_PATH.DS. 'Helpers'.DS.'initialize.php');
//Class That controls the initialization

class DischargeControl{
    public $message;
    public $PatientID;
    public $Disease;
    public $RoomNo;
    public $AdmitDate;
    public $DoctorID;
    public $AP_Remarks;
    public $d_date;
    public $status;
    //constructor that loads automatimally when the class in called
    public function __construct() {

        //checks if the form is posted
        if(isset($_POST['submit'])){
            $PatientID        = $_POST['patient_id'];
            $Disease          = $_POST['disease'];
            $RoomNo           = $_POST['roomno'];
            $AdmitDate        = $_POST['date'];
            $DoctorID         = $_POST['doctor_id'];
            $AP_Remarks       = $_POST['remark'];

            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if($this->validate_input($PatientID,$Disease, $RoomNo, $AdmitDate, $DoctorID, $AP_Remarks) == true){
                //assigning the variable to the public vars
                $this->PatientID     = $PatientID;
                $this->Disease       = $Disease;
                $this->RoomNo        = $RoomNo;
                $this->AdmitDate     = $AdmitDate;
                $this->DoctorID      = $DoctorID;
                $this->AP_Remarks    = $AP_Remarks;
                $this->addStaff();

            }else{

            }
        }
        if(isset($_POST['update'])){
            $this->update();
        }

    }

    //update function
    public function update()
    {
        //checks if the update form is posted
        if (isset($_POST['update'])) {
            $status = TRUE;
            $d_date = $_POST['d_date'];
            //$verify_password = $_POST['v_password'];
            // (isset($_POST['checkbox']))? $checkbox = $_POST['checkbox']  : $checkbox = null;//checks if checkbox posted
            //validating user input
            if ($this->validate_input($d_date) == true) {
                //assigning the variable to the public vars
                $this->status = TRUE;
                $this->d_date = $_POST['d_date'];
                $this->updateStaff($_GET['key']);

            }

        }
    }

    //Attribute Validation function
    public function validate_input($d_date){

        //checks for empty fields
        if(empty($d_date)){
            $message = "You left a blank field";
            $this->message = $message;
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
        $user = new Admit();

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
            $message = "Patient Admitted Already";
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

        $staff = new Discharge();
        $staff->status            =  $this->status;
        $staff->discharge_date    = $this->d_date;

        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->update_by_discharge_ID($ID, $this->status, $this->d_date) == true ){
            $session = new Session();
            $_POST['msg'] = "Patient Discharged Successfully";
            $this->message = $_POST['msg'];
            redirect_to("discharge_list.php?msg=Patient Discharged successfully!");
        } else {
            global $database;
            $message = "Sorry! ): something went wrong ";
            $this->message = $message;
            return false;
        }
    }

    //Registration method
    public function addStaff(){

        $staff = new Admit();
        $staff->PatientID             =  $this->PatientID;
        $staff->Disease               =  $this->Disease;
        $staff->DoctorID              =  $this->DoctorID;
        $staff->AdmitDate             =  $this->AdmitDate;
        $staff->RoomNo                =  $this->RoomNo;
        $staff->AP_Remarks            =  $this->AP_Remarks;
        //$user->image_path = "uploads\images\oyin.jpg"; //default image.
        //$user->reg_date = strftime("%Y-%m-%d %H:%M:%S", time());
        //$user->password = $this->password;

        if($staff->create() == true ){
            $session = new Session();
            $_POST['msg'] = "New Patient Admitted";
            $this->message = $_POST['msg'];
            redirect_to("admit_list.php");
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
            $staffs = new Staff();
            if($staffs && $staffs->destroyStaff($_GET['key'])){
                $_GET['msg'] = "Worker Deleted Succesfully";
            } else {
                $_GET['msg'] = "Fail to Delete Staff!";
            }

        }


    }


}


